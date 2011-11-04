<?php
/**
 *	QUESTIONS PLUGIN
 *	@package questions
 *	@author Javier Luces jluces@df-digital.com
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) DF-Digital 2009
 *	@link http://www.df-digital.com
 **/
?>
<?php
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
	
	$idea = new ElggObject($idea_guid);

//elgg_delete_annotations(array('annotation_names' => 'point', 'annotation_owner_guids' => $user_id));
	
	
//	$fb->info($annotations[0]->entity_guid);
//$fb->info(elgg_annotation_exists($old_annotation->entity_guid,'point',$user_id),'nrs');

//	if ( empty($annotations) ) {
		if ( create_annotation($idea->getGUID(),'point',$value-$sum,'integer',$user_id,$idea->getAccessID()) ) {
			system_message(elgg_echo('brainstorm:idea:rate:submitted'));
		} else {
			register_error(elgg_echo('brainstorm:idea:rate:error'));
		}
/*	} else {
		if ( update_annotation($annotations[0]->id,'point',$value,'integer',$user_id,$idea->getAccessID()) ) {
			system_message(elgg_echo('brainstorm:idea:rate:update:submitted'));
		} else {
			register_error(elgg_echo('brainstorm:idea:rate:update:error'));
		}
	}
	*/
global $fb; $fb->info(elgg_get_logged_in_user_guid());
	$all = elgg_get_annotations(array(
		'guids' => $idea_guid,
		'annotation_names' => 'point',
		'annotation_owner_guids' => $user_id,
	));
	$fb->info($all,'all');
	
	$sum = elgg_get_annotations(array(
		'guids' => $idea_guid,
		'annotation_names' => 'point',
		'annotation_owner_guids' => $user_id,
		'annotation_calculation' => 'sum'
	));
	$fb->info($sum,'sum');
}

echo json_encode(array('sum' => $sum));
/*
	$interesting = get_input('interesting');
	$question_guid = (int) get_input('question_guid');
	$question = new ElggObject($question_guid);

	$user_id = get_loggedin_userid();

	if( !create_annotation($question->getGUID(),'interesting',$interesting,'text',$user_id,$question->getAccessID()) )
		register_error(elgg_echo('questions:rate:question:error'));
	else
		system_message(elgg_echo('questions:rate:question:submitted'));
	forward($_SERVER['HTTP_REFERER']);
*/
