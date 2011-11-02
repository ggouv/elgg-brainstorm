<?php
/**
 * Wire add form body
 *
 * @uses $vars['post']
 */

$post = elgg_extract('post', $vars);

$text = elgg_echo('post');
if ($post) {
	$text = elgg_echo('brainstorm:search');
}

if ($post) {
	echo elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $post->guid,
	));
}
?>

<div id="brainstorm-characters-remaining">
	<span>140</span> <?php echo elgg_echo('brainstorm:charleft'); ?>
</div>

<?php
echo elgg_view('input/text', array(
	'name' => 'body',
	'class' => 'mbm',
	'id' => 'brainstorm-textarea',
));
?>

<?php
/*
echo elgg_view('input/submit', array(
	'value' => $text,
	'id' => 'brainstorm-submit-button',
));*/
?>