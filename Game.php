<?php
require ('Player.php');
require ('config.php');
require ('Deck.php');

class Game {
	private $player;
	private $deck;

	public function __construct($playerIdentity, $startingCredits) {
		$this->player = new Player($playerIdentity, $startingCredits);
		$this->deck = new Deck();
	}

	public function startGame() {
		echo 'starting game... <br>';
		echo 'creating new player... <br>';
		var_dump($this->player);
		echo '<br >creating new deck... <br>';
		var_dump($this->deck);
	}

	public function endGame() {

	}

	public function dealHand() {
		
	}

	private function isGameRunnable() {

		return true;
	}
}