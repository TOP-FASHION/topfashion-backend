<?php
	$MediaId = get_option('portfolio_media_id');
	// Create a Portfolio page 
	 $post = array(
		  'comment_status' => 'closed',
		  'ping_status' =>  'closed' ,
		  'post_author' => 1,
		  'post_date' => date('Y-m-d H:i:s'),
		  'post_name' => 'Portfolio',
		  'post_status' => 'publish' ,
		  'post_title' => 'Portfolio',
		  'post_type' => 'page',
		  'post_content' => '[gallery size="full" ids="'. $MediaId[0].','
		  .$MediaId[1].','.$MediaId[2].','.$MediaId[3].','.$MediaId[4].','.
		  $MediaId[5].','.$MediaId[6].','.$MediaId[7].','.$MediaId[8].','.
		  $MediaId[9].','.$MediaId[10].','.$MediaId[11].'"]'
	);  
	//insert page and save the id
	$newvalue = wp_insert_post( $post, false );
	if ( $newvalue && ! is_wp_error( $newvalue ) ){
		update_post_meta( $newvalue, '_wp_page_template', 'template/template-page-full-width.php' );
	}
?>