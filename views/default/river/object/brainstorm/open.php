<?php
/**
 * Update idea river entry from status open
 *
 * @package Brainstorm
 */

$object = $vars['item']->getObjectEntity();
$subject = $vars['item']->getSubjectEntity();
$container = $object->getContainerEntity();

if ($object && $subject && $container) {
	$subject_link = elgg_view('output/url', array(
		'href' => $subject->getURL(),
		'text' => $subject->name,
		'class' => 'elgg-river-subject',
		'is_trusted' => true,
	));

	$object_link = elgg_view('output/url', array(
		'href' => $object->getURL(),
		'text' => $object->title,
		'class' => 'elgg-river-object',
		'is_trusted' => true,
	));

	$group_link = elgg_view('output/url', array(
		'href' => $container->getURL(),
		'text' => $container->name,
		'is_trusted' => true,
	));
	$group_string = elgg_echo('river:ingroup', array($group_link));

	$status_array = unserialize($container->brainstorm_status);
	$status_string = $status_array['open'] ? $status_array['open'] : elgg_echo('brainstorm:open');

	$excerpt = "<span class=\"status open\">$status_string</span>&nbsp;";
	$excerpt .= strip_tags(elgg_get_excerpt($object->status_info, 140));

	echo elgg_view('river/item', array(
		'item' => $vars['item'],
		'message' => $excerpt
	));
}