<?php
/**
* Idea save action
*
* @package Brainstorm
*/

gatekeeper();

$title = strip_tags(get_input('title'));
$description = get_input('description');
$address = get_input('address');
$access_id = get_input('access_id');
$tags = get_input('tags');
$guid = get_input('guid');
$share = get_input('share');
$container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());

elgg_make_sticky_form('idea');

if (!$title || !$address ) {
	register_error(elgg_echo('idea:save:empty'));
	forward(REFERER);
}

if ($guid == 0) {
	$idea = new ElggObject;
	$idea->subtype = "idea";
	$idea->container_guid = (int)get_input('container_guid', $_SESSION['user']->getGUID());
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
$idea->address = $address;
$idea->description = $description;
$idea->access_id = $access_id;
$idea->tags = $tagarray;
$idea->status = 'open';

if ($idea->save()) {

	elgg_clear_sticky_form('idea');

	system_message(elgg_echo('idea:save:success'));

	//add to river only if new
	if ($new) {
		add_to_river('river/object/brainstorm/create','create', elgg_get_logged_in_user_guid(), $idea->getGUID());
	}

	forward($idea->getURL());
} else {
	register_error(elgg_echo('idea:save:failed'));
	forward($idea->getURL());
}
