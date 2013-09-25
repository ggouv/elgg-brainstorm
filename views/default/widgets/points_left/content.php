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
array_multisort($userVotes, SORT_DESC, $groups);

$content = '<ul class="elgg-list">';
foreach($groups as $key => $group) {
	$class = $userVotes[$key] == 0 ? 'points float-alt zero' : 'points float-alt';
	$group_body = elgg_view('output/url', array(
		'text' => $group->name,
		'href' => elgg_get_site_url() . 'brainstorm/group/' . $group->getGUID() . '/all'
	));
	$group = elgg_view('page/components/image_block', array(
		'image' => elgg_view_entity_icon($group, 'tiny'),
		'body' => $group_body,
		'image_alt' => '<span class="' . $class . '">' . $userVotes[$key] . '</span>'
	));
	$content .= '<li class="elgg-item">' . $group . '</li>';
}
$content .= '</ul>';

echo $content;

if (!$content) {
	echo elgg_echo('brainstorm:none');
}
