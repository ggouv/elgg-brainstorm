<?php

$owner = elgg_get_logged_in_user_guid();

$opt[$vars['idea']['userVote']] = 'checked';

if ( $vars['idea']['userVote'] == '0' || $vars['idea']['userVote'] == '' || $vars['idea']['userVote'] == 'vote' ) $opt[0] = 'hidden';
echo elgg_view('input/button', array('name' => 'rate-0', 'value' => '0', 'class' => 'rate-0 ' . $opt[0]));
echo elgg_view('input/button', array('name' => 'rate-1', 'value' => '1', 'class' => 'rate-1 ' . $opt[1]));
echo elgg_view('input/button', array('name' => 'rate-2', 'value' => '2', 'class' => 'rate-2 ' . $opt[2]));
echo elgg_view('input/button', array('name' => 'rate-3', 'value' => '3', 'class' => 'rate-3 ' . $opt[3]));