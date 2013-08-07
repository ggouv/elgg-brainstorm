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

$page_owner = elgg_get_page_owner_entity();
$context = elgg_extract('context', $vars, elgg_get_context());
$filter_context = elgg_extract('filter_context', $vars, 'top');

$order_by = get_input('order', 'desc');

$brainstorm_separate_accepted_tabs = $page_owner->brainstorm_separate_accepted_tabs;
$brainstorm_separate_finished_tabs = $page_owner->brainstorm_separate_finished_tabs;

$icon[] = array();

if ( $order_by == 'asc' ) {
	$icon[$filter_context] = '<span class="UpDownArrow down"></span>';
	$order_text[$filter_context] = '';
} else {
	$icon[$filter_context] = '<span class="UpDownArrow up"></span>';
	$order_text[$filter_context] = '?order=asc';
}

if (elgg_is_logged_in() && $context) {

	$prepare_tabs = array('top', 'hot', 'new');

	if ($brainstorm_separate_accepted_tabs == 'on') {
		$prepare_tabs = array_merge($prepare_tabs, array('under_review', 'planned', 'started'));
	} else {
		$prepare_tabs[] = 'accepted';
	}

	if ($brainstorm_separate_finished_tabs == 'on') {
		$prepare_tabs = array_merge($prepare_tabs, array('completed', 'declined'));
	} else {
		$prepare_tabs[] = 'finished';
	}

	$i = 200;
	foreach ($prepare_tabs as $name) {
		if (in_array($name, array('top', 'hot', 'new', 'accepted', 'finished'))) {
			$text = elgg_echo('brainstorm:filter:'.$name) . $icon[$name];
			$class = '';
		} else {
			$status_array = unserialize($page_owner->brainstorm_status);
			$status_string = $status_array[$name] ? $status_array[$name] : elgg_echo('brainstorm:'.$name);
			$text = ucfirst($status_string) . $icon[$name];
			$class = 'status ' . $name;
		}
		$tabs[$name] = array(
			'text' => $text,
			'href' => (isset($vars[$name.'_link'])) ? $vars[$name.'_link'] : "$context/group/{$page_owner->getGUID()}/$name{$order_text[$name]}",
			'selected' => ($filter_context == $name),
			'class' => $class,
			'priority' => $i,
		);
		$i = $i+100;
	}

	foreach ($tabs as $name => $tab) {
		$tab['name'] = $name;
		elgg_register_menu_item('filter', $tab);
	}

	echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
}
