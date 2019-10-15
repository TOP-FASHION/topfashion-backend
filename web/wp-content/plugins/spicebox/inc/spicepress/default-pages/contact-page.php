<?php
        // Create a Contact us page 
         $post = array(
              'comment_status' => 'closed',
              'ping_status' =>  'closed' ,
              'post_author' => 1,
              'post_date' => date('Y-m-d H:i:s'),
              'post_name' => 'Contact',
              'post_status' => 'publish' ,
              'post_title' => 'Contact',
              'post_type' => 'page',
              'post_content' => '[contact-form-7 id="6" title="Contact form 1"]'
        );  
        //insert page and save the id
        $newvalue = wp_insert_post( $post, false );
        if ( $newvalue && ! is_wp_error( $newvalue ) ){
            update_post_meta( $newvalue, '_wp_page_template', 'template/template-contact.php' );
        }
?>