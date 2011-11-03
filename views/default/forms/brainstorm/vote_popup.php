<?php
global $fb;

$owner = elgg_get_logged_in_user_guid();

//$fb->info($vars['brainstorm'], 'vars');
//$fb->info($owner, 'owner');

echo elgg_view('input/radio', array(
					'name' => 'rate', 
					'value' => '',
					'options' => array('0' => '0', '1' => '1', '2' => '2', '3' => '3'),
					'align' => 'horizontal'
				));

/*echo elgg_view('input/button', array('name' => 'tab', 'value' => '1'));
echo elgg_view('input/button', array('name' => 'tab', 'value' => '2'));
echo elgg_view('input/button', array('name' => 'tab', 'value' => '3'));


 * @uses $vars['value']    The current value, if any
 * @uses $vars['name']     The name of the input field
 * @uses $vars['options']  An array of strings representing the options for the
 *                         radio field as "label" => option
 * @uses $vars['class']    Additional class of the list. Optional.
 * @uses $vars['align']    'horizontal' or 'vertical' Default: 'vertical'*/
?>




<?php
/*
// Get tab and column
$tab = $vars['deck-river']['tab'];
$column = $vars['deck-river']['column'];
$new = $vars['deck-river']['new'];
// Get the settings of the current user
$owner = elgg_get_logged_in_user_guid();
$user_river_options = unserialize(get_private_setting($owner, 'deck_river_settings'));
$user_river_column_options = $user_river_options[$tab][$column];
?>

<?php echo elgg_view('input/hidden', array('name' => 'column', 'value' => $column)); ?>
<?php echo elgg_view('input/hidden', array('name' => 'tab', 'value' => $tab)); ?>

<div class='elgg-head'>
	<h3><?php echo elgg_echo('deck_river:settings', array($user_river_column_options['title'])); ?></h3>
	<?php
		$params = array(
			'text' => elgg_view_icon('delete-alt'),
		);
		echo elgg_view('output/url', $params);
	?>
</div>

<div id='deck-column-settings'>
	<div class='filter'>
		<label><?php echo elgg_echo('deck_river:filter'); ?></label><br />
		<?php
		// create checkboxes array
		$types_value = array();
		$registered_entities = elgg_get_config('registered_entities');
		$types_label[] = 'All';
		if (!array_key_exists('types_filter', $user_river_column_options) && !array_key_exists('subtypes_filter', $user_river_column_options) || $user_river_column_options['types_filter'] == 'All' ) $types_value[] = 'All';
		if (!empty($registered_entities)) {
			foreach ($registered_entities as $type => $subtypes) {
				// subtype will always be an array.
				if (!count($subtypes)) {
					$label = str_replace( 'Show ', '', elgg_echo('river:select', array(elgg_echo("item:$type"))) );
					$types_label[$label] .= $type;
					if (in_array($type, $user_river_column_options['types_filter'])) $types_value[] = $type;
				} else {
					foreach ($subtypes as $subtype) {
						$label = str_replace( 'Show ', '', elgg_echo('river:select', array(elgg_echo("item:$type:$subtype"))) );
						$subtypes_label[$label] .= $subtype;
						if (in_array($subtype, $user_river_column_options['subtypes_filter'])) $subtypes_value[] = $subtype;
					}
				}
			}
			echo elgg_view('input/checkboxes', array(
								'name' => 'filters_types',
								'value' => $types_value,
								'options' => $types_label,
								));
			echo elgg_view('input/checkboxes', array(
								'name' => 'filters_subtypes',
								'value' => $subtypes_value,
								'options' => $subtypes_label,
								));
		} ?>
	</div>
	<ul class='box-settings'>
	<li>
		<label><?php echo elgg_echo('deck_river:type'); ?></label><br />
		<?php echo elgg_view('input/dropdown', array(
			'name' => 'type',
			'value' => $user_river_column_options['type'],
			'class' => 'column-type',
			'options_values' => array(
					'all' => elgg_echo('river:all'),
					'friends' => elgg_echo('river:friends'),
					'mine' => elgg_echo('river:mine'),
					'mention' => 'Mention @' . get_entity($owner)->name,
					'search' => elgg_echo('search')
				)
			)); ?>
	</li>
	<li class='search-type'>
		<label><?php echo elgg_echo('deck_river:title'); ?></label><br />
		<?php echo elgg_view('input/text', array(
			'name' => 'title',
			'value' => $user_river_column_options['title']
		)); ?>
	</li>
	<li class='search-type'>
		<label><?php echo elgg_echo('deck_river:search'); ?></label><br />
		<?php echo elgg_view('input/text', array(
			'name' => 'search',
			'value' => $user_river_column_options['search']
		)); ?>
	</li>
	</ul>
</div>
<div>
<?php echo elgg_view('input/submit', array(
		'value' => 'save',
		'name' => elgg_echo('save')
));
if ($new != 'true') {
	echo elgg_view('input/submit', array(
			'value' => 'delete',
			'name' => elgg_echo('delete'),
			'class' => 'mls'
	));
} ?>
</div>
*/