<?php
require('Game.php');

header('Content-Type: application/json');
session_start();

if(!isset($_SESSION['game'])) {
	$game = new Game('Antti', 100);	
	$_SESSION['game'] = $game;
}

//$game = unserialize($_SESSION['game']);
$game = $_SESSION['game'];

if(isset($_POST['command']) && $_POST['command'] == 'forceRestart') {
	session_destroy();
	header('Location: '.$_SERVER['PHP_SELF']);
}

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