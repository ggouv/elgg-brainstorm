<?php
/**
 * Delete an idea
 *
 * @package Brainstorm
 */

$guid = get_input('guid');
$idea = get_entity($guid);

if (elgg_instanceof($idea, 'object', 'idea') && $idea->canEdit()) {
	$container = $idea->getContainerEntity();
	if ($idea->delete()) {
		system_message(elgg_echo("brainstorm:idea:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("brainstorm/group/$container->guid/all");
		} else {
			forward("brainstorm/owner/$container->username");
		}
	}
}

register_error(elgg_echo("brainstorm:idea:delete:failed"));
forward(REFERER);
