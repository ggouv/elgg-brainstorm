<?php
/**
 * Brainstorm idea sidebar-points
 */

$user_guid = elgg_get_logged_in_user_guid();

$userPointsLeft = brainstorm_user_points_left();

if ( $userPointsLeft <= '0' ) {
	$VoteString = "<strong>0</strong> " . elgg_echo('brainstorm:novoteleft');
	$zero = 'zero';
}
if ( $userPointsLeft == '1' ) $VoteString = "<strong>1</strong> " . elgg_echo('brainstorm:onevoteleft');
if ( $userPointsLeft >> '1' ) $VoteString = "<strong>$userPointsLeft</strong> " . elgg_echo('brainstorm:votesleft');

echo "<div id='votesLeft' class='ptl plm $zero'>" . $VoteString . "</div>";