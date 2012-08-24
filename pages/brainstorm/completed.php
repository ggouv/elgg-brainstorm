<?php
/**
 * Elgg brainstorm plugin group page
 *
 * @package Brainstorm
 */
$page_owner = elgg_get_page_owner_entity();

elgg_push_breadcrumb($page_owner->name);
elgg_push_breadcrumb(elgg_echo('brainstorm:filter:completed'));

if ($page[2] != 'settings' && (elgg_get_logged_in_user_guid() == $page_owner->getOwnerGuid() || elgg_is_admin_logged_in())) {
	elgg_register_menu_item('title', array(
		'name' => 'settings',
		'href' => "brainstorm/group/$page_owner->guid/settings",
		'text' => elgg_echo('brainstorm:group_settings'),
		'link_class' => 'elgg-button elgg-button-action',
	));
}

$offset = (int)get_input('offset', 0);
$order_by = get_input('order', 'desc');

$content = elgg_list_entities_from_metadata(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner->guid,
	'metadata_names' => 'status',
	'metadata_values' => array ('completed', 'declined'),
	'limit' => 0,
	'offset' => $offset,
	'pagination' => false,
	'order_by' => 'time_created ' . $order_by,
	'full_view' => false,
	'list_class' => 'brainstorm-list',
	'item_class' => 'elgg-item-idea'
));

if (!$content) {
	$content = elgg_echo('brainstorm:none');
}

$title = elgg_echo('brainstorm:owner', array($page_owner->name));

$vars = array(
	'filter_context' => 'completed',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('brainstorm/sidebar'),
);

$body = elgg_view_layout('brainstorm', $vars);

echo elgg_view_page($title, $body);