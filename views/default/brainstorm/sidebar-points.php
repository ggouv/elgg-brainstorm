<?php
/**
 * Brainstorm idea sidebar-points
 */

$user_guid = elgg_get_logged_in_user_guid();
$page_owner = elgg_get_page_owner_guid();

$userVote = elgg_get_annotations(array(
	'type' => 'object',
	'subtype' => 'idea',
	'container_guid' => $page_owner,
	'annotation_owner_guids' => $user_guid,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'limit' => 0
));
$userVote = 10 - $userVote; // @TODO Allow group admin to set the initial number of point per user

if ( $userVote <= '0' ) {
	$VoteString = "<strong>0</strong> " . elgg_echo('brainstorm:novoteleft');
	$zero = 'zero';
}
if ( $userVote == '1' ) $VoteString = "<strong>1</strong> " . elgg_echo('brainstorm:onevoteleft');
if ( $userVote >> '1' ) $VoteString = "<strong>$userVote</strong> " . elgg_echo('brainstorm:votesleft');

echo "<div id='votesLeft' class='pam $zero'>" . $VoteString . "</div>";

if ( $userVote != '10' ) echo elgg_echo('brainstorm:yourvotes');