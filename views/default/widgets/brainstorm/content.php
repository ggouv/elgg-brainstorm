<?php
/**
 * Elgg brainstorm widget
 *
 * @package brainstorm
 */

$max = (int) $vars['entity']->max_display;
$type = $vars['entity']->type_display;

$user = get_entity($vars['entity']->owner_guid);

if ( $type == 'top' ) {
	$content = elgg_list_entities_from_annotation_calculation(array(
		'type' => 'object',
		'subtype' => 'idea',
		'owner_guid' => $user->getGUID(),
		'annotation_names' => 'point',
		'order_by' => 'annotation_calculation desc',
		'full_view' => 'no_vote',
		'limit' => $max,
		'pagination' => false
	));
} elseif ( $type == 'new' ) {
	$content = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'idea',
		'owner_guid' => $user->getGUID(),
		'limit' => $max,
		'pagination' => false,
		'order_by' => 'time_created desc',
		'full_view' => 'no_vote'
	));
}

echo $content;

if ($content) {
	$url = "brainstorm/owner/" . $user->username;
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('brainstorm:more'),
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('brainstorm:none');
}
