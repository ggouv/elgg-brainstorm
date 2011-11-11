<?php

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

$keyword = get_input('keyword', 'false');
	
if ( $keyword != 'false' ) {
	$group = get_input('group', 'false');
	
	if ( $group ) {

		$db_prefix = elgg_get_config('dbprefix');
	
		$params = array(
			'type' => 'object',
			'subtype' => 'idea',
			'container_guid' => $group,
			'limit' => 0,
			'pagination' => false,
			'full_view' => false,
			'view_toggle_type' => false,
			'item_class' => 'elgg-item-idea'
		);
		
		
		$likes = $keys = array();
		$keyword = sanitise_string($keyword);
		$keywords = explode(' ', $keyword);
		
		foreach ($keywords as $key) {
			if ( strlen($key) > 3 ) {
				$keys[] = $key;
				$likes[] = "oe.title LIKE '%$key%' OR oe.description LIKE '%$key%'";
			}
		}
		if ( !empty($keys) ) {
			$params['wheres'] = array('(' . implode(' OR ', $likes) . ')');
			$params['joins'] = array("JOIN {$db_prefix}objects_entity oe ON e.guid = oe.guid");
	
			$ideas = elgg_get_entities($params);
			
			// hightlight result. Protected against searching «elgg» or «brainstorm» or anything else can be found on class with elgg_list_entities
			foreach ( $ideas as $item => $idea ) {
				$excerpt_description = elgg_get_excerpt($idea->description, '300');
				foreach ($keys as $key) {
					$idea->title = preg_replace("/($key)/i", "<span class='brainstorm-highlight'>$1</span>", $idea->title);
					$excerpt_description = preg_replace("/($key)/i", "<span class='brainstorm-highlight'>$1</span>", $excerpt_description);
				}
				$idea->description = $excerpt_description;
			}
			
			$content =  elgg_list_entities(array(
				'items' => $ideas,
				'full_view' => 'searched',
				'item_class' => 'elgg-item-idea',
				'pagination' => false,
				'limit' => 0
			));
		}
		
		if ( $content ) {
			echo '<span>' . elgg_echo('brainstorm:search:find') . '</span>' .
				"<a class='elgg-button elgg-button-action' href='" . elgg_get_site_url() . "brainstorm/add/$group&title=$keyword'>" . elgg_echo('brainstorm:add') . '</a>'.
				$content;
		} else {
			echo '<span>' . elgg_echo('brainstorm:search:none') . '</span>' .
				"<a class='elgg-button elgg-button-action' href='" . elgg_get_site_url() . "brainstorm/add/$group&title=$keyword'>" . elgg_echo('brainstorm:add') . '</a>';
		}
	}
}