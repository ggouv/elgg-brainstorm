<?php
/**
* Idea save action
*
* @package Brainstorm
*/

gatekeeper();

elgg_make_sticky_form('idea');

if (is_null( $guid = get_input('guid') )) {
	system_message(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERER);
} else {
	$idea = get_entity($guid);
}

$title = strip_tags(get_input('title'));
if (!$title) $title = $idea->title;
$description = get_input('description');
$access_id = get_input('access_id');
$tags = get_input('tags');
$status = get_input('status');
$status_info = get_input('status_info', '');

$user_guid = elgg_get_logged_in_user_guid();

if (!$title || !$description ) {
	register_error(elgg_echo('brainstorm:idea:save:empty'));
	forward(REFERER);
}

if ($status && $idea->status != $status) $status_change = true;

$idea->title = $title;
$idea->description = $description;
$idea->access_id = $access_id;
$idea->tags = string_to_tag_array($tags);
if ($status) $idea->status = $status;
$idea->status_info = $status_info;

if ($idea->save()) {


	if ($status_change) {

		$annotations_idea = elgg_get_annotations(array(
			'type' => 'object',
			'subtype' => 'idea',
			'guids' => $guid,
			'annotation_names' => array('point', 'close'),
			'limit' => 0
		));

		if ( $status == 'completed' || $status == 'declined' ) {
			foreach ($annotations_idea as $annotation) {
				update_annotation($annotation->id, 'close',$annotation->value,$annotation->value_type, $annotation->owner_guid,$annotation->access_id);
				$user_who_voted[] = $annotation->getOwnerEntity()->getGUID();
			}

			// send mail
			$container = $idea->getContainerEntity();
			notify_user(
					array_unique($user_who_voted),
					$idea->getOwnerEntity()->getGUID(),
					elgg_echo('brainstorm:notify:subject', array(elgg_echo('brainstorm:'.$status))),
					elgg_echo('brainstorm:notify:body', array(
							$idea->getURL(),
							$idea->title,
							elgg_echo('brainstorm:'.$status),
							elgg_get_site_url() . 'brainstorm/group/' . $container->getGUID() . '/all',
							$container->title)
					),
					array('method' => "email")
			);

		} else {
			foreach ($annotations_idea as $annotation) {
				update_annotation($annotation->id, 'point',$annotation->value,$annotation->value_type, $annotation->owner_guid,$annotation->access_id);
			}
		}
		add_to_river('river/object/brainstorm/' . $status, 'update', $user_guid, $idea->getGUID());
	} else {
		add_to_river('river/object/brainstorm/update', 'update', $user_guid, $idea->getGUID());
	}

	system_message(elgg_echo('brainstorm:idea:save:success'));

	elgg_clear_sticky_form('idea');
	forward($idea->getURL());

} else {
	register_error(elgg_echo('brainstorm:idea:save:failed'));
	forward(REFERER);
}
