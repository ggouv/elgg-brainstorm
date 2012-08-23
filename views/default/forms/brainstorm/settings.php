<?php
/**
 * Edit / add an idea
 *
 * @package Brainstorm
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()

$description = elgg_extract('brainstorm_description', $vars, '');
$question = elgg_extract('brainstorm_question', $vars, elgg_echo('brainstorm:search'));
$tags = elgg_extract('brainstorm_points', $vars, 10);
$brainstorm_submit_idea_without_point = elgg_extract('brainstorm_submit_idea_without_point', $vars, false);

$group_guid = elgg_get_page_owner_guid();
/* @todo later :
<div>
	<label><?php echo elgg_echo('points'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'brainstorm_points', 'value' => $question)); ?>
</div>
*/
?>

<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'brainstorm_description', 'value' => $description)); ?>
</div>
<div>
	<label><?php echo elgg_echo('brainstorm:settings:question'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'brainstorm_question', 'value' => $question)); ?>
</div>
<div>
	<label><?php echo elgg_echo('brainstorm:settings:brainstorm_submit_idea_without_point'); ?></label><br/>
	<?php
		echo elgg_view('input/checkbox', array(
			'name' => 'brainstorm_submit_idea_without_point',
			'checked' => $brainstorm_submit_idea_without_point ? $brainstorm_submit_idea_without_point : false
		)); ?>
	<?php echo elgg_echo('brainstorm:settings:brainstorm_submit_idea_without_point_string'); ?>
</div>

<div class="elgg-foot">
	<?php
	
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $group_guid));
	
	echo elgg_view('input/submit', array('value' => elgg_echo("save")));
	
	?>
</div>