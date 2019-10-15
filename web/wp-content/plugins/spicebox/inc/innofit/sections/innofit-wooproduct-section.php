<?php
/* Call the action for team section */
add_action('innofit_wooproduct_action','innofit_wooproduct_section');
/* Function for team section*/
function innofit_wooproduct_section()
{
if ( class_exists( 'WooCommerce' ) ) {
$shop_section_enable = get_theme_mod('shop_section_enable','on');
if($shop_section_enable !='off')
{
?>
<!-- Product & Shop Section -->
<section class="section-module shop" id="shop">
	<div class="container">
		
		<?php $home_shop_section_title = get_theme_mod('home_shop_section_title',__('Featured Products','spicebox'));
		$home_shop_section_discription = get_theme_mod('home_shop_section_discription',__('Our amazing products','spicebox')); 
		if(($home_shop_section_title) || ($home_shop_section_discription)!='' ) { 
		?>
		<div class="row">
		    <div class="col-md-12">
				<div class="section-header">
					<p class="section-subtitle"><?php echo $home_shop_section_title;  ?></p>
					<h1 class="section-title"><?php echo $home_shop_section_discription;  ?></h1>
				</div>
			</div>
		</div>
		<?php }
		$args                   = array(
			'post_type' => 'product',
			'posts_per_page' => 4,
		);
		/* Exclude hidden products from the loop */
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
				

			),
		);
		?>	
		<div class="row">
			<?php
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
				<div class="item <?php echo the_title(); ?>" data-profile="<?php echo $loop->post->ID; ?>">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="products">
							<div class="item-img">
								<?php the_post_thumbnail(); ?>
								<?php if ( $product->is_on_sale() ) : ?>

								<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'On Sale!', 'innofit' ) . '</span>', $product ); ?>
								<?php endif; ?>
								
								<div class="add-to-cart">
								<?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
								</div>
								
							</div>
							<div class="product-price">
							<?php if ($average = $product->get_average_rating()) : ?>
								<ul class="woocommerce rating">
									<li>	
										<?php echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'innofit' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'innofit' ).'</span></div>'; ?>
									</li>
								</ul>
							<?php endif; ?>	
								<h5 class="woocommerce-loop-product__title"><a href="<?php the_permalink(); ?>" title="" tabindex="-1"><?php the_title(); ?></a></h5>
								<span class="woocommerce-Price-amount"><?php echo $product->get_price_html(); ?></span>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php  wp_reset_postdata(); ?>								
		</div>
		<!-- /Item Scroll -->
		
	</div>
</section>
<!-- /Product & Shop Section -->
<?php } } }?>