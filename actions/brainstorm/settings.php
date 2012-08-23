<?php
/**
* Idea save action
*
* @package Brainstorm
*/

gatekeeper();
group_gatekeeper();

elgg_make_sticky_form('brainstorm_settings');

$description = get_input('brainstorm_description', '');
$question = get_input('brainstorm_question', elgg_echo('brainstorm:search'));
$brainstorm_submit_idea_without_point = get_input('brainstorm_submit_idea_without_point', false);
//$points = (int)get_input('brainstorm_points');
$group_guid = (int)get_input('guid', elgg_get_page_owner_guid());
$user_guid = elgg_get_logged_in_user_guid();

if (!$group_guid || !$user_guid ) {
	system_message(elgg_echo('brainstorm:group:settings:failed'));
	forward(REFERER);
}

$group = get_entity($group_guid);

if ($user_guid != $group->getOwnerGuid()) {
	system_message(elgg_echo('brainstorm:group:settings:failed'));
	forward(REFERER);
}

$group->brainstorm_description = $description;
$group->brainstorm_question = $question;
$group->brainstorm_submit_idea_without_point = $brainstorm_submit_idea_without_point;
//$group->brainstorm_points = $points;

if ($group->save()) {

	elgg_clear_sticky_form('brainstorm_settings');

	system_message(elgg_echo('brainstorm:group:settings:save:success'));

	forward("brainstorm/group/$group_guid/top");
} else {
	register_error(elgg_echo('brainstorm:group:settings:failed'));
	forward(REFERER);
}
