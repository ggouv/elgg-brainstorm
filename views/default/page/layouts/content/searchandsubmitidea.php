<?php
/**
 * Brainstorm search and add form
 *
 */
$group = elgg_get_page_owner_entity();

if (!$description = $group->brainstorm_description) $description = '';
if (!$question = $group->brainstorm_question) $question = elgg_echo('brainstorm:search');

echo $description;

echo '<h3 class="mbs">' . $question . '</h3>';

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