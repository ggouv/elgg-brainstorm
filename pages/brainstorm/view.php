<?php
/**
 * View an idea
 *
 * @package Brainstorm
 */

$idea = get_entity(get_input('guid'));

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "brainstorm/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "brainstorm/owner/$page_owner->username");
}

$title = $idea->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($idea, array('full_view' => 'full'));
$content .= elgg_view_comments($idea);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
	'sidebar' => '<h3 class="mbm">' . elgg_echo('brainstorm:same_group') . '</h3>' . elgg_view('brainstorm/sidebar')
));

echo elgg_view_page($title, $body);
