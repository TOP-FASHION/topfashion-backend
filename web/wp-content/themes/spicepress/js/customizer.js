/* global initializeAllElements */
( function( $ ) {

	
	//Slider title
	wp.customize(
		'home_slider_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.format-standard .slide-text-bg1 h1' ).text( newval );
				}
			);
		}
	);
	
	//Slider description
	wp.customize(
		'home_slider_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.format-standard .slide-text-bg1 p' ).text( newval );
				}
			);
		}
	);
	
	//Slider button
	wp.customize(
		'home_slider_btn_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-btn-sm' ).text( newval );
				}
			);
		}
	);
	
	// Service Heading
	wp.customize(
		'home_service_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-section .section-header .widget-title' ).text( newval );
				}
			);
		}
	);

	// Service Description
	wp.customize(
		'home_service_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-section .section-header p' ).text( newval );
				}
			);
		}
	);
	
	
	
	
	// Portfolio Heading
	wp.customize(
		'home_portfolio_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.portfolio-section .section-header .widget-title' ).text( newval );
				}
			);
		}
	);

	// Portfolio Description
	wp.customize(
		'home_portfolio_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.portfolio-section .section-header p' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio one image
	wp.customize(
		'portfolio_one_thumb', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port1 .post-thumbnail' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio one title
	wp.customize(
		'portfolio_one_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port1 .entry-header .entry-title > a' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio one description
	wp.customize(
		'portfolio_one_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port1 .entry-content p' ).text( newval );
				}
			);
		}
	);
	
	
	
	// Portfolio two image
	wp.customize(
		'portfolio_two_thumb', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port2 .post-thumbnail' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio two title
	wp.customize(
		'portfolio_two_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port2 .entry-header .entry-title > a' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio two description
	wp.customize(
		'portfolio_two_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port2 .entry-content p' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three image
	wp.customize(
		'portfolio_three_thumb', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port3 .post-thumbnail' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three title
	wp.customize(
		'portfolio_three_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port3 .entry-header .entry-title > a' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three description
	wp.customize(
		'portfolio_three_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port3 .entry-content p' ).text( newval );
				}
			);
		}
	);
	
	
	// Testimonial background image
	wp.customize(
		'testimonial_callout_background', function( value ) {
			value.bind(
				function( newval ) {
					$( 'section.testimonial-section' ).text( newval );
				}
			);
		}
	);
	
	
	
	
	// Testimonial Heading
	wp.customize(
		'home_testimonial_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-section .section-header h1' ).text( newval );
				}
			);
		}
	);

	// Testimonial Description
	wp.customize(
		'home_testimonial_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial-section .section-header p' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial description
	wp.customize(
		'home_testimonial_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.author-description p' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial title
	wp.customize(
		'home_testimonial_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testmonial-area h4' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial designation
	wp.customize(
		'home_testimonial_designation', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testmonial-area span.designation' ).text( newval );
				}
			);
		}
	);
	
	// Testimonial thumb image
	wp.customize(
		'home_testimonial_thumb', function( value ) {
			value.bind(
				function( newval ) {
					$( '.testmonial-area .author-box' ).text( newval );
				}
			);
		}
	);
	
	
	// Latest News Heading
	wp.customize(
		'home_news_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.home-news .section-header .widget-title' ).text( newval );
				}
			);
		}
	);

	// Latest News Description
	wp.customize(
		'home_news_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.home-news .section-header p' ).text( newval );
				}
			);
		}
	);
	
		
	
	
	
    // Footer Copyright Text
	wp.customize(
		'footer_copyright_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.site-footer .site-info p' ).text( newval );
				}
			);
		}
	);
	
} )( jQuery );