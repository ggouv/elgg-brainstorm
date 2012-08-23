<?php
/**
* Idea save action
*
* @package Brainstorm
*/

gatekeeper();

elgg_make_sticky_form('idea');

$title = strip_tags(get_input('title'));
$description = get_input('description');
$access_id = (int)get_input('access_id');
$tags = get_input('tags');
$guid = (int)get_input('guid');
$container_guid = (int)get_input('container_guid', elgg_get_page_owner_guid());
$user_guid = elgg_get_logged_in_user_guid();

if (!$container_guid) {
	register_error(elgg_echo('brainstorm:idea:save:nogroup'));
	forward(elgg_get_site_url() . "brainstorm/all");
}

$container = get_entity($container_guid);

if (!$container || !is_group_member($container_guid, $user_guid)) {
	register_error(elgg_echo('brainstorm:idea:save:nogroup'));
	forward(REFERER);
}

// check if user vote left under zero
$userVote = elgg_get_annotations(array(
	'container_guid' => $container_guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'annotation_owner_guids' => $user_guid
));
$userVote = 10 - $userVote;
if ( $container->brainstorm_submit_idea_without_point == '0' && $userVote < 0 ) {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(elgg_get_site_url() . "brainstorm/group/{$container_guid}/top");
}

// check if user idea more than 10. Cannot submit if group submit without point is not permit
$user_ideas_count = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'idea',
	'owner_guid' => $page_owner->guid,
	'container_guid' => $container_guid,
	'limit' => 0,
	'count' => true
));
if ( $container->brainstorm_submit_idea_without_point == '0' && $user_ideas_count >= 10 ) {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(elgg_get_site_url() . "brainstorm/group/{$container_guid}/top");
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
$idea->access_id = $access_id;
$idea->tags = $tagarray;
$idea->status = 'open';

if ($idea->save()) {

	elgg_clear_sticky_form('idea');

	system_message(elgg_echo('brainstorm:idea:save:success'));

	//add to river and set annotation with minimum of 1 point only if new. If group submit without point is permit and user points left = 0, don't rate.
	if ($new ) {
		if ($container->brainstorm_submit_idea_without_point == 'on' && $userVote >= 0) {
		} else {
			$annotation = new ElggObject($idea->getGUID());
	
			if ( create_annotation($annotation->getGUID(), 'point', 1, 'integer', $user_guid, $annotation->getAccessID()) ) {
			} else {
				register_error(elgg_echo('brainstorm:idea:rate:error'));
			}
		}
		add_to_river('river/object/brainstorm/create','create', $user_guid, $idea->getGUID());
	}

	forward($idea->getURL());
} else {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERER);
}
