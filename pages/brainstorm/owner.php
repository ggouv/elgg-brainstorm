<?php
/**
 * Elgg brainstorm plugin owner page
 *
 * @package Brainstorm
 */
$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('brainstorm/all');
}

elgg_push_breadcrumb($page_owner->name);

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'owner_guid' => $page_owner->guid,
	'limit' => 0,
	'pagination' => false,
	'full_view' => 'no_vote',
	'list_class' => 'brainstorm-list',
	'item_class' => 'elgg-item-idea'
));

if (!$content) {
	$content = elgg_echo('brainstorm:none');
}

$title = elgg_echo('brainstorm:owner', array($page_owner->name));

$filter_context = '';
if ($page_owner->guid == elgg_get_logged_in_user_guid()) {
	$filter_context = 'mine';
}

$vars = array(
	'filter_context' => $filter_context,
	'content' => $content,
	'title' => $title,
	//'sidebar' => elgg_view('brainstorm/sidebar'),
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);