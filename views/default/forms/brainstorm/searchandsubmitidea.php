<?php
/**
 * Brainstorm search and add form
 *
 */

echo elgg_view('input/hidden', array(
	'name' => 'title',
	'value' => '',
));

echo '<h3 class="mbs">' . elgg_echo('brainstorm:search') . '</h3>';

echo elgg_view('input/text', array(
	'name' => 'body',
	'class' => 'mbm',
	'id' => 'brainstorm-textarea',
));
?>

<div id="brainstorm-characters-remaining">
	<span>140</span> <?php echo elgg_echo('brainstorm:charleft'); ?>
</div>
<div id="brainstorm-search-response"></div>