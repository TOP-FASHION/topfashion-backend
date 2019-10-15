<div id="one_click_demo" class="innofit-tab-pane panel-close">
    <?php 
	$actions = $this->recommended_actions;
	$actions_todo = get_option( 'innofit_recommended_actions', false );
	$spicebox = $actions[0];
?>
<div class="action-list">
	<?php if($spicebox):?>
	<div class="action" id="">
		<div class="action-watch">
		<?php if(!$spicebox['is_done']): ?>
			<?php if(!isset($actions_todo[$spicebox['id']]) || !$actions_todo[$spicebox['id']]): ?>
				<span class="dashicons dashicons-visibility"></span>
			<?php else: ?>
				<span class="dashicons dashicons-hidden"></span>
			<?php endif; ?>
		<?php else: ?>
			<span class="dashicons dashicons-yes"></span>
		<?php endif; ?>
		</div>
		<div class="action-inner">
			<h3 class="action-title"><?php echo esc_html($spicebox['title']); ?></h3>
			<div class="action-desc"><?php echo wp_kses_post($spicebox['desc']); ?></div>
			<?php echo $spicebox['link']; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
</div>