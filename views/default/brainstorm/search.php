<?php

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

$keyword = get_input('keyword', 'false');
$point = (int)get_input('point', 1);

if ( $keyword != 'false' ) {
	$group_guid = (int)get_input('group', 'false');
	
	if ( $group_guid ) {

		$db_prefix = elgg_get_config('dbprefix');
	
		$params = array(
			'type' => 'object',
			'subtype' => 'idea',
			'container_guid' => $group_guid,
			'limit' => 0,
			'pagination' => false,
			'full_view' => false,
			'item_class' => 'elgg-item-idea'
		);
		
		$likes = $keys = array();
		$keyword = sanitise_string($keyword);
		$keywords = explode(' ', $keyword);
		$skip_words = explode(',', elgg_echo('brainstorm:search:skip_words'));
		
		foreach ($keywords as $key) {
			if ( strlen($key) > 2 && !in_array($key, $skip_words) ) {
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
		
		$group = get_entity($group_guid);
		if (!$subimt_w_point = $group->brainstorm_submit_idea_without_point) $subimt_w_point = '0';

		$button = "<a class='elgg-button elgg-button-action' href='" . elgg_get_site_url() . "brainstorm/add/$group_guid/&search=$keyword'>" . elgg_echo('brainstorm:add') . '</a>';
		
		if ($content) {
			if ($point > 0) $html = '<span>' . elgg_echo('brainstorm:search:result_vote_submit') . '</span>' . $button;
			if ($subimt_w_point == 'on' && $point <= 0) $html = '<span>' . elgg_echo('brainstorm:search:result_novote_submit') . '</span>' . $button;
			if ($subimt_w_point == '0' && $point <= 0) $html = '<span>' . elgg_echo('brainstorm:search:result_novote_nosubmit') . '</span>';
			$html .= $content;
		} else {
			if ($subimt_w_point == '0' && $point <= 0) {
				$html = '<span>' . elgg_echo('brainstorm:search:noresult_nosubmit') . '</span>';
			} else {
				$html = '<span>' . elgg_echo('brainstorm:search:noresult_submit') . '</span>' . $button;
			}
		}
		echo $html;
	}
}