<?php
/**
 * Elgg brainstorm plugin everyone page
 *
 * @package Brainstorm
 */

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('brainstorm'));

elgg_register_title_button();

if (elgg_is_logged_in()) {
	$form_vars = array('class' => 'brainstorm-form');
	$content .= elgg_view_form('brainstorm/add', $form_vars);
}

$offset = (int)get_input('offset', 0);
$content .= elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'limit' => 10,
	'offset' => $offset,
	'full_view' => false,
	'view_toggle_type' => false
));

$title = elgg_echo('brainstorm:everyone');

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('brainstorm/sidebar'),
));

echo elgg_view_page($title, $body);