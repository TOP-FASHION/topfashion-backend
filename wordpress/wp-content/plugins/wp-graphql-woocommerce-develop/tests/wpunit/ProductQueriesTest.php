<?php

use GraphQLRelay\Relay;
class ProductQueriesTest extends \Codeception\TestCase\WPTestCase {
	private $shop_manager;
	private $customer;
	private $helper;
	private $product;
	private $product_tag;
	private $product_cat;

	public function setUp() {
		// before
		parent::setUp();

		$this->shop_manager  = $this->factory->user->create( array( 'role' => 'shop_manager' ) );
		$this->customer      = $this->factory->user->create( array( 'role' => 'customer' ) );
		$this->helper        = $this->getModule('\Helper\Wpunit')->product();
		$this->product_tag   = 'tag-one';
		$this->product_cat   = 'category-one';
		$this->image_id     = $this->factory->post->create(
			array(
				'post_author'  => $this->shop_manager,
				'post_content' => '',
				'post_excerpt' => '',
				'post_status'  => 'publish',
				'post_title'   => 'Product Image',
				'post_type'    => 'attachment',
				'post_content' => 'product image',
			)
		);
		$category_id         = $this->helper->create_product_category( $this->product_cat );
		$this->product       = $this->helper->create_simple(
			array(
				'tag_ids'           => array( $this->helper->create_product_tag( $this->product_tag ) ),
				'category_ids'      => array( $category_id ),
				'image_id'          => $this->image_id,
				'gallery_image_ids' => array( $this->image_id ),
				'downloads'         => array( ProductHelper::create_download() ),
				'slug'              => 'product-slug',
				'sku'               => 'product-sku',
			)
		);
		update_term_meta( $category_id, 'thumbnail_id', $this->image_id );
	}

	public function tearDown() {
		// your tear down methods here
		$product = \WC()->product_factory->get_product( $this->product );
		$product->delete( true );

		parent::tearDown();
	}

	// tests
	public function testSimpleProductQuery() {
		$query = '
			query ( $id: ID!, $format: PostObjectFieldFormatEnum ) {
				product(id: $id) {
					... on SimpleProduct {
						id
						productId
						name
						slug
						date
						modified
						status
						featured
						catalogVisibility
						description(format: $format)
						shortDescription(format: $format)
						sku
						price
						regularPrice
						salePrice
						dateOnSaleFrom
						dateOnSaleTo
						totalSales
						taxStatus
						taxClass
						manageStock
						stockQuantity
						stockStatus
						backorders
						soldIndividually
						weight
						length
						width
						height
						reviewsAllowed
						purchaseNote
						menuOrder
						virtual
						downloadable
						downloadLimit
						downloadExpiry
						averageRating
						reviewCount
						backordersAllowed
						onSale
						purchasable
						shippingRequired
						shippingTaxable
						link
					}
				}
			}
		';
		
		/**
		 * Assertion One
		 * 
		 * Test querying product.
		 */
		$actual = graphql(
			array(
				'query'     => $query,
				'variables' => array( 'id' => $this->helper->to_relay_id( $this->product ) ),
			)
		);
		$expected = array(
			'data' => array(
				'product' => $this->helper->print_query( $this->product ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		// Clear cache
		$this->getModule('\Helper\Wpunit')->clear_loader_cache( 'wc_post_crud' );

		/**
		 * Assertion Two
		 * 
		 * Test querying product with unformatted content (edit-product cap required).
		 */
		wp_set_current_user( $this->shop_manager );
		$actual = graphql(
			array(
				'query'     => $query,
				'variables' => array(
					'id'     => $this->helper->to_relay_id( $this->product ),
					'format' => 'RAW',
				),
			)
		);
		$expected = array(
			'data' => array(
				'product' => $this->helper->print_query( $this->product, true ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductTaxonomies() {
		// Create product for first assertion.
		$category_5    = $this->helper->create_product_category( 'category-five' );
		$category_6    = $this->helper->create_product_category( 'category-six', $category_5 );
		$tag_2         = $this->helper->create_product_tag( 'tag-two' );
		$attachment_id = $this->factory()->attachment->create(
			array(
				'post_mime_type' => 'image/gif',
				'post_author' => $this->admin
			 )
		);
		$product = $this->helper->create_simple(
			array(
				'price'         => 10,
				'regular_price' => 10,
				'category_ids'  => array( $category_5, $category_6 ),
				'tag_ids'       => array( $tag_2 ),
				'image_id'      => $attachment_id,
			)
		);

		$query = '
			query ( $id: ID, $productId: Int, $slug: String, $sku: String ) {
				productBy( id: $id, productId: $productId, slug: $slug, sku: $sku ) {
					... on SimpleProduct {
						id
						image {
							id
						}
						productCategories {
							nodes {
								name
								children {
									nodes {
										name
									}
								}
							}
						}
						productTags {
							nodes {
								name
							}
						}
					}
				}
			}
		';

		/**
		 * Assertion One
		 * 
		 * Test querying product with "productId" argument.
		 */
		$variables = array( 'productId' => $product );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'productBy' => array(
					'id'         => $this->helper->to_relay_id( $product ),
					'image'      => array(
						'id' => \GraphQLRelay\Relay::toGlobalId( 'attachment', $attachment_id ),
					),
					'productCategories' => array(
						'nodes' => array(
							array(
								'name'     => 'category-five',
								'children' => array(
									'nodes' => array(
										array( 'name' => 'category-six' ),
									),
								),
							),
						),
					),
					'productTags'       => array(
						'nodes' => array(
							array( 'name' => 'tag-two' ),
						),
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductByQueryAndArgs() {
		$id = $this->helper->to_relay_id( $this->product );
		$query = '
			query ( $id: ID, $productId: Int, $slug: String, $sku: String ) {
				productBy( id: $id, productId: $productId, slug: $slug, sku: $sku ) {
					... on SimpleProduct {
						id
					}
				}
			}
		';

		/**
		 * Assertion One
		 * 
		 * Test querying product with "productId" argument.
		 */
		$variables = array( 'productId' => $this->product );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productBy' => array( 'id' => $id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Two
		 * 
		 * Test querying product with "id" argument.
		 */
		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productBy' => array( 'id' => $id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Three
		 * 
		 * Test querying product with "slug" argument.
		 */
		$variables = array( 'slug' => 'product-slug' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productBy' => array( 'id' => $id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Four
		 * 
		 * Test querying product with "sku" argument.
		 */
		$variables = array( 'sku' => 'product-sku' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productBy' => array( 'id' => $id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductsQueryAndWhereArgs() {
		$category_3 = $this->helper->create_product_category( 'category-three' );
		$category_4 = $this->helper->create_product_category( 'category-four' );
		$products = array (
			$this->product,
			$this->helper->create_simple(
				array(
					'price'         => 10,
					'regular_price' => 10,
					'category_ids'  => array( $category_3, $category_4 )
				)
			),
			$this->helper->create_simple(
				array(
					'featured'     => 'true',
					'category_ids' => array( $category_3 ),
				)
			),
			$this->helper->create_external(),
		);

		$query = '
			query (
				$slug: String,
				$status: String,
				$category: String,
				$categoryIn: [String],
				$categoryNotIn: [String],
				$categoryId: Int,
				$categoryIdIn: [Int]
				$categoryIdNotIn: [Int]
				$type: ProductTypesEnum,
				$typeIn: [ProductTypesEnum],
				$typeNotIn: [ProductTypesEnum],
				$featured: Boolean,
				$maxPrice: Float,
				$orderby: [ProductsOrderbyInput]
				$taxonomyFilter: [ProductTaxonomyFilterRelationInput]
			) {
				products( where: {
					slug: $slug,
					status: $status,
					category: $category,
					categoryIn: $categoryIn,
					categoryNotIn: $categoryNotIn,
					categoryId: $categoryId,
					categoryIdIn: $categoryIdIn,
					categoryIdNotIn: $categoryIdNotIn,
					type: $type,
					typeIn: $typeIn,
					typeNotIn: $typeNotIn,
					featured: $featured,
					maxPrice: $maxPrice,
					orderby: $orderby
					taxonomyFilter: $taxonomyFilter
				} ) {
					nodes {
						... on SimpleProduct {
							id
						}
						... on ExternalProduct {
							id
						}
					}
				}
			}
		';

		/**
		 * Assertion One
		 * 
		 * tests query with no arguments
		 */
		$actual   = graphql( array( 'query' => $query ) );
		$expected = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes( $products ),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Two
		 * 
		 * tests "slug" where argument
		 */
		$variables = array( 'slug' => 'test-product-1' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return 'test-product-1' === $product->get_slug();
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Three
		 * 
		 * tests "status" where argument
		 */
		$variables = array( 'status' => 'pending' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'products' => array( 'nodes' => array() ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Four
		 * 
		 * tests "type" where argument
		 */
		$variables = array( 'type' => 'SIMPLE' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return 'simple' === $product->get_type();
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Five
		 * 
		 * tests "typeIn" where argument
		 */
		$variables = array( 'typeIn' => array( 'SIMPLE' ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return 'simple' === $product->get_type();
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Six
		 * 
		 * tests "typeNotIn" where argument
		 */
		$variables = array( 'typeNotIn' => array( 'SIMPLE' ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return 'simple' !== $product->get_type();
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Seven
		 * 
		 * tests "featured" where argument
		 */
		$variables = array( 'featured' => true );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return $product->get_featured();
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Eight
		 * 
		 * tests "maxPrice" where argument
		 */
		$variables = array( 'maxPrice' => 10.00 );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) {
								$product = \wc_get_product( $id );
								return 10.00 >= floatval( $product->get_price() );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Nine
		 * 
		 * tests "orderby" where argument
		 */
		$variables = array( 'orderby' => array( array( 'field' => 'PRICE', 'order' => 'DESC' ) ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'sorter' => function( $id_a, $id_b ) {
								$product_a = new \WC_Product( $id_a );
								$product_b = new \WC_Product( $id_b );

								if ( floatval( $product_a->get_price() ) === floatval( $product_b->get_price() ) ) {
									return 0;
								}
								return floatval( $product_a->get_price() ) > floatval( $product_b->get_price() ) ? -1 : 1;
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Ten
		 * 
		 * tests "category" where argument
		 */
		$variables = array( 'category' => 'category-three' );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_3 ) {
								$product = \wc_get_product( $id );
								return in_array( $category_3, $product->get_category_ids(), true );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Eleven
		 * 
		 * tests "categoryIn" where argument
		 */
		$variables = array( 'categoryIn' => array( 'category-three' ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_3 ) {
								$product = \wc_get_product( $id );
								return in_array( $category_3, $product->get_category_ids(), true );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Twelve
		 * 
		 * tests "categoryNotIn" where argument
		 */
		$variables = array( 'categoryNotIn' => array( 'category-four' ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_4 ) {
								$product = \wc_get_product( $id );
								return ! in_array( $category_4, $product->get_category_ids() );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Thirteen
		 * 
		 * tests "categoryId" where argument
		 */
		$variables = array( 'categoryId' => $category_3 );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_3 ) {
								$product = \wc_get_product( $id );
								return in_array( $category_3, $product->get_category_ids(), true );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Fourteen
		 * 
		 * tests "categoryIdIn" where argument
		 */
		$variables = array( 'categoryIdIn' => array( $category_3 ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_3 ) {
								$product = \wc_get_product( $id );
								return in_array( $category_3, $product->get_category_ids(), true );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Fifteen
		 * 
		 * tests "categoryIdNotIn" where argument
		 */
		$variables = array( 'categoryIdNotIn' => array( $category_4 ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_4 ) {
								$product = \wc_get_product( $id );
								return ! in_array( $category_4, $product->get_category_ids() );;
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );

		/**
		 * Assertion Sixteen
		 * 
		 * tests "taxonomyFilter" where argument
		 */
		$variables = array(
			'taxonomyFilter' => array(
				array(
					'and' => array(
						array(
							'taxonomy' => 'PRODUCTCATEGORY',
							'terms'    => array( 'category-three' ),
						),
						array(
							'taxonomy' => 'PRODUCTCATEGORY',
							'terms'    => array( 'category-four' ),
							'operator' => 'NOT_IN'
						),
					)
				)
			),
		);
		$actual   = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected = array(
			'data' => array(
				'products' => array(
					'nodes' => $this->helper->print_nodes(
						$products,
						array(
							'filter' => function( $id ) use ( $category_4, $category_3 ) {
								$product = \wc_get_product( $id );
								return ! in_array( $category_4, $product->get_category_ids() )
									&& in_array( $category_3, $product->get_category_ids() );
							},
						)
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductToTermConnection() {
		$id = Relay::toGlobalId( 'product', $this->product );
		$query = '
			query ($id: ID!) {
				product(id: $id) {
					... on SimpleProduct {
						id
						productTags {
							nodes {
								name
							}
						}
						productCategories {
							nodes {
								name
							}
						}
					}
				}
			}
		';

		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => array(
					'id'         => $id,
					'productTags'       => array(
						'nodes' => array(
							array( 'name' => $this->product_tag ),
						),
					),
					'productCategories' => array(
						'nodes' => array(
							array( 'name' => $this->product_cat ),
						),
					),
				)
			)
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testTermToProductConnection() {
		$id    = Relay::toGlobalId( 'product', $this->product );
		$query = '
			query {
				productTags( where: { hideEmpty: true } ) {
					nodes {
						name
						products {
							nodes {
								... on SimpleProduct {
									id
								}
							}
						}
					}
				}
				productCategories( where: { hideEmpty: true } ) {
					nodes {
						name
						image {
							id
						}
						products {
							nodes {
								... on SimpleProduct {
									id
								}
							}
						}
					}
				}
			}
		';

		$actual    = graphql( array( 'query' => $query ) );
		$expected  = array(
			'data' => array(
				'productTags' => array(
					'nodes' => array(
						array(
							'name'     => $this->product_tag,
							'products' => array(
								'nodes' => array(
									array (
										'id' => $id
									),
								),
							),
						),
					),
				),
				'productCategories' => array(
					'nodes' => array(
						array(
							'name'     => $this->product_cat,
							'image'    => array(
								'id' => Relay::toGlobalId( 'attachment', $this->image_id ),
							),
							'products' => array(
								'nodes' => array(
									array (
										'id' => $id
									),
								),
							),
						),
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductToMediaItemConnections() {
		$id       = Relay::toGlobalId( 'product', $this->product );
		$image_id = Relay::toGlobalId( 'attachment', $this->image_id );
		$query    = '
			query ( $id: ID! ) {
				product( id: $id ) {
					... on SimpleProduct {
						id
						image {
							id
						}
						galleryImages {
							nodes {
								id
							}
						}
					}
				}
			}
		';

		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => array(
					'id'            => $id,
					'image'         => array(
						'id' => $image_id,
					),
					'galleryImages' => array(
						'nodes' => array(
							array( 'id' => $image_id ),
						),
					),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductDownloads() {
		$id    = $this->helper->to_relay_id( $this->product );
		$query = '
			query ( $id: ID! ) {
				product( id: $id ) {
					... on SimpleProduct {
						id
						downloads {
							name
							downloadId
							filePathType
							fileType
							fileExt
							allowedFileType
							fileExists
							file
						}
					}
				}
			}
		';

		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => array(
					'id'            => $id,
					'downloads'     => $this->helper->print_downloads($this->product),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testExternalProductQuery() {
		$product_id = $this->helper->create_external();
		$query      = '
			query ( $id: ID! ) {
				product(id: $id) {
					... on ExternalProduct {
						id
						buttonText
						externalUrl
					}
				}
			}
		';

		$variables = array( 'id' => $this->helper->to_relay_id( $product_id ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => $this->helper->print_external( $product_id ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testGroupProductConnections() {
		$grouped_product = $this->helper->create_grouped();
		$query           = '
			query ( $id: ID! ) {
				product(id: $id) {
					... on GroupProduct {
						addToCartText
						addToCartDescription
						products {
							nodes {
								... on SimpleProduct {
									id
									parent {
										... on GroupProduct {
											id
										}
									}
								}
							}
						}
					}
				}
			}
		';

		$variables = array( 'id' => $this->helper->to_relay_id( $grouped_product['parent'] ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => $this->helper->print_grouped( $grouped_product['parent'] ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testRelatedProductConnections() {
		$products = $this->helper->create_related();
		$query    = '
			query ($id: ID!) {
				product(id: $id) {
					... on SimpleProduct {
						related {
							nodes {
								... on SimpleProduct {
									id
								}
							}
						}
						crossSell {
							nodes {
								... on SimpleProduct {
									id
								}
							}
						}
						upsell {
							nodes {
								... on SimpleProduct {
									id
								}
							}
						}
					}
				}
			}
		';

		$variables = array( 'id' => $this->helper->to_relay_id( $products['product'] ) );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'product' => array(
					'related'   => array(
						'nodes' => $this->helper->print_nodes(
							array_merge( $products['related'], $products['cross_sell'], $products['upsell'] )
						),
					),
					'crossSell' => array( 'nodes' => $this->helper->print_nodes( $products['cross_sell'] ) ),
					'upsell'    => array( 'nodes' => $this->helper->print_nodes( $products['upsell'] ) ),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}
}
