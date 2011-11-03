<?php

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . "/engine/start.php");

// Get callbacks
$vars['brainstorm'] = array(
					'idea' => get_input('idea', 'false'),
					'rate' => get_input('rate', 'false')
					);

echo elgg_view_form('brainstorm/vote_popup', array('class' => 'brainstorm-vote-popup'), $vars);
