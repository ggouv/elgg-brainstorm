<?php
/**
 * New idea river entry
 *
 * @package Brainstorm
 */

$object = $vars['item']->getObjectEntity();
$excerpt = elgg_get_excerpt($object->description, '100');

echo elgg_view('river/item', array(
	'item' => $vars['item'],
	'message' => $excerpt
));
