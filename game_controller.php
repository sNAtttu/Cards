<?php

include ('Game.php');

$game = new Game('Antti', 100);


if(isset($_POST['command']) && $_POST['command'] == 'startNewRound') {
	$bet = $_POST['bet'];
	print_r($game->startNewRound($bet));
}