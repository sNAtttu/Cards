<?php
require ('Player.php');
require ('config.php');
require ('Deck.php');
require ('Hand.php');

class Game {
	private $player;
	private $deck;
	private $hand;
	private $bet;

	public function __construct($playerIdentity, $startingCredits) {
		$this->player = new Player($playerIdentity, $startingCredits);
		$this->deck = new Deck();
		$this->hand = new Hand();
		$this->bet = 5;
		$_SESSION['oneHandDealt'] = false;
	}

	public function startGame() {
		/*
		echo 'starting game... <br>';
		echo 'creating new player... <br>';
		var_dump($this->player);
		echo '<br >creating new deck... <br>';
		var_dump($this->deck);

		// while isGameRunnable

			$this->startNewRound();
			echo "<br> yay, player has " . $this->player->getAccountBalance()  . " euros!";
			*/


	}

	private function handleChangeCards($heldCards) {
		$_SESSION['oneHandDealt'] = false;
		return $this->dealHand($heldCards);
		return $this->hand->getPlayersHand($this->dealHand($heldCards));
		//TODO return new cards including the chosen cards
	}

	public function startNewRound($bet, $heldCards) {
		if($_SESSION['oneHandDealt'] == true) {
			return $this->handleChangeCards($heldCards);
		} else {
		
			$this->bet = $bet;
			$_SESSION['oneHandDealt'] = true;

			return $this->hand->getPlayersHand($this->dealHand(array()));	
		}
		
		//return '<br >starting a new round... <br>';
		//$this->hand->setHand($this->dealHand());
		//do something here

		//change player's cards

		// finally...
		//echo '<br> Checking round winnings: <br>';
		//$this->player->addCredits($this->getRoundWinnings());
	}

	public function getBetStatus() {
		return $this->bet;
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

	private function dealHand($heldCards) {
		return $this->deck->dealCards($heldCards);
	}

	private function isGameRunnable() {
		// player has enough money etc?
		return true;
	}

}