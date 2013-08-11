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
$brainstorm_status = unserialize(elgg_extract('brainstorm_status', $vars, false));
$brainstorm_separate_accepted_tabs = elgg_extract('brainstorm_separate_accepted_tabs', $vars, false);
$brainstorm_separate_finished_tabs = elgg_extract('brainstorm_separate_finished_tabs', $vars, false);

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

<div>
	<label><?php echo elgg_echo('brainstorm:settings:status'); ?></label><br/>
	<?php echo elgg_echo('brainstorm:settings:separate_tabs:info'); ?>
	<table class="mtm">
	<?php
		$status_label = array('open' => elgg_echo('brainstorm:open'),
							'under_review' => elgg_echo('brainstorm:under_review'),
							'planned' => elgg_echo('brainstorm:planned'),
							'started' => elgg_echo('brainstorm:started'),
							'completed' => elgg_echo('brainstorm:completed'),
							'declined' => elgg_echo('brainstorm:declined')
						);
		foreach ($status_label as $key => $value) {
			if ($key == 'completed') echo '<tr><td colspan="3"><div style="border: 1px solid #CCC;margin: 3px 0;"></div></td></tr>';
			echo '<tr><td><div class="mrs status ' . $key . '" style="margin-top: 7px;">' . $value . '</div></td><td>';
			if (isset($brainstorm_status[$key])) $value = $brainstorm_status[$key];
			echo elgg_view('input/text', array('name' => 'brainstorm_status['.$key.']', 'value' => $value));
			if ($key == 'open') echo '<td rowspan="4" style="vertical-align: middle;" class="pam">' . elgg_echo('brainstorm:settings:status:accepted') . '</td></tr>';
			if ($key == 'completed') echo '<td rowspan="2" style="vertical-align: middle;" class="pam">' . elgg_echo('brainstorm:settings:status:finished') . '</td></tr>';
			echo '</tr>';
		}
	?>
	</table>
</div>

<div>
	<label><?php echo elgg_echo('brainstorm:settings:separate_tabs'); ?></label><br/>
	<?php
		echo elgg_view('input/checkbox', array(
			'name' => 'brainstorm_separate_accepted_tabs',
			'checked' => $brainstorm_separate_accepted_tabs ? $brainstorm_separate_accepted_tabs : false
		)); ?>
	<?php echo elgg_echo('brainstorm:settings:brainstorm_separate_accepted_tabs'); ?>
	<br/>
	<?php
		echo elgg_view('input/checkbox', array(
			'name' => 'brainstorm_separate_finished_tabs',
			'checked' => $brainstorm_separate_finished_tabs ? $brainstorm_separate_finished_tabs : false
		)); ?>
	<?php echo elgg_echo('brainstorm:settings:brainstorm_separate_finished_tabs'); ?>
</div>

<div class="elgg-foot">
	<?php

	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $group_guid));

	echo elgg_view('input/submit', array('value' => elgg_echo("save")));

	?>
</div>