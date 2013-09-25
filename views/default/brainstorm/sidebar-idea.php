<?php
/**
 * Brainstorm ideas of user sidebar
 */
$user = elgg_get_logged_in_user_guid();
$group = elgg_get_page_owner_entity();

$ideas = elgg_get_entities_from_annotations(array(
	'type' => 'object',
	'subtype' => 'idea',
	'annotation_owner_guids' => $user,
	'container_guid' => $group->getGUID(),
	'annotation_names' => 'point',
	'full_view' => 'sidebar',
	'item_class' => 'elgg-item-idea',
	'list_class' => 'sidebar-idea-list',
	'limit' => 0
));

if ($ideas) {
	foreach( $ideas as $key => $idea) {
		$sum = brainstorm_idea_get_points($idea->getGUID());
		if ($sum['userPoints'] == 0) unset($ideas[$key]);
	}

	$echo = elgg_list_entities(array(
		'items' => $ideas,
		'full_view' => 'sidebar',
		'item_class' => 'elgg-item-idea pts pbs',
		'list_class' => 'sidebar-idea-list',
		'pagination' => false,
		'limit' => $group->brainstorm_nbr_points ? $group->brainstorm_nbr_points : 10
	));
}

if ($echo) {
	echo elgg_echo('brainstorm:yourvotes');
	echo $echo;
} else {
	echo '<ul class="elgg-list sidebar-idea-list"></ul>';
}