<?php
/**
 * Brainstorm add form body
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

<?php
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