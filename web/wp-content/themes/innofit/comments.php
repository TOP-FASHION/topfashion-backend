<?php
/**
 * The default template for comments
 */
if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.','innofit' ); ?></p>
<?php 
	return;
endif;

// Innofit comment part
if( !function_exists('innofit_comments') ):
function innofit_comments( $comment, $args, $depth ){
	
	//get theme data
	global $comment_data;
	
	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : esc_html__('Reply','innofit');
?>
<!--Comment-->
<div <?php comment_class('media comment-box'); ?> id="comment-<?php comment_ID(); ?>">
	<a class="pull-left-comment" href="<?php the_author_meta('user_url'); ?>">
		<?php echo get_avatar( $comment , $size = 70 ); ?>
	</a>
	<div class="media-body">
		<div class="comment-detail">
			<h6 class="comment-detail-title"><?php comment_author(); ?> </h6>
			<span class="comment-date"><?php esc_html_e('Posted on ','innofit'); ?><?php   comment_time('g:i a'); ?><?php echo " - ";  comment_date('M j, Y');?></span>
			<?php comment_text(); ?>
			
			<?php edit_comment_link( esc_html__( 'Edit','innofit' ), '<p class="edit-link">', '</p>' ); ?>
					
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'innofit' ); ?></em><br/>
			<?php endif; ?>
			
			<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth'], 'per_page' => $args['per_page']))) ?>
			</div>
			
		</div>	
	</div>
</div>
<!--/Comment-->
<?php
}
endif;
?>

<?php if( have_comments() ): ?>				
<!--Comment Section-->
<article class="comment-section">
	<div class="comment-title"><h5><?php comments_number ( esc_html__('No comments so far','innofit'), esc_html__( '1 comment so far','innofit'), esc_html__('% Comments','innofit') ); ?></h5></div>				
	<?php wp_list_comments( array( 'callback' => 'innofit_comments' ) ); ?>			
</article>
<!--/Comment Section-->
<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav id="comment-nav-below">
	<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'innofit' ); ?></h1>
	<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'innofit' ) ); ?></div>
	<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'innofit' ) ); ?></div>
</nav>
<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'innofit' ); ?></p>
<?php endif; ?>


<?php if ('open' == $post->comment_status) :
	if ( get_option('comment_registration') && !$user_ID ): ?>
		<p><?php echo sprintf( 	wp_kses(
											/* translators: %s is Link to login */
											__( 'You must be <a href="%s">logged in</a> to post a comment.', 'innofit' ),
											array(
												'a' => array(
													'href' => array(),
												),
											)
										), esc_url(site_url( 'wp-login.php' )) . '?redirect_to=' .  urlencode(esc_url(get_permalink()))); ?></p>
		<?php else:
	
	echo '<article class="comment-form-section">';
	
	$fields = array(
	'author'=>'<div class="col-lg-4 col-xs-12"><input type="text" name="author" id="author" placeholder="'.esc_attr__('Name','innofit').'"></div>',
	'email'=>'<div class="col-lg-4 col-xs-12"><input type="text" name="email" id="email" placeholder="'.esc_attr__('Email','innofit').'"></div>',
	'website'=> '<div class="col-lg-4 col-xs-12"><input type="text" name="website" id="website" placeholder="'.esc_attr__('Website','innofit').'"></div>',
	);
	
	function innofit_fields( $fields )
	{
		return $fields;
	}
	add_filter('comment_form_default_fields','innofit_fields');
	
	$defaults = array(
		
		'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'=>'<div class="col-lg-12"><textarea id="comments" name="comment" placeholder="'.esc_attr__('Message','innofit').'" rows="5"></textarea></div>',
		'logged_in_as'=>'<p class="blog-post-info-detail">' . esc_html__( "Logged in as",'innofit').' '.'<a href="'. esc_url(admin_url( 'profile.php' )).'">'.$user_identity.'</a>'. ' <a href="'. esc_url(wp_logout_url( get_permalink() )).'" title="'.esc_attr__('Log out of this account','innofit').'">'.esc_html__("Logout",'innofit').'</a>' . '</p>',
		'id_submit'=> 'blogdetail-btn',
		'label_submit'=>esc_html__('Send Message','innofit'),
		'class_submit'=>'more-link btn-small dark',
		'comment_notes_after'=> '',
		'comment_notes_before' => '',
		'title_reply'=> '<div class="comment-title"><h5>'.esc_html__('Leave a Reply', 'innofit').'</h5></div>',
		'id_form'=> 'commentform'
		
	);
	ob_start();
	comment_form($defaults);
	echo str_replace('class="comment-form"','class="form-inline"',ob_get_clean());
	
	echo '</article>';
	
	endif;
endif; 
?>