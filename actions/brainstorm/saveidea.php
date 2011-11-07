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
$access_id = get_input('access_id');
$tags = get_input('tags');
$rate = get_input('rate');
$guid = get_input('guid');
$container_guid = get_input('container_guid', elgg_get_page_owner_guid());
$user_guid = elgg_get_logged_in_user_guid();

$userVote = elgg_get_annotations(array(
	'container_guid' => $container_guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'annotation_owner_guids' => $user_guid
));
$userVote = 10 - $userVote;
if ( $userVote <= 0 ) forward(REFERER);

if (!$title || !$description ) {
	register_error(elgg_echo('idea:save:empty'));
	forward(REFERER);
}

if ($guid == 0) {
	$idea = new ElggObject;
	$idea->subtype = "idea";
	$idea->container_guid = $container_guid;
	$new = true;
} else {
	$idea = get_entity($guid);
	if (!$idea->canEdit()) {
		system_message(elgg_echo('idea:save:failed'));
		forward(REFERRER);
	}
}

$tagarray = string_to_tag_array($tags);

$idea->title = $title;
$idea->description = $description;
$idea->access_id = $access_id;
$idea->tags = $tagarray;
$idea->status = 'open';

if ($idea->save()) {

	elgg_clear_sticky_form('idea');

	system_message(elgg_echo('idea:save:success'));

	//add to river and set annotation with minimum of 1 point only if new
	if ($new) {
		$annotation = new ElggObject($idea->getGUID());

		if ( $rate < 1 || $rate > 3 ) $rate = 1;
		if ( create_annotation($annotation->getGUID(),'point',$rate,'integer',$user_guid,$annotation->getAccessID()) ) {
		} else {
			register_error(elgg_echo('brainstorm:idea:rate:error'));
		}
	
		add_to_river('river/object/brainstorm/create','create', $user_guid, $idea->getGUID());
	}

	forward($idea->getURL());
} else {
	register_error(elgg_echo('idea:save:failed'));
	forward($idea->getURL());
}
