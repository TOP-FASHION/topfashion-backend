<?php
$file = SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/gallery2.jpg';
$ImagePath = SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio';

$images = array(
$ImagePath.'/gallery1.jpg', 
$ImagePath.'/gallery2.jpg',
$ImagePath.'/gallery3.jpg',
$ImagePath.'/gallery4.jpg',
$ImagePath.'/gallery5.jpg',
$ImagePath.'/gallery6.jpg',
$ImagePath.'/gallery7.jpg',
$ImagePath.'/gallery8.jpg',
$ImagePath.'/gallery9.jpg',
$ImagePath.'/gallery10.jpg',
$ImagePath.'/gallery11.jpg',
$ImagePath.'/gallery12.jpg',
$ImagePath. '/logo.png',
);

foreach($images as $name) {
$filename = basename($name);
$upload_file = wp_upload_bits($filename, null, file_get_contents($name));
if (!$upload_file['error']) {
	$wp_filetype = wp_check_filetype($filename, null );
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_parent' => $parent_post_id,
		'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
		'post_excerpt' => 'Portfolio caption',
		'post_status' => 'inherit'
	);
	$ImageId[] = $attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
	
	if (!is_wp_error($attachment_id)) {
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
		wp_update_attachment_metadata( $attachment_id,  $attachment_data );
	}
}

}

 update_option( 'portfolio_media_id', $ImageId );

?>
