<?php
/**
 * Elgg brainstorm widget
 *
 * @package brainstorm
 */

$max = (int) $vars['entity']->num_display;

$options = array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $vars['entity']->owner_guid,
	'limit' => $max,
	'full_view' => 'sidebar',
	'pagination' => FALSE,
);
$content = elgg_list_entities($options);

echo $content;

if ($content) {
	$url = "brainstorm/owner/" . elgg_get_page_owner_entity()->username;
	$more_link = elgg_view('output/url', array(
		'href' => $url,
		'text' => elgg_echo('brainstorm:more'),
	));
	echo "<span class=\"elgg-widget-more\">$more_link</span>";
} else {
	echo elgg_echo('brainstorm:none');
}
