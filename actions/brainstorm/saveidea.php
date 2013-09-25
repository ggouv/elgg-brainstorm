<?php
/**
* Idea save action
*
* @package Brainstorm
*/

gatekeeper();

elgg_load_library('brainstorm:utilities');
elgg_make_sticky_form('idea');

$title = strip_tags(get_input('title'));
$description = get_input('description');
$tags = get_input('tags');
$guid = (int)get_input('guid');
$container_guid = (int)get_input('container_guid', elgg_get_page_owner_guid());
$user_guid = elgg_get_logged_in_user_guid();

if (!$container_guid) {
	register_error(elgg_echo('brainstorm:idea:save:nogroup'));
	forward(elgg_get_site_url() . "brainstorm/all");
}

$container = get_entity($container_guid);

if (!$container || !$container->canWritetoContainer()) {
	register_error(elgg_echo('brainstorm:idea:save:nogroup'));
	forward(REFERER);
}

// check if user vote left under zero
$userPointsLeft = brainstorm_user_points_left($container_guid);

if ($container->brainstorm_submit_idea_without_point == '0') {
	if ($userPointsLeft < 0 ) {
		register_error(elgg_echo('brainstorm:idea:save:failed'));
		forward(elgg_get_site_url() . "brainstorm/group/{$container_guid}/top");
	}

	// check if user has rate more than brainstorm_nbr_points. Cannot submit if group submit without point is not permit
	$user_ideas_count = elgg_get_entities_from_annotations(array(
		'type' => 'object',
		'subtype' => 'idea',
		'owner_guid' => $user_guid,
		'container_guid' => $container_guid,
		'annotation_names' => 'point',
		'limit' => 0,
		'count' => true
	));
	if ($user_ideas_count >= $container->brainstorm_nbr_points) {
		register_error(elgg_echo('brainstorm:idea:save:too_much_ideas'));
		forward(elgg_get_site_url() . "brainstorm/group/{$container_guid}/top");
	}
}

if (!$title || !$description ) {
	register_error(elgg_echo('brainstorm:idea:save:empty'));
	forward(REFERER);
}

if ($guid == 0) {
	$idea = new ElggObject;
	$idea->subtype = "idea";
	$idea->container_guid = $container_guid;
	$new = true;
} else {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERER);
}

$tagarray = string_to_tag_array($tags);

$idea->title = $title;
$idea->description = $description;
$idea->access_id = ACCESS_PUBLIC;
$idea->tags = $tagarray;
$idea->status = 'open';

if ($idea->save()) {

	elgg_clear_sticky_form('idea');

	system_message(elgg_echo('brainstorm:idea:save:success'));

	//add to river and set annotation with minimum of 1 and max 3 points only if new. If group submit without point is permit and user points left = 0, rate 0.
	if ($new) {
		if ($container->brainstorm_submit_idea_without_point == 'on' && $userPointsLeft <= 0) {
			$rate = 0;
		} else {
			$rate = 1;
			if ($userPointsLeft >= 2) $rate = 2;
			if ($userPointsLeft >= 3) $rate = 3;
		}

		if ( create_annotation($idea->getGUID(), 'point', $rate, 'integer', $user_guid, $idea->getAccessID()) ) {
		} else {
			register_error(elgg_echo('brainstorm:idea:rate:error'));
		}

		add_to_river('river/object/brainstorm/create','create', $user_guid, $idea->getGUID());
	}

	forward($idea->getURL());
} else {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERER);
}
