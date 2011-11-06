<?php
/**
 * Brainstorm ideas of user sidebar
 */
$user = elgg_get_logged_in_user_guid();
$page_owner = elgg_get_page_owner_guid();

echo elgg_echo('brainstorm:youridea');

$ideas = elgg_get_entities_from_annotations(array(
	'type' => 'object',
	'subtype' => 'idea',
	'annotation_owner_guids' => $user,
	'container_guid' => $page_owner,
	'annotation_names' => 'point',
	'full_view' => 'sidebar',
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea',
	'list_class' => 'sidebar-idea-list'
));

foreach( $ideas as $key => $idea) {
	$sum = elgg_get_annotations(array(
		'guids' => $idea->guid,
		'annotation_names' => 'point',
		'annotation_calculation' => 'sum',
		'annotation_owner_guids' => $user
	));
	if ($sum == 0) unset($ideas[$key]);
}

global $fb; $fb->info($ideas);

echo elgg_list_entities(array(
	'items' => $ideas,
	'full_view' => 'sidebar',
	'item_class' => 'elgg-item-idea',
	'list_class' => 'sidebar-idea-list',
	'pagination' => false,
	'offset' => 10
));
