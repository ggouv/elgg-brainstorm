<?php
/**
 * Brainstorm helper functions
 *
 * @package Brainstorm
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $idea A idea object.
 * @return array
 */
function brainstorm_prepare_form_vars($idea = null) {
	$user = elgg_get_logged_in_user_guid();

	$values = array(
		'title' => get_input('title', ''),
		'search' => get_input('search', ''),
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'status' => 'open',
		'status_info' => '',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
	);

	if (!$values['title']) $values['title'] = $values['search'];

	if ($idea) {
		foreach (array_keys($values) as $field) {
			if (isset($idea->$field)) {
				$values[$field] = $idea->$field;
			}
		}
	}

	if (elgg_is_sticky_form('idea')) {
		$sticky_values = elgg_get_sticky_values('idea');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('idea');

	return $values;
}


/**
 * Prepare the group settings form variables
 *
 * @param ElggObject $group A group object.
 * @return array
 */
function brainstorm_group_settings_prepare_form_vars($group = null) {

	$values = array(
		'brainstorm_description' => get_input('brainstorm_description', ''),
		'brainstorm_question' => get_input('brainstorm_question', elgg_echo('brainstorm:search')),
		'brainstorm_nbr_points' => get_input('brainstorm_nbr_points', 10),
		'brainstorm_submit_idea_without_point' => get_input('brainstorm_submit_idea_without_point', false),
		'brainstorm_status' => get_input('brainstorm_status', false),
		'brainstorm_separate_accepted_tabs' => get_input('brainstorm_separate_accepted_tabs', false),
		'brainstorm_separate_finished_tabs' => get_input('brainstorm_separate_finished_tabs', false)
	);

	if ($group) {
		foreach (array_keys($values) as $field) {
			if (isset($group->$field)) {
				$values[$field] = $group->$field;
			}
		}
	}

	if (elgg_is_sticky_form('brainstorm_settings')) {
		$sticky_values = elgg_get_sticky_values('brainstorm_settings');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('brainstorm_settings');

	return $values;
}

/**
 * Return points left in group for a user
 * @param  integer   $group_guid   Group GUID
 * @param  integer   $user_guid    User GUID
 * @return integer            Points left
 */
function brainstorm_user_points_left($group_guid = null, $user_guid = null) {
	if (!$group_guid) {
		$group = elgg_get_page_owner_entity();
	} else {
		$group = get_entity($group_guid);
	}

	if (!$user_guid) $user_guid = elgg_get_logged_in_user_guid();

	$userVotes = elgg_get_annotations(array(
		'type' => 'object',
		'subtype' => 'idea',
		'container_guid' => $group->getGUID(),
		'annotation_names' => 'point',
		'annotation_calculation' => 'sum',
		'annotation_owner_guids' => $user_guid,
		'limit' => 0
	));

	$nbr_points = $group->brainstorm_nbr_points ? $group->brainstorm_nbr_points : 10;
	return $nbr_points - $userVotes;
}



/**
 * Return points (total, userPoints and nbrUsers who voted) on an idea
 * @param  integer          $idea_guid   Group GUID
 * @param  string|array     $names       A string or an array of annotations names
 * @param  integer          $user_guid   User GUID
 * @return array                         array of infos on an idea
 */
function brainstorm_idea_get_points($idea_guid, $names = array('point', 'close'), $user_guid = null) {

	if (!$user_guid) $user_guid = elgg_get_logged_in_user_guid();

	$annotations = elgg_get_annotations(array(
		'guids' => $idea_guid,
		'annotation_names' => $names,
		'limit' => 0
	));

	$total = 0;
	$userPoints = 0;
	$nbrUsers = array();
	foreach ($annotations as $key => $value) {
		$total += $value->value;
		if ($value->owner_guid == $user_guid) $userPoints += $value->value;
		if (!in_array($value->owner_guid, $nbrUsers)) $nbrUsers[] = $value->owner_guid;
	}

	return array(
		'total' => $total,
		'userPoints' => $userPoints,
		'nbrUsers' => count($nbrUsers)
	);
}

