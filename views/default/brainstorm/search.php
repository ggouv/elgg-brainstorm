<?php

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

$keyword = get_input('keyword', 'false');
	global $fb; $fb->info($keyword);	
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
			'item_class' => 'elgg-item-idea',
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
		
		$params['wheres'] = array('(' . implode(' OR ', $likes) . ')');
		$params['joins'] = array("JOIN {$db_prefix}objects_entity oe ON e.guid = oe.guid");

		$content = elgg_list_entities($params);

		foreach ($keys as $key) {
			$content = preg_replace("/($key)/i", "<span class='brainstorm-highlight'>$1</span>", $content);
		}

		if ( $content ) {
			echo $content;
		} else {
			echo elgg_echo('brainstorm:search:none');
		}
	}
}