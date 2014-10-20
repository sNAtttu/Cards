<?php 
require('Game.php');
session_start(); 

if(!isset($_SESSION['game'])) {
	$game = new Game('Antti', 100);	
	$_SESSION['game'] = $game;
}
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Poker Game</title>
  <link rel="stylesheet" href="play.css?v=1.0">
</head>

<body>	
	<hr />
 	<div id="gameContainer">
 		<div id="infoContainer">
 			Credits Left: <span id="creditsLeft"></span> <br />
 			Bet amount: <span id="betAmount"></span> 
 		</div>
		<div id="cardContainer"></div>
		<div id="controlsContainer">
			<input type="text" name="bet" id="bet" placeholder="bet" disabled/> <button id="changeBetButton">Change bet</button>
			<input type="number" name="credits" id="credits"><button id="addCredits">Add credits</button>
			<button id="startRoundButton" name="startRoundButton">Deal</button>
		</div>
	</div>
	<hr />
	<button id="forceRestart">FORCE RESTART</button>
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="scripts.js"></script>
</body>
</html>
