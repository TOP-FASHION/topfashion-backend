<?php
// Innofit default service data
if ( ! function_exists( 'innofit_service_default_customize_register' ) ) :
	function innofit_service_default_customize_register( $wp_customize ){
				
				$innofit_service_content_control = $wp_customize->get_setting( 'innofit_service_content' );
				if ( ! empty( $innofit_service_content_control ) ) {
					$innofit_service_content_control->default = json_encode( array(
						array(
						'icon_value' => 'fa-headphones',
						'title'      => esc_html__( 'Unlimited Support', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b56',
						),
						array(
						'icon_value' => 'fa-mobile',
						'title'      => esc_html__( 'Pixel Perfect Design', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b66',
						),
						array(
						'icon_value' => 'fa-cogs',
						'title'      => esc_html__( 'Powerful Options', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b86',
						),
						array(
						'icon_value' => 'fa-android',
						'title'      => esc_html__( 'App Development', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b88',
						),
						array(
						'icon_value' => 'fa-code',
						'title'      => esc_html__( 'Unique and Clean', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b89',
						),
						array(
						'icon_value' => 'fa-users',
						'title'      => esc_html__( 'Satisfied Clients', 'spicebox' ),
						'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
						'choice'    => 'customizer_repeater_icon',
						'link'       => '#',
						'open_new_tab' => 'yes',
						'id'         => 'customizer_repeater_56d7ea7f40b91',
						),
						
					) );

				}
	}
	
add_action( 'customize_register', 'innofit_service_default_customize_register' );
	
endif;

// Innofit Testimonial content data
if ( ! function_exists( 'innofit_testimonial_default_customize_register' ) ) :
add_action( 'customize_register', 'innofit_testimonial_default_customize_register' );
function innofit_testimonial_default_customize_register( $wp_customize ){
				
				//Innofit default testimonial data.
				$innofit_testimonial_content_control = $wp_customize->get_setting( 'innofit_testimonial_content' );
				if ( ! empty( $innofit_testimonial_content_control ) ) 
				{
				$innofit_testimonial_content_control->default = json_encode( array(
					array(
					'title'      => 'Martin Wills',
					'text'       => 'We are so glad that we made the switch to use Innofit this year and our results were fantastic.',
					'designation' => __('Developer','spicebox'),
					'link'       => '#',
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/testimonial/user1.jpg',
					'open_new_tab' => 'no',
					'id'         => 'customizer_repeater_56d7ea7f40b96',
					
					),
					array(
					'title'      => 'Amanda Smith',
					'text'       => 'We are so glad that we made the switch to use Innofit this year and our results were fantastic.',
					'designation' => __('Team Leader','spicebox'),
					'link'       => '#',
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/testimonial/user2.jpg',
					'open_new_tab' => 'no',
					'id'         => 'customizer_repeater_56d7ea7f40b97',
					),
					array(
					'title'      => 'Travis Cullan',
					'text'       => 'We are so glad that we made the switch to use Innofit this year and our results were fantastic.',
					'designation' => __('Volunteer','spicebox'),
					'link'       => '#',
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/testimonial/user3.jpg',
					'id'         => 'customizer_repeater_56d7ea7f40b98',
					'open_new_tab' => 'no',
					),

				) );

			}
			
			
		}
endif;


// Innofit Team content data
if ( ! function_exists( 'innofit_team_default_customize_register' ) ) :
add_action( 'customize_register', 'innofit_team_default_customize_register' );
function innofit_team_default_customize_register( $wp_customize ){
				//Innofit default team data.
				$innofit_team_content_control = $wp_customize->get_setting( 'innofit_team_content' );
				if ( ! empty( $innofit_team_content_control ) ) 
				{
				$innofit_team_content_control->default = json_encode( array(
					array(
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/team/team1.jpg',
					'title'           => 'Danial Wilson',
					'subtitle'        => esc_html__( 'Senior Manager', 'spicebox' ),
					'open_new_tab' => 'no',
					'id'              => 'customizer_repeater_56d7ea7f40c56',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb908674e06',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9148530fc',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9150e1e89',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
							
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9150e1e256',
								'link' => 'behance.com',
								'icon' => 'fa-behance',
							),
						)
					),
				),
				array(
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/team/team2.jpg',
					'title'           => 'Amanda Smith',
					'subtitle'        => esc_html__( 'Founder & CEO', 'spicebox' ),
					'open_new_tab' => 'no',
					'id'              => 'customizer_repeater_56d7ea7f40c66',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9155a1072',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9160ab683',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb916ddffc9',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb916ddffc784',
								'link' => 'behance.com',
								'icon' => 'fa-behance',
							),
						)
					),
				),
				array(
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/team/team3.jpg',
					'title'           => 'Victoria Wills',
					'subtitle'        => esc_html__( 'Web Master', 'spicebox' ),
					'text'            => 'Pok pok direct trade godard street art, poutine fam typewriter food truck narwhal kombucha wolf cardigan butcher whatever pickled you.',
					'open_new_tab' => 'no',
					'id'              => 'customizer_repeater_56d7ea7f40c76',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb917e4c69e',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb91830825c',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
							
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb918d65f2e8',
								'link' => 'behance.com',
								'icon' => 'fa-behance',
							),
						)
					),
				),
				array(
					'image_url'  => SPICEB_PLUGIN_URL .'inc/innofit/images/team/team4.jpg',
					'title'           => 'Travis Marcus',
					'subtitle'        => esc_html__( 'UI Developer', 'spicebox' ),
					'open_new_tab' => 'no',
					'id'              => 'customizer_repeater_56d7ea7f40c86',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb925cedcb2',
								'link' => 'facebook.com',
								'icon' => 'fa-facebook',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb92615f030',
								'link' => 'twitter.com',
								'icon' => 'fa-twitter',
							),
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9266c223a',
								'link' => 'linkedin.com',
								'icon' => 'fa-linkedin',
							),
							
							array(
								'id'   => 'customizer-repeater-social-repeater-57fb9266c223a',
								'link' => 'behance.com',
								'icon' => 'fa-behance',
							),
						)
					),
				),
				
				) );

			}
}
endif;