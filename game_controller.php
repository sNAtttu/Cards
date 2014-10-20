<?php
session_start();
header('Content-Type: application/json');
include ('Game.php');

$game = unserialize($_SESSION['game']);

if(isset($_POST['command']) && $_POST['command'] == 'startNewRound') {
	$bet = $_POST['bet'];
	if(!isset($_POST['heldCards'])) {
		$heldCards = array();	
	} else {
		$heldCards = $_POST['heldCards'];	
	}
	
	if (sizeof($heldCards > 0) ){
			echo json_encode($game->startNewRound($bet, $heldCards));
	} else {
		echo json_encode($game->startNewRound($bet, array()));	
	}
}