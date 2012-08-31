<?php
/**
 * Add idea page
 *
 * @package Brainstorm
 *
 * input search come from search.php
 */

elgg_push_breadcrumb(elgg_echo('brainstorm:idea:add'));

if ($idea && !$idea->canWritetoContainer()) {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERRER);
}

$vars = brainstorm_prepare_form_vars();

$content = elgg_view_form('brainstorm/saveidea', array(), $vars);

$title = elgg_echo('brainstorm:idea:add');

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);