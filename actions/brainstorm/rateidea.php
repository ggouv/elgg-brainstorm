<?php
/**
* Idea rate action
*
* @package Brainstorm
*/

gatekeeper();

$value = (int) get_input('value');
$idea_guid = (int) get_input('idea');

if (!$idea_guid) {
	register_error(elgg_echo('brainstorm:idea:rate:error'));
} else {
	$idea = get_entity($idea_guid);
}

$user_guid = elgg_get_logged_in_user_guid();
$group_guid = (int) get_input('group_guid', elgg_get_page_owner_guid());

$sum = elgg_get_annotations(array(
	'guids' => $idea_guid,
	'annotation_names' => 'point',
	'annotation_owner_guids' => $user_guid,
	'annotation_calculation' => 'sum',
	'limit' => 0
));
$point = $value-$sum;

// Verify if $point = 0 then it's seem user vote for the same rate or rate 0 for the first time (stupid) or POST crack
if ( $point == 0 || $value < 0 || $value > 3 ) {
	register_error(elgg_echo('brainstorm:idea:rate:error:value'));
	$error = true;
} else {

	elgg_load_library('brainstorm:utilities');
	$userPointsLeft = brainstorm_user_points_left($group_guid) - $point;

	if ( $userPointsLeft < 0 ) {
		register_error(elgg_echo('brainstorm:idea:rate:error:underzero'));
		$error = true;
	} else {

		if ( create_annotation($idea_guid,'point',$point,'integer',$user_guid,$idea->getAccessID()) ) {
			system_message(elgg_echo('brainstorm:idea:rate:submitted'));
		} else {
			register_error(elgg_echo('brainstorm:idea:rate:error'));
		}

	}
}

$sum = elgg_get_annotations(array(
	'guids' => $idea_guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'limit' => 0
));

echo json_encode(array('sum' => $sum, 'userPointsLeft' => $userPointsLeft, 'errorRate' => $error));