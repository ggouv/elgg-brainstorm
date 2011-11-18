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
$rate = elgg_extract('rate', $vars, '1');
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
$user = elgg_get_logged_in_user_guid();

$userVote = elgg_get_annotations(array(
	'container_guid' => $container_guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'annotation_owner_guids' => $user,
	'limit' => 0
));
$userVote = 10 - $userVote;
$options = array(' 1' => '1', ' 2' => '2', ' 3' => '3'); // space in keys force to be string
if ( $userVote == 2 ) $options = array(' 1' => '1', ' 2' => '2');
if ( $userVote == 1 ) $options = array(' 1' => '1');
if ( $userVote <= 0 ) forward(REFERER);

?>

<div>
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
</div>
<div>
	<label><?php echo elgg_echo('description'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
</div>
<div>
	<label><?php echo elgg_echo('tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>
<?php

$categories = elgg_view('input/categories', $vars);
if ($categories) {
	echo $categories;
}

?>
<div>
	<label><?php echo elgg_echo('access'); ?></label><br />
	<?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>

<div>
	<label><?php echo elgg_echo('brainstorm:vote'); ?></label><br />
	<?php echo elgg_view('input/radio', array('name' => 'rate', 'value' => $rate, 'options' => $options, 'class' => 'mbl mts', 'align' => 'horizontal')); ?>
</div>

<div class="elgg-foot">
	<?php
	
	echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
	
	if ($guid) {
		echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
	}
	
	echo elgg_view('input/submit', array('value' => elgg_echo("save")));
	
	?>
</div>