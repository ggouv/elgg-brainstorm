<?php
/**
 * Brainstorm group sidebar
 */
$page_owner = elgg_get_page_owner_entity();

if ($page_owner->isMember($user)) {

	echo elgg_view('brainstorm/sidebar-points');
	
	$body = elgg_view('brainstorm/sidebar-idea');
	echo elgg_view_module('aside', '', $body);
	
	echo elgg_view('page/elements/tagcloud_block', array(
		'subtypes' => 'idea',
		'owner_guid' => $page_owner->guid,
	));

}