<?php
/**
 * Edit idea page
 *
 * @package Brainstorm
 */
 
$idea_guid = get_input('guid');
$idea = get_entity($idea_guid);

if (!elgg_instanceof($idea, 'object', 'idea') || !$idea->canEdit()) {
	register_error(elgg_echo('brainstorm:unknown_idea'));
	forward(REFERRER);
}

elgg_push_breadcrumb(elgg_echo('brainstorm:edit'));
elgg_push_breadcrumb($idea->title, $idea->getURL());

$vars = brainstorm_prepare_form_vars($idea);

$content = elgg_view_form('brainstorm/editidea', array(), $vars);

$title = elgg_echo('brainstorm:idea:edit');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);