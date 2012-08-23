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


<div class="elgg-foot">
	<?php
	
	echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $group_guid));
	
	echo elgg_view('input/submit', array('value' => elgg_echo("save")));
	
	?>
</div>