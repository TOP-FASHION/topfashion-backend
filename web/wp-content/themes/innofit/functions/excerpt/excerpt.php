<?php
// new and event
function innofit_get_news_event_excerpt()
{
		global $post;
		$excerpt = get_the_content();
		$excerpt = strip_tags(preg_replace(" (\[.*?\])",'',$excerpt));
		$excerpt = strip_shortcodes($excerpt);
		$original_len = strlen($excerpt);
		$excerpt = substr($excerpt, 0,80);
		$len=strlen($excerpt);
		if($original_len>25) {
		$excerpt = $excerpt;
		return '<p>'.$excerpt . '...</p>';
		}
		else
		{ 
			return '<p>'.$excerpt.'</p>'; 
		}
}