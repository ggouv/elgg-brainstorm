<?php
/**
 * Elgg brainstorm plugin friends page
 *
 * @package Brainstorm
 */
$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('brainstorm/all');
}

elgg_push_breadcrumb($page_owner->name, "brainstorm/owner/$page_owner->username");
elgg_push_breadcrumb(elgg_echo('friends'));

$friends = get_user_friends($page_owner->guid, "", 999999, 0);
$friendguids = array();
foreach ($friends as $friend) {
	$friendguids[] = $friend->getGUID();
}

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'owner_guids' => $friendguids,
	'limit' => 10,
	'pagination' => true,
	'full_view' => 'no_vote',
	'list_class' => 'brainstorm-list',
	'item_class' => 'elgg-item-idea'
));

if (!$content) {
	$content = elgg_echo('brainstorm:none');
}

$title = elgg_echo('brainstorm:friends');

$vars = array(
	'filter_context' => 'friends',
	'content' => $content,
	'title' => $title,
	//'sidebar' => elgg_view('brainstorm/sidebar'),
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);