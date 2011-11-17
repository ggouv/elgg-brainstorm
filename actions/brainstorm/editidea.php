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
	register_error(elgg_echo('brainstorm:idea:save:empty'));
	forward($idea->getURL());
}

if ( $guid == 0 ) {
	system_message(elgg_echo('brainstorm:idea:save:failed'));
	forward($idea->getURL());
} else {
	$idea = get_entity($guid);
}

$tagarray = string_to_tag_array($tags);

$idea->title = $title;
$idea->description = $description;
$idea->access_id = $access_id;
$idea->tags = $tagarray;
$idea->status = $status;

$sum = elgg_get_annotations(array(
	'guids' => $guid,
	'annotation_names' => 'point',
	'annotation_owner_guids' => $user_guid,
	'annotation_calculation' => 'sum'
));
$point = $rate-$sum;

if ($idea->save()) {

	elgg_clear_sticky_form('idea');

	system_message(elgg_echo('brainstorm:idea:save:success'));

	//add to river and set annotation with minimum of 1 point only if new
	if ($point != '0') {

		if ( $rate < 0 || $rate > 3 ) {
			register_error(elgg_echo('brainstorm:idea:rate:error:value'));
		} else {
			$annotation = new ElggObject($guid);
			if ( create_annotation($annotation->getGUID(),'point',$point,'integer',$user_guid,$annotation->getAccessID()) ) {
			} else {
				register_error(elgg_echo('brainstorm:idea:rate:error'));
			}
		}
		
		add_to_river('river/object/brainstorm/edit','edit', $user_guid, $idea->getGUID());
	}

	forward($idea->getURL());
} else {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward($idea->getURL());
}
