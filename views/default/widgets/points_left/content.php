<?php
/**
 * Elgg brainstorm widget
 *
 * @package brainstorm
 */

$max = (int) $vars['entity']->max_display;
$type = $vars['entity']->type_display;

elgg_load_library('brainstorm:utilities');

$user_guid = elgg_get_logged_in_user_guid();

$groups = get_users_membership($user_guid);

$userVotes = array();
foreach($groups as $group) {
	$userVotes[] = brainstorm_user_points_left($group->getGUID(), $user_guid);
}
array_multisort($userVotes, SORT_DESC,
			$groups);

$content = '<ul class="elgg-list">';
foreach($groups as $key => $group) {
	$group_link = elgg_view('output/url', array(
		'href' => elgg_get_site_url() . 'brainstorm/group/' . $group->getGUID() . '/all',
		'text' => $group->name,
	));
	$class = $userVotes[$key] == 0 ? 'points float-alt zero' : 'points float-alt';
	$content .= '<li class="elgg-item">' . $group_link . '<span class="' . $class . '">' . $userVotes[$key] . '</span></li>';
}
$content .= '</ul>';


/*
if ( $type == 'top' ) {
	$content = elgg_list_entities_from_annotation_calculation(array(
		'type' => 'object',
		'subtype' => 'idea',
		'owner_guid' => elgg_get_logged_in_user_guid(),
		'annotation_names' => 'point',
		'order_by' => 'annotation_calculation desc',
		'full_view' => 'sidebar',
		'item_class' => 'elgg-item-idea pts pbs',
		'list_class' => 'sidebar-idea-list',
		'limit' => $max,
		'pagination' => false
	));
} elseif ( $type == 'new' ) {
	$content = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'idea',
		'owner_guid' => elgg_get_logged_in_user_guid(),
		'limit' => $max,
		'pagination' => false,
		'order_by' => 'time_created desc',
		'full_view' => 'sidebar',
		'list_class' => 'sidebar-idea-list',
		'item_class' => 'elgg-item-idea pts pbs'
	));
}*/

echo $content;

if (!$content) {
	echo elgg_echo('brainstorm:none');
}
