<?php
/**
 * Elgg brainstorm plugin all page
 *
 * @package Brainstorm
 */

elgg_push_breadcrumb(elgg_echo('brainstorm:all'));

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'limit' => 10,
	'pagination' => true,
	'full_view' => 'no_vote',
	'list_class' => 'brainstorm-list',
	'item_class' => 'elgg-item-idea'
));

if (!$content) {
	$content = elgg_echo('brainstorm:none');
}

$title = elgg_echo('brainstorm:all');

$vars = array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	//'sidebar' => elgg_view('brainstorm/sidebar'),
);

$body = elgg_view_layout('content', $vars);

echo elgg_view_page($title, $body);