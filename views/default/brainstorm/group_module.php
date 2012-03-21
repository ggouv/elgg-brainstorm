<?php
/**
 * List most recent ideas on group profile page
 *
 * @package Brainstorm
 */

$group_guid = elgg_get_page_owner_entity();

if ($group->brainstorm_enable == "no") {
	return true;
}

elgg_push_context('widgets');
elgg_pop_context();

$content = elgg_list_entities_from_annotation_calculation(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $group->guid,
	'annotation_names' => 'point',
	'order_by' => 'annotation_calculation desc',
	'view_toggle_type' => false,
	'full_view' => 'group_module',
	'item_class' => 'elgg-item-idea pts pbs',
	'list_class' => 'group-idea-list',
	'limit' => 6,
	'pagination' => false
));

if (!$content) {
	$content = '<p>' . elgg_echo('brainstorm:none') . '</p>';
}

$all_link = elgg_view('output/url', array(
	'href' => "brainstorm/group/$group->guid/all",
	'text' => elgg_echo('link:view:all'),
));

$new_link = elgg_view('output/url', array(
	'href' => "brainstorm/add/$group->guid",
	'text' => elgg_echo('brainstorm:add'),
));

echo elgg_view('groups/profile/module', array(
	'title' => elgg_echo('brainstorm:group'),
	'content' => $content,
	'all_link' => $all_link,
	'add_link' => $new_link,
));
