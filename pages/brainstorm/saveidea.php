<?php
/**
 * Add idea page
 *
 * @package Brainstorm
 */

$title = elgg_echo('idea:add');
elgg_push_breadcrumb($title);

$vars = brainstorm_prepare_form_vars();

$content = elgg_view_form('brainstorm/saveidea', array(), $vars);

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);