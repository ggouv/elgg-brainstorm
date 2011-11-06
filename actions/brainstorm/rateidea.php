<?php
/**
* Idea rate action
*
* @package Brainstorm
*/

gatekeeper();

$idea_guid = (int)get_input('idea');
$value = (int)get_input('value');

$user_id = elgg_get_logged_in_user_guid();

$sum = elgg_get_annotations(array(
	'guids' => $idea_guid,
	'annotation_names' => 'point',
	'annotation_owner_guids' => $user_id,
	'annotation_calculation' => 'sum'
));
$point = $value-$sum;

// Verify if $point = 0 then it's seem user vote for the same rate or rate 0 for the first time (stupid) or POST crack
if ( $point == 0 || $value < 0 || $value > 3 ) {
	register_error(elgg_echo('brainstorm:idea:rate:error'));
} else {
	
	$annotation = new ElggObject($idea_guid);

	if ( create_annotation($annotation->getGUID(),'point',$value-$sum,'integer',$user_id,$annotation->getAccessID()) ) {
		system_message(elgg_echo('brainstorm:idea:rate:submitted'));
	} else {
		register_error(elgg_echo('brainstorm:idea:rate:error'));
	}
		
}

$sum = elgg_get_annotations(array(
	'guids' => $idea_guid,
	'annotation_names' => 'point',
//	'annotation_owner_guids' => $user_id,
	'annotation_calculation' => 'sum'
));

echo json_encode(array('sum' => $sum));