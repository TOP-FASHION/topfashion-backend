<?php
	// Create a about us page 
	 $post = array(
		  'comment_status' => 'closed',
		  'ping_status' =>  'closed' ,
		  'post_author' => 1,
		  'post_date' => date('Y-m-d H:i:s'),
		  'post_name' => 'About',
		  'post_status' => 'publish' ,
		  'post_title' => 'About',
		  'post_type' => 'page',
		  'post_content' => '<div class="col-md-6 col-sm-6 col-xs-12">
		  <div class="about-img-area wow fadeInDown animated animated animated animated animated" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;" data-wow-delay="0.4s"><img class="img-responsive" src="'. SPICEB_PLUGIN_URL .'inc/spicepress/images/about/about.jpg" alt="Image" /></div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown animated animated animated animated animated" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInDown;" data-wow-delay="0.4s">
			<h2>We provide best services in the world.
			</h2>
			There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable.
			If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
			</div>'
	);  
	//insert page and save the id
	$newvalue = wp_insert_post( $post, false );
	if ( $newvalue && ! is_wp_error( $newvalue ) ){
		update_post_meta( $newvalue, '_wp_page_template', 'template/template-about.php' );
	}
?>