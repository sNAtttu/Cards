<?php
require ('Player.php');
require ('config.php');
require ('Deck.php');
require ('Hand.php');

class Game {
	private $player;
	private $deck;
	private $hand;

	public function __construct($playerIdentity, $startingCredits) {
		$this->player = new Player($playerIdentity, $startingCredits);
		$this->deck = new Deck();
		$this->hand = new Hand();
	}

	public function startGame() {
		echo 'starting game... <br>';
		echo 'creating new player... <br>';
		var_dump($this->player);
		echo '<br >creating new deck... <br>';
		var_dump($this->deck);

		// while isGameRunnable

			$this->startNewRound();
	}

	private function startNewRound() {
		echo '<br >starting a new round... <br>';
		$this->hand->setHand($this->dealHand());
	}

	public function endGame() {

	}

	public function dealHand() {
		return $this->deck->dealCards();
	}

	private function isGameRunnable() {

		return true;
	}
}