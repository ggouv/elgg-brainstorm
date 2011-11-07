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

	$values = array(
		'title' => get_input('title', ''),
		'address' => get_input('address', ''),
		'description' => '',
		'access_id' => ACCESS_DEFAULT,
		'tags' => '',
		'rate' => '1',
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $idea,
	);

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
