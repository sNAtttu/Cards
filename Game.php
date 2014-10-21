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

	private function handleChangeCards($bet, $heldCards) {
		$_SESSION['oneHandDealt'] = false;
		$tempHand = $this->hand->getPlayersHand($this->dealHand($heldCards));
		$winnings = $this->getRoundWinnings();
		$this->player->addCredits($winnings);
		return array('winnings' => $winnings, 'bet' => $this->getBetStatus(), 'gameData' => $tempHand, 'playerHasChosenCards' => true, 'playerData' => $this->player->getAccountBalance());
	}

	public function startNewRound($bet, $heldCards) {
		if($_SESSION['oneHandDealt'] == true) {
			return $this->handleChangeCards($bet, $heldCards);
		} else {
			$this->deck->shuffleDeck();
			$this->bet = $bet;
			$this->player->spendCredits($bet);
			$_SESSION['oneHandDealt'] = true;
			$tempHand = $this->hand->getPlayersHand($this->dealHand(array()));

			return array('bet' => $this->getBetStatus(), 'gameData' => $tempHand, 'playerHasChosenCards' => false, 'playerData' => $this->player->getAccountBalance());	
		}
	}

	public function getBetStatus() {
		return $this->bet;
	}
	
	private function checkFlush() {
		$tempCardValues = array();
		
		foreach($this->hand->getHand() as $card){
			$tempCard = explode("-", $card);
			array_push($tempCardValues, $tempCard[0]);
		}
		
		if (count(array_unique($tempCardValues)) == 1) {
			return true;
		}
		
	}
	
	private function getRoundWinnings() {
		$tempCardValues = array();
		$winFactor = unserialize(WINNINGS);
		
		foreach ($this->hand->getHand() as $card) {
			$tempCard = explode("-", $card);
			
			if($this->checkFlush() == true) {
				return ($this->bet * $winFactor['Flush']);
			}			
			elseif(in_array($tempCard[1], $tempCardValues)) {
				return ($this->bet * $winFactor['One pair']);
			}

			array_push($tempCardValues, $tempCard[1]);
		}
		return 0;
	}

	private function dealHand($heldCards) {
		$this->hand->clearHand();
		return $this->deck->dealCards($heldCards);
	}

	private function isGameRunnable() {
		if($this->player->getAccountBalance() > 0) {
			return true;
		}
	}
}