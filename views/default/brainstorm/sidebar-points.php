<?php
/**
 * Brainstorm idea sidebar-points
 */

$user = elgg_get_logged_in_user_guid();
$page_owner = elgg_get_page_owner_guid();

$userVote = elgg_get_annotations(array(
	'container_guid' => $page_owner,
	'annotation_names' => 'point',
	'annotation_calculation' => 'sum',
	'annotation_owner_guids' => $user
));
$userVote = 10 - $userVote; // @TODO Allow group admin to set the initial number of point per user

if ( $userVote <= '0' ) {
	$VoteString = "<strong>0</strong> " . elgg_echo('brainstorm:novoteleft');
	$zero = 'zero';
}
if ( $userVote == '1' ) $VoteString = "<strong>1</strong> " . elgg_echo('brainstorm:onevoteleft');
if ( $userVote >> '1' ) $VoteString = "<strong>$userVote</strong> " . elgg_echo('brainstorm:votesleft');

echo "<div id='votesLeft' class='pam $zero'>" . $VoteString . "</div>";
