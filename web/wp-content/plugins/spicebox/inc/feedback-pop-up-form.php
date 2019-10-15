<div class="dialog-widget dialog-lightbox-widget dialog-type-buttons dialog-type-lightbox" id="spicepress-deactivate-feedback-modal" style="display: block;">
	<div class="dialog-widget-content dialog-lightbox-widget-content" style="top: 173px; left: 550px;">
	<div class="dialog-widget-header dialog-lightbox-widget-header">
		<div id="spicepress-deactivate-feedback-dialog-header">
		
			<span id="spicepress-deactivate-feedback-dialog-header-title"><?php _e('Quick Feedback', 'spicepress');?></span><br>
			<p style="color:#ffffff; font-weight: 400; font-size: 14px;
    margin: 8px 0 0px;"> <?php _e('Your feedback is valuable for us.','spicepress');?> </p>
		</div>
	</div>
	<div class="dialog-message dialog-lightbox-message">
    <form id="spicepress-deactivate-feedback-dialog-form" method="post">
		
		<input type="hidden" name="ajaxurl" id="ajaxurl" value="<?php echo SPICEB_PLUGIN_URL.'feedback-mail.php'?>">
		<input type="hidden" name="plugin_site" id="plugin_site" value='<?php echo get_home_url(); ?>'>
		<input type="hidden" name="admin_mail" id="admin_mail" value="<?php echo get_option('admin_email'); ?>">
		<div id="spicepress-deactivate-feedback-dialog-form-caption"><?php echo _e('What we have done wrong?','spicepress');?></div>
		<div id="spicepress-deactivate-feedback-dialog-form-body">
			<div class="spicepress-deactivate-feedback-dialog-input-wrapper">
				<input id="spicepress-deactivate-feedback-no_longer_needed" class="spicepress-deactivate-feedback-dialog-input" type="radio" name="reason_key" checked value="It lacks options">
				<label for="spicepress-deactivate-feedback-no_longer_needed" class="spicepress-deactivate-feedback-dialog-label"><?php _e('Very limited options','spicepress');?></label>
										
			</div>
			<div class="spicepress-deactivate-feedback-dialog-input-wrapper">
				<input id="spicepress-deactivate-feedback-found_a_better_plugin" class="spicepress-deactivate-feedback-dialog-input" type="radio" name="reason_key" value="I want to try a new design, I don't like Spicepress style">
				<label for="spicepress-deactivate-feedback-found_a_better_plugin" class="spicepress-deactivate-feedback-dialog-label"><?php _e("I want to try a new design, I don't like Spicepress style","spicepress");?></label>
				<textarea class="spicepress-feedback-text" id="reason_found_a_better_plugin" name="reason_found_a_better_plugin" placeholder="<?php _e('If possible tell us the name of the theme you have selected','spicepress'); ?>"></textarea>
			</div>
			<div class="spicepress-deactivate-feedback-dialog-input-wrapper">
				<input id="spicepress-deactivate-feedback-couldnt_get_the_plugin_to_work" class="spicepress-deactivate-feedback-dialog-input" type="radio" name="reason_key" value="Is not working with a plugin that I need">
				<label for="spicepress-deactivate-feedback-couldnt_get_the_plugin_to_work" class="spicepress-deactivate-feedback-dialog-label"><?php _e('Is not working with a plugin that I need','spicepress');?></label>
				<textarea class="spicepress-feedback-text" id="reason_not_working_with_needed_plugin" name="reason_not_working_with_needed_plugin" placeholder="<?php _e('Plugin Name','spicepress'); ?>"></textarea>
			</div>
			<div class="spicepress-deactivate-feedback-dialog-input-wrapper">
				<input id="spicepress-deactivate-feedback-temporary_deactivation" class="spicepress-deactivate-feedback-dialog-input" type="radio" name="reason_key" value="I don't know how to make it look like demo">
				<label for="spicepress-deactivate-feedback-temporary_deactivation" class="spicepress-deactivate-feedback-dialog-label"><?php _e("I don't know how to make it look like demo",'spicepress');?></label>
			</div>
			<div class="spicepress-deactivate-feedback-dialog-input-wrapper">
				<input id="spicepress-deactivate-feedback-other" class="spicepress-deactivate-feedback-dialog-input reason_key5" type="radio" name="reason_key" value="Other">
				<label for="spicepress-deactivate-feedback-other" class="spicepress-deactivate-feedback-dialog-label"><?php _e('Other','spicepress');?></label>
				<textarea class="spicepress-feedback-text" name="reason_other" id="reason_other" placeholder="<?php _e('Please share the reason','spicepress');?>"></textarea>
			</div>
		</div>
    </form>
	</div>
	<div class="dialog-buttons-wrapper dialog-lightbox-buttons-wrapper"><button  class="dialog-button dialog-submit dialog-lightbox-submit" name="submit" id="submit"><?php _e('Submit','spicepress');?></button>
	<button onclick="window.location.reload()"; class="dialog-button dialog-skip dialog-lightbox-skip"><?php _e('Skip &amp; Deactivate','spicepress');?></button>
	</div>
	</div>
</div>
	<?php
	unset( $_GET['action'] );
    require ABSPATH . 'wp-admin/themes.php';

?>