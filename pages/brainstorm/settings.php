<?php
/**
 * Brainstorm group settings page
 *
 * @package Brainstorm
 */
gatekeeper();
group_gatekeeper();

$page_owner = elgg_get_page_owner_entity();

/*elgg_push_breadcrumb('brainstorm');
elgg_push_breadcrumb('settings');*/

$vars = brainstorm_group_settings_prepare_form_vars($page_owner);

$content = elgg_view_form('brainstorm/settings', array(), $vars);

$title = elgg_echo('brainstorm:group:settings:title', array($page_owner->name));

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
));

echo elgg_view_page($title, $body);