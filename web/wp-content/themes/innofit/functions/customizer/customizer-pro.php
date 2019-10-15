<?php
if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):
//Pro Button
function innofit_pro_customizer( $wp_customize ) {
class WP_Pro_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-box">
       <a href="<?php echo 'https://spicethemes.com/innofit-plus/';?>" target="_blank" class="upgrade-innofit-pro" id="review_pro"><?php esc_html_e( 'UPGRADE TO PLUS','innofit' ); ?></a>
		
	</div>
    <?php
    }
}
$wp_customize->add_section( 'innofit_pro_section' , array(
		'title'      => esc_html__('Upgrade to Plus','innofit'),
		'priority'   => 1000,
   	) );

$wp_customize->add_setting(
    'upgrade_pro',
    array(
       'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_Pro_Customize_Control( $wp_customize, 'upgrade_pro', array(
		'section' => 'innofit_pro_section',
		'setting' => 'upgrade_pro',
    ))
);
}
add_action( 'customize_register', 'innofit_pro_customizer' );
endif;
?>