<?php
require ('Player.php');
require ('config.php');

class Game {
	private $player;

	public function __construct($playerIdentity, $startingCredits) {
		$this->player = new Player($playerIdentity, $startingCredits);
	}

	public function startGame() {
		// while isGameRunnable()....
		echo 'starting game... <br>';
		echo 'creating new player... <br>';
		var_dump($this->player);
	}

	public function endGame() {

	}

	public function dealHand() {
		
	}

	private function isGameRunnable() {

		return true;
	}
}