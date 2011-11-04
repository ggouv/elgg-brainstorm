<?php
/**
 * Brainstorm group sidebar
 */
$user = elgg_get_logged_in_user_entity();
$page_owner = elgg_get_page_owner_entity();

if ($page_owner->isMember($user)) {

	echo elgg_view('brainstorm/sidebar-points');
	
	echo elgg_view('page/elements/comments_block', array(
		'subtypes' => 'idea',
		'owner_guid' => elgg_get_page_owner_guid(),
	));
	
	echo elgg_view('page/elements/tagcloud_block', array(
		'subtypes' => 'idea',
		'owner_guid' => elgg_get_page_owner_guid(),
	));

}