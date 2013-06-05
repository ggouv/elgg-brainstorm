<?php
/**
 * Edit / add an idea
 *
 * @package Brainstorm
 */

// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$status = elgg_extract('status', $vars, 'open');
$status_info = elgg_extract('status_info', $vars, '');
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
?>

<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php
	if (elgg_is_admin_logged_in()) {
		echo $title;
	} else {
		echo $title;
	}
	?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>
<?php
	$group = get_entity($container_guid);
	if ($group->canEdit()) {
	$status_label = array(elgg_echo('brainstorm:open') => 'open',
						elgg_echo('brainstorm:under_review') => 'under_review',
						elgg_echo('brainstorm:planned') => 'planned',
						elgg_echo('brainstorm:started') => 'started',
						elgg_echo('brainstorm:completed') => 'completed',
						elgg_echo('brainstorm:declined') => 'declined'
						);
	?>
		<div>
			<label><?php echo elgg_echo('brainstorm:status'); ?></label><br />
			<?php echo elgg_view('input/radio', array(
					'name' => 'status',
					'value' => $status,
					'options' => $status_label,
					'class' => 'mbl mts',
					'item_class' => 'status',
					'align' => 'horizontal'
				)); ?>
		</div>

		<div>
			<label><?php echo elgg_echo('brainstorm:status_info'); ?></label>
			<?php echo elgg_view('input/longtext', array('name' => 'status_info', 'value' => $status_info)); ?>
		</div>
	<?php
	}
?>
<div>
	<label><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>
<?php
	$categories = elgg_view('input/categories', $vars);
	if ($categories) {
		echo $categories;
	}

	echo elgg_view("input/checkbox", array(
		'name' => 'minorchange'
	));
	echo elgg_echo('brainstorm:minorchange');
?>

<div class="elgg-foot mtl">
	<?php

	echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

	if ($guid) {
		echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	}

	echo elgg_view('input/submit', array('value' => elgg_echo("save")));

	?>
</div>