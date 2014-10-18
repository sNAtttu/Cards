<?php
session_start();
header('Content-Type: application/json');
include ('Game.php');

$game = unserialize($_SESSION['game']);

if(isset($_POST['command']) && $_POST['command'] == 'startNewRound') {
	$bet = $_POST['bet'];
	echo json_encode($game->startNewRound($bet));
}