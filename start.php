<?php
/**
 *	Elgg-brainstorm plugin
 *	@package Brainstorm
 *	@author Emmanuel Salomon @ManUtopiK
 *	@license Dual licensed under the MIT and GNU Affero General Public License, version 3 or late
 *	@copyright (c) Emmanuel Salomon 2012
 *	@link http://
 **/

elgg_register_event_handler('init', 'system', 'brainstorm_init');

function brainstorm_init() {

	$root = dirname(__FILE__);
	elgg_register_library('brainstorm:utilities', "$root/lib/utilities.php");

	// actions
	$action_base = "$root/actions/brainstorm";
	elgg_register_action('brainstorm/saveidea', "$action_base/saveidea.php");
	elgg_register_action('brainstorm/editidea', "$action_base/editidea.php");
	elgg_register_action("brainstorm/rateidea", "$action_base/rateidea.php");
	elgg_register_action('brainstorm/delete', "$action_base/deleteidea.php");
	elgg_register_action('brainstorm/settings', "$action_base/settings.php");

	elgg_register_plugin_hook_handler('register', 'menu:owner_block', 'brainstorm_owner_block_menu');

	elgg_register_page_handler('brainstorm', 'brainstorm_page_handler');
	
	// Extend view
	elgg_extend_view('css/elgg', 'brainstorm/css');
	elgg_extend_view('js/elgg', 'brainstorm/js');
	
	// Register widget
	elgg_register_widget_type('brainstorm', elgg_echo('brainstorm:widget:title'), elgg_echo('brainstorm:widget:description'));

	// Register granular notification for this type
	register_notification_object('object', 'brainstorm', elgg_echo('brainstorm:new'));

	// Listen to notification events and supply a more useful message
	elgg_register_plugin_hook_handler('notify:entity:message', 'object', 'brainstorm_notify_message');

	// Register a URL handler for brainstorm
	elgg_register_entity_url_handler('object', 'idea', 'idea_url');

	// Register entity type for search
	elgg_register_entity_type('object', 'idea');

	// Groups
	add_group_tool_option('brainstorm', elgg_echo('brainstorm:enablebrainstorm'), false);
	elgg_extend_view('groups/tool_latest', 'brainstorm/group_module');
}

/**
 * Dispatcher for brainstorm.
 *
 * @param array $page
 */
function brainstorm_page_handler($page) {
	elgg_load_library('brainstorm:utilities');

	elgg_push_breadcrumb(elgg_echo('brainstorm'), 'brainstorm/all');

	$pages = dirname(__FILE__) . '/pages/brainstorm';

	switch ($page[0]) {
		case "read":
		case "view":
			set_input('guid', $page[1]);
			include "$pages/view.php";
			break;
		case "add":
			gatekeeper();
			include "$pages/saveidea.php";
			break;
		case "edit":
			gatekeeper();
			set_input('guid', $page[1]);
			include "$pages/editidea.php";
			break;
		case "all":
			include "$pages/all.php";
			break;
		case "owner":
			include "$pages/owner.php";
			break;
		case "friends":
			include "$pages/friends.php";
			break;
		case 'group':
			group_gatekeeper();
			switch ($page[2]) {
				default:
				case "all":
				case "top":
					include "$pages/top.php";
					break;
				case "hot":
					include "$pages/hot.php";
					break;
				case "new":
					include "$pages/new.php";
					break;
				case "accepted":
					include "$pages/accepted.php";
					break;
				case "completed":
					include "$pages/completed.php";
					break;
				case "settings":
					include "$pages/settings.php";
					break;
			}
			break;
			
		default:
			return false;
	}

	elgg_pop_context();

	return true;
}


/**
 * Populates the ->getUrl() method for idea objects
 *
 * @param ElggEntity $entity The idea object
 * @return string idea item URL
 */
function idea_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);
	return $CONFIG->url . "brainstorm/view/" . $entity->getGUID() . "/" . $title;
}

/**
 * Add a menu item to an ownerblock
 * 
 * @param string $hook
 * @param string $type
 * @param array  $return
 * @param array  $params
 */
function brainstorm_owner_block_menu($hook, $type, $return, $params) {
	if (elgg_instanceof($params['entity'], 'user')) {
		$url = "brainstorm/owner/{$params['entity']->username}";
		$item = new ElggMenuItem('brainstorm', elgg_echo('brainstorm'), $url);
		$return[] = $item;
	} else {
		if ($params['entity']->brainstorm_enable != 'no') {
			$url = "brainstorm/group/{$params['entity']->guid}/top";
			$item = new ElggMenuItem('brainstorm', elgg_echo('brainstorm:group'), $url);
			if (elgg_in_context('brainstorm')) $item->setSelected();
			$return[] = $item;
		}
	}

	return $return;
}

/**
 * Returns the body of a notification message
 *
 * @param string $hook
 * @param string $entity_type
 * @param string $returnvalue
 * @param array  $params
 */
function brainstorm_notify_message($hook, $entity_type, $returnvalue, $params) {
	$entity = $params['entity'];
	$to_entity = $params['to_entity'];
	$method = $params['method'];
	if (($entity instanceof ElggEntity) && ($entity->getSubtype() == 'idea')) {
		$descr = $entity->description;
		$title = $entity->title;
		
		$url = elgg_get_site_url() . "view/" . $entity->guid;
		if ($method == 'sms') {
			$owner = $entity->getOwnerEntity();
			return $owner->name . ' ' . elgg_echo("brainstorm:via") . ': ' . $url . ' (' . $title . ')';
		}
		if ($method == 'email') {
			$owner = $entity->getOwnerEntity();
			return $owner->name . ' ' . elgg_echo("brainstorm:via") . ': ' . $title . "\n\n" . $descr . "\n\n" . $entity->getURL();
		}
		if ($method == 'web') {
			$owner = $entity->getOwnerEntity();
			return $owner->name . ' ' . elgg_echo("brainstorm:via") . ': ' . $title . "\n\n" . $descr . "\n\n" . $entity->getURL();
		}

	}
	return null;
}