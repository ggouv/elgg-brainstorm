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
$fb->info($page_owner->guid, '$page_owner->guid');

$idea109 = get_entity('104');
//$idea109->status = 'started';
//$annotation = new ElggObject($idea109->getGUID());
//create_annotation($annotation->getGUID(),'status','open','string',$user_id,$annotation->getAccessID());
$fb->info($idea109);
$fb->info($idea109->status_info);
//$idea = get_entity('99'); $idea->delete();
//elgg_delete_annotations(array('annotation_names' => 'point', 'annotation_owner_guids' => $user_id));

/*$userIdeas = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner->guid,
	'owner_guid' => $user_id,
	'metadata_names' => 'status',
	'metadata_values' => array('open', 'accepted')
));

foreach( $userIdeas as $idea) {
	$ideas[] = $idea->guid;
}
$fb->info($ideas);


['wheres'] =>
array(

[0] =>
'(((msn.string IN ('status')) AND ( BINARY msv.string IN ('close')) AND ( (1 = 1) and n_table.enabled='yes')))'
)
['joins'] =>
array(

[0] =>
'JOIN elgg_metadata n_table on
e.guid = n_table.entity_guid'
[1] =>
'JOIN elgg_metastrings msn on n_table.name_id = msn.id'
[2] =>
'JOIN elgg_metastrings msv on n_table.value_id = msv.id'
)*/
$options = array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner->guid,
	'annotation_owner_guids' => $user_id,
	'annotation_names' => array('point', 'status'),
	'annotation_values' => 'open',
// 	'annotation_calculation' => 'sum',
// 	'wheres' => array("(((Xmsn.string IN ('status')) AND ( BINARY Xmsv.string IN ('close')) AND ( (1 = 1) and n_table.enabled='yes')))"),
// 	'joins' => array('JOIN elgg_metadata X_table on e.guid = X_table.entity_guid','JOIN elgg_metastrings Xmsn on X_table.name_id = Xmsn.id', 
// 	'JOIN elgg_metastrings Xmsv on X_table.value_id = Xmsv.id')
);
$userVote = elgg_get_annotations($options);
$fb->info($userVote);
/*
$userVote = elgg_get_annotations(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner->guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'annotation_owner_guids' => $user_id,
//	'metadata_names' => 'status',
//	'metadata_values' => 'close'
));
$fb->info($userVote);
*/
$content = elgg_get_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'idea',
	'metadata_names' => 'status',
	'metadata_values' => 'close',
	'container_guid' => $page_owner->guid,
));
/*$content = elgg_get_entities_from_annotations(array(
	'type' => 'object',
	'subtype' => 'idea',
	'metadata_names' => 'status',
	'metadata_values' => 'close',
//	'container_guid' => $page_owner->guid,
//	'limit' => 10,
	'annotation_names' => 'point',
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea'
));/*
$content = elgg_get_entities_from_annotation_calculation(array(
	'type' => 'object',
	'subtype' => 'idea',
	'metadata_names' => 'status',
	'metadata_values' => 'close',
	'container_guid' => $page_owner->guid,
//	'limit' => 10,
//	'offset' => $offset,
	'annotation_names' => 'point',
	'order_by' => 'annotation_calculation asc',
	'full_view' => false,
	'view_toggle_type' => false,
	'item_class' => 'elgg-item-idea'
));
*/$fb->info($content, 'idea');
/*
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
*/



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