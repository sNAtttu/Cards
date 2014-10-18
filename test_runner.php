<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Poker Game</title>
  <link rel="stylesheet" href="play.css?v=1.0">
</head>

<body>
 	<div id="gameContainer">
		moi
	</div>
  <!-- <script src="js/scripts.js"></script> -->
</body>
</html><?php

include ('Game.php');

$game = new Game('Antti', 100);

$game->startGame();

?>