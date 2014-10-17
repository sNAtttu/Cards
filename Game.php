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
			echo "<br> yay, player has " . $this->player->getAccountBalance()  . " euros!";
	}

	private function startNewRound() {
		echo '<br >starting a new round... <br>';
		$this->hand->setHand($this->dealHand());
		//do something here

		// finally...
		$this->player->addCredits($this->getRoundWinnings());
	}

	public function endGame() {

	}

	private function getRoundWinnings() {

		//this just checks for a pair

		// THIS IS JUST AN EXAMPLE
		$tempCardValues = array();
		foreach ($this->hand->getHand() as $card) {
			
			if(in_array($card->getRank(), $tempCardValues)) {
				return 10;
			}

			array_push($tempCardValues, $card->getRank());
		}
		return 0;
	}

	private function dealHand() {
		return $this->deck->dealCards();
	}

	private function isGameRunnable() {
		// player has enough money etc?
		return true;
	}

}