<?php
/**
 * The default template for comments
 */
if ( post_password_required() ) : ?>
	<p class="nopassword"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.','spicepress' ); ?></p>
<?php 
	return;
endif;

// Spicepress comment part
if( !function_exists('spicepress_comments') ):
function spicepress_comments( $comment, $args, $depth ){
	
	$GLOBALS['comment'] = $comment;
	
	//get theme data
	global $comment_data;
	
	//translations
	$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply','spicepress');
?>
<!--Comment-->
<div <?php comment_class('media comment-box'); ?> id="comment-<?php comment_ID(); ?>">
	<a class="pull-left-comment" href="<?php the_author_meta('user_url'); ?>">
		<?php echo get_avatar( $comment , $size = 70 ); ?>
	</a>
	<div class="media-body">
		<div class="comment-detail">
			<h6 class="comment-detail-title"><?php esc_html(comment_author()); ?> <span class="comment-date"><?php esc_html_e('Posted on','spicepress'); ?><?php  echo esc_html(comment_time('g:i a')); ?><?php echo " - "; echo esc_html(comment_date('M j, Y'));?></span></h6>
			<p><?php comment_text(); ?></p>
			
			<?php edit_comment_link( esc_html__( 'Edit','spicepress' ), '<p class="edit-link">', '</p>' ); ?>
					
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'spicepress' ); ?></em><br/>
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
<article class="comment-section wow fadeInDown animated" data-wow-delay="0.4s">
	<div class="comment-title"><h3><i class="fa fa-comment-o"></i> <?php comments_number ( esc_html__('No comments so far','spicepress'), esc_html__( '1 comment so far','spicepress'), esc_html__('% Comments','spicepress') ); ?></h3></div>				
	<?php wp_list_comments( array( 'callback' => 'spicepress_comments' ) ); ?>			
</article>
<!--/Comment Section-->
<?php endif; ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
<nav id="comment-nav-below">
	<h1 class="assistive-text"><?php esc_html_e( 'Comment navigation', 'spicepress' ); ?></h1>
	<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'spicepress' ) ); ?></div>
	<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'spicepress' ) ); ?></div>
</nav>
<?php endif; ?>

<?php if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'spicepress' ); ?></p>
<?php endif; ?>


<?php if ('open' == $post->comment_status) :
	if ( get_option('comment_registration') && !$user_ID ): ?>
		<p><?php echo sprintf( wp_kses( 'You must be <a href="%s">logged in</a> to post a comment','spicepress' ), esc_url(site_url( 'wp-login.php' )) . '?redirect_to=' .  urlencode(esc_url(get_permalink()))); ?></p>
		<?php else:
	
	echo '<article class="comment-form-section wow fadeInDown animated" data-wow-delay="0.4s">';
	
	$fields = array(
	'author'=>'<div class="blog-form-group"><input type="text" name="author" id="author" placeholder="'.esc_attr__('Name','spicepress').'" class="blog-form-control"></div>',
	'email'=>'<div class="blog-form-group"><input type="text" name="email" id="email" placeholder="'.esc_attr__('Email','spicepress').'" class="blog-form-control"></div>',
	);
	
	function spicepress_fields( $fields )
	{
		return $fields;
	}
	add_filter('comment_form_default_fields','spicepress_fields');
	
	$defaults = array(
		
		'fields'=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'=>'<div class="blog-form-group-textarea"><textarea id="comments" name="comment" placeholder="'.esc_attr__('Message','spicepress').'" class="blog-form-control-textarea" rows="5"></textarea></div>',
		'logged_in_as'=>'<p class="blog-post-info-detail">' . esc_html__( "Logged in as",'spicepress').' '.'<a href="'. esc_url(admin_url( 'profile.php' )).'">'.$user_identity.'</a>'. ' <a href="'. esc_url(wp_logout_url( get_permalink() )).'" title="'.esc_attr__('Logout of this account','spicepress').'">'.esc_html__("Log out",'spicepress').'</a>' . '</p>',
		'id_submit'=> 'blogdetail-btn',
		'label_submit'=> esc_html__('Send Message','spicepress'),
		'class_submit'=>'blogdetail-btn',
		'comment_notes_after'=> '',
		'comment_notes_before' => '',
		'title_reply'=> '<div class="comment-title"><h3><i class="fa fa-comment-o"></i>'.esc_html__('Leave a Reply', 'spicepress').'</h3></div>',
		'id_form'=> 'commentform'
		
	);
	ob_start();
	comment_form($defaults);
	echo str_replace('class="comment-form"','class="form-inline"',ob_get_clean());
	
	echo '</article>';
	
	endif;
endif;

if ( ! comments_open() && ! is_page() ) : 
    esc_html_e("Comments are closed.",'spicepress');
endif; 
?>