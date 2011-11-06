<?php
/**
 * Elgg brainstorm plugin hot page
 *
 * @package Brainstorm
 */
global $fb; 

$idea_guid = (int)get_input('idea');
$value = (int)get_input('value');

$user_id = elgg_get_logged_in_user_guid();

$fb->info($user_id, 'userID');
$fb->info($page_owner->guid);


//$idea = get_entity('99'); $idea->delete();
//elgg_delete_annotations(array('annotation_names' => 'point', 'annotation_owner_guids' => $user_id));

$content = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
//	'container_guid' => $page_owner->guid,
//	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea'
));
/*$content = elgg_get_entities_from_annotation_calculation(array(
	'type' => 'object',
	'subtype' => 'idea',
//	'container_guid' => $page_owner->guid,
	'limit' => 10,
	'offset' => $offset,
	'annotation_names' => 'point',
	'order_by' => 'annotation_calculation asc',
	'full_view' => false,
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea'
));*/
$fb->info($content, 'idea');

$annotation = elgg_get_annotations(array(
//	'guids' => $idea_guid,
	'annotation_names' => 'point',
//	'annotation_owner_guids' => $user_id,
));
$fb->info($annotation,'all');

$sum = elgg_get_annotations(array(
	'guids' => $idea_guid,
	'annotation_names' => 'point',
	'annotation_owner_guids' => $user_id,
	'annotation_calculation' => 'sum'
));
//$fb->info($sum,'sum');




$vars = array('filter_context' => 'hot');
$body = elgg_view_layout('brainstorm', $vars);

echo elgg_view_page($title, $body);
/*$page_owner = elgg_get_page_owner_entity();

elgg_push_breadcrumb($page_owner->name);

elgg_register_title_button();

$offset = (int)get_input('offset', 0);
$content .= elgg_list_entities_from_annotation_calculation(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner->guid,
	'limit' => 10,
	'offset' => $offset,
	'annotation_names' => 'point',
	'order_by' => 'annotation_calculation asc',
	'full_view' => false,
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea'
));

if (!$content) {
	$content = elgg_echo('brainstorm:none');
}

$title = elgg_echo('brainstorm:owner', array($page_owner->name));

$filter_context = 'top';
if ($page_owner->getGUID() == elgg_get_logged_in_user_guid()) {
	$filter_context = 'top';
}

$vars = array(
	'filter_context' => $filter_context,
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('brainstorm/sidebar'),
);

// don't show filter if out of filter context
if ($page_owner instanceof ElggGroup) {
	//$vars['filter'] = false;
}

$body = elgg_view_layout('brainstorm', $vars);

echo elgg_view_page($title, $body);*/