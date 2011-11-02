<?php
/**
 * Main content filter
 *
 * Select between user, friends, and all content
 *
 * @uses $vars['filter_context']  Filter context: all, friends, mine
 * @uses $vars['filter_override'] HTML for overriding the default filter (override)
 * @uses $vars['context']         Page context (override)
 */

if (isset($vars['filter_override'])) {
	echo $vars['filter_override'];
	return true;
}

$context = elgg_extract('context', $vars, elgg_get_context());

if (elgg_is_logged_in() && $context) {
	$username = elgg_get_logged_in_user_entity()->username;
	$filter_context = elgg_extract('filter_context', $vars, 'top');

	// generate a list of default tabs
	$tabs = array(
		'top' => array(
			'text' => elgg_echo('top'),
			'href' => (isset($vars['top_link'])) ? $vars['top_link'] : "$context/top",
			'selected' => ($filter_context == 'top'),
			'priority' => 200,
		),
		'hot' => array(
			'text' => elgg_echo('hot'),
			'href' => (isset($vars['hot_link'])) ? $vars['hot_link'] : "$context/hot",
			'selected' => ($filter_context == 'hot'),
			'priority' => 300,
		),
		'new' => array(
			'text' => elgg_echo('new'),
			'href' => (isset($vars['new_link'])) ? $vars['new_link'] : "$context/new",
			'selected' => ($filter_context == 'new'),
			'priority' => 400,
		),
		'accepted' => array(
			'text' => elgg_echo('accepted'),
			'href' => (isset($vars['accepted_link'])) ? $vars['accepted_link'] : "$context/accepted",
			'selected' => ($filter_context == 'accepted'),
			'priority' => 500,
		),
		'completed' => array(
			'text' => elgg_echo('completed'),
			'href' => (isset($vars['completed_link'])) ? $vars['completed_link'] : "$context/completed",
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
