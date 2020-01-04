<?php

use GraphQLRelay\Relay;

class ProductVariationQueriesTest extends \Codeception\TestCase\WPTestCase {
	private $shop_manager;
    private $customer;
    private $products;
    
    public function setUp() {
        parent::setUp();

        $this->shop_manager   = $this->factory->user->create( array( 'role' => 'shop_manager' ) );
        $this->customer       = $this->factory->user->create( array( 'role' => 'customer' ) );
        $this->product_helper = $this->getModule('\Helper\Wpunit')->product();
		$this->helper         = $this->getModule('\Helper\Wpunit')->product_variation();
		$this->products       = $this->helper->create( $this->product_helper->create_variable() );
    }

    public function tearDown() {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    // tests
    public function testVariationQuery() {
        $variation_id = $this->products['variations'][0];
        $id           = $this->helper->to_relay_id( $variation_id );
        $query        = '
            query ($id: ID, $variationId: Int) {
                productVariation(id: $id, variationId: $variationId) {
                    id
                    variationId
                    name
                    date
                    modified
                    description
                    sku
                    price
                    regularPrice
                    salePrice
                    dateOnSaleFrom
                    dateOnSaleTo
                    onSale
                    status
                    purchasable
                    virtual
                    downloadable
                    downloadLimit
                    downloadExpiry
                    taxStatus
                    taxClass
                    manageStock
                    stockQuantity
                    stockStatus
                    backorders
                    backordersAllowed
                    weight
                    length
                    width
                    height
                    menuOrder
                    purchaseNote
                    shippingClass
                    catalogVisibility
                    hasAttributes
                    type
                    parent {
                        id
                    }
                }
            }
        ';

        /**
		 * Assertion One
		 * 
		 * test query and "id" query argument
		 */
		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productVariation' => $this->helper->print_query( $variation_id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

        $this->assertEquals( $expected, $actual );

        $this->getModule('\Helper\Wpunit')->clear_loader_cache( 'wc_post_crud' );

		/**
		 * Assertion Two
		 * 
		 * test query and "methodId" query argument
		 */
		$variables = array( 'variationId' => $variation_id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array( 'data' => array( 'productVariation' => $this->helper->print_query( $variation_id ) ) );

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
    }

    public function testVariationsQueryAndWhereArgs() {
        $id = $this->product_helper->to_relay_id( $this->products['product'] );
        $variations = $this->products['variations'];

        $query      = '
            query (
                $id: ID!,
                $minPrice: Float,
                $parent: Int,
                $parentIn: [Int],
                $parentNotIn: [Int]
            ) {
                product( id: $id ) {
                    ... on VariableProduct {
                        price
                        regularPrice
                        salePrice
                        variations( where: {
                            minPrice: $minPrice,
                            parent: $parent,
                            parentIn: $parentIn,
                            parentNotIn: $parentNotIn
                        } ) {
                            nodes {
                                id
                            }
                        }
                    }
                }
            }
        ';

        /**
		 * Assertion One
		 * 
		 * Test query with no arguments
		 */
        wp_set_current_user( $this->shop_manager );
        $variables = array( 'id' => $id );
        $actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );

        $prices = $this->product_helper->field( $this->products['product'], 'variation_prices', array( true ) );
        $product_fields = array(
            'price'        => \wc_graphql_price( current( $prices['price'] ) )
            . ' - '
            . \wc_graphql_price( end( $prices['price'] ) ),
            'regularPrice' => \wc_graphql_price( current( $prices['regular_price'] ) )
                . ' - '
                . \wc_graphql_price( end( $prices['regular_price'] ) ),
            'salePrice'    => null,
        );
        
        $expected  = array(
			'data' => array(
                'product' => array_merge(
                    $product_fields,
                    array(
                        'variations' => array(
                            'nodes' => $this->helper->print_nodes( $variations ),
                        ),
                    )
                ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

        $this->assertEquals( $expected, $actual );
        
        /**
		 * Assertion Two
		 * 
		 * Test "minPrice" where argument
		 */
        $variables = array( 'id' => $id, 'minPrice' => 15 );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
                'product' => array_merge(
                    $product_fields,
                    array(
                        'variations' => array(
                            'nodes' => $this->helper->print_nodes(
                                $variations,
                                array(
                                    'filter' => function( $id ) {
                                        $variation = new WC_Product_Variation( $id );
                                        return 15.00 <= floatval( $variation->get_price() );
                                    }
                                )
                            ),
                        ),
                    )
                ),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

        $this->assertEquals( $expected, $actual );
    }

    public function testProductVariationToMediaItemConnections() {
		$id    = $this->helper->to_relay_id( $this->products['variations'][1] );
		$query = '
			query ($id: ID!) {
				productVariation(id: $id) {
					id
					image {
						id
					}
				}
			}
		';

		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'productVariation' => array(
					'id'            => $id,
					'image'         => array(
                        'id' => Relay::toGlobalId(
                            'attachment',
                            $this->helper->field( $this->products['variations'][1], 'image_id' )
                        ),
					),
				),
			),
		);

		// use --debug flag to view.
        codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}

	public function testProductVariationDownloads() {
		$id    = $this->helper->to_relay_id( $this->products['variations'][0] );

		$query = '
			query ($id: ID!) {
				productVariation(id: $id) {
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
		';

		$variables = array( 'id' => $id );
		$actual    = graphql( array( 'query' => $query, 'variables' => $variables ) );
		$expected  = array(
			'data' => array(
				'productVariation' => array(
					'id'            => $id,
					'downloads'     => $this->helper->print_downloads( $this->products['variations'][0] ),
				),
			),
		);

		// use --debug flag to view.
		codecept_debug( $actual );

		$this->assertEquals( $expected, $actual );
	}
}