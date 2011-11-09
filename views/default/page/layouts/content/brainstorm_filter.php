<?php
/**
 * Main content filter
 *
 * @package Brainstorm
 *
 * @uses $vars['filter_context']  Filter context: top, hot, new, accepted, completed
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['context']         Page context (override)
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$page_owner = elgg_get_page_owner_guid();
$context = elgg_extract('context', $vars, elgg_get_context());
$filter_context = elgg_extract('filter_context', $vars, 'top');
$order_by = get_input('order', 'desc');

$icon[] = array();

if ( $order_by == 'asc' ) {
	$icon[$filter_context] = '<span class="UpDownArrow down"></span>';
	$order_text[$filter_context] = '';
} else {
	$icon[$filter_context] = '<span class="UpDownArrow up"></span>';
	$order_text[$filter_context] = '&order=asc';
}

if (elgg_is_logged_in() && $context) {

	$tabs = array(
		'top' => array(
			'text' => elgg_echo('brainstorm:filter:top') . $icon['top'],
			'href' => (isset($vars['top_link'])) ? $vars['top_link'] : "$context/group/$page_owner/top{$order_text[top]}",
			'selected' => ($filter_context == 'top'),
			'priority' => 200,
		),
		'hot' => array(
			'text' => elgg_echo('brainstorm:filter:hot') . $icon['hot'],
			'href' => (isset($vars['hot_link'])) ? $vars['hot_link'] : "$context/group/$page_owner/hot{$order_text[hot]}",
			'selected' => ($filter_context == 'hot'),
			'priority' => 300,
		),
		'new' => array(
			'text' => elgg_echo('brainstorm:filter:new') . $icon['new'],
			'href' => (isset($vars['new_link'])) ? $vars['new_link'] : "$context/group/$page_owner/new{$order_text['new']}",
			'selected' => ($filter_context == 'new'),
			'priority' => 400,
		),
		'accepted' => array(
			'text' => elgg_echo('brainstorm:filter:accepted') . $icon['accepted'],
			'href' => (isset($vars['accepted_link'])) ? $vars['accepted_link'] : "$context/group/$page_owner/accepted{$order_text[accepted]}",
			'selected' => ($filter_context == 'accepted'),
			'priority' => 500,
		),
		'completed' => array(
			'text' => elgg_echo('brainstorm:filter:completed') . $icon['completed'],
			'href' => (isset($vars['completed_link'])) ? $vars['completed_link'] : "$context/group/$page_owner/completed{$order_text[completed]}",
			'selected' => ($filter_context == 'completed'),
			'priority' => 600,
		)
	);
	
	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		
		elgg_register_menu_item('filter', $tab);
	}

	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
}
