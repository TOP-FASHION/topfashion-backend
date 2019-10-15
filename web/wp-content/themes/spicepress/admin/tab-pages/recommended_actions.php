<?php 
	$actions = $this->recommended_actions;
	$actions_todo = get_option( 'spicepress_recommended_actions', false );
?>
<div id="recommended_actions" class="spicepress-tab-pane panel-close">
<div class="action-list">
	<?php if($actions): foreach ($actions as $key => $action): ?>
	<div class="col-md-6">
	<div class="action" id="<?php echo esc_attr($action['id']); ?>">
		<div class="action-watch">
		<?php if(!$action['is_done']): ?>
			<?php if(!isset($actions_todo[$action['id']]) || !$actions_todo[$action['id']]): ?>
				<span class="dashicons dashicons-visibility"></span>
			<?php else: ?>
				<span class="dashicons dashicons-hidden"></span>
			<?php endif; ?>
		<?php else: ?>
			<span class="dashicons dashicons-yes"></span>
		<?php endif; ?>
		</div>
		<div class="action-inner">
			<h3 class="action-title"><?php echo esc_html($action['title']); ?></h3>
			<div class="action-desc"><?php echo wp_kses_post($action['desc']); ?></div>
			<?php echo $action['link']; ?>
		</div>
	</div>
	</div>
	<?php endforeach; endif; ?>
</div>
</div>