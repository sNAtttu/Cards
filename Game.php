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
		$this->player->addCredits($winnings[0]);
		return array('winnings' => $winnings[0],'winName' => $winnings[1], 'bet' => $this->getBetStatus(), 'gameData' => $tempHand, 'playerHasChosenCards' => true, 'playerData' => $this->player->getAccountBalance());
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
	
	private function makeRaceHand(){
		$tempCardValues = array();
	
		foreach($this->hand->getHand() as $card){
		$tempCard = explode("-", $card);
		array_push($tempCardValues, $tempCard[0]);
		}
		return $tempCardValues;
	}
	
	private function makeRankHand(){
		$tempCardValues = array();
	
		foreach($this->hand->getHand() as $card){
		$tempCard = explode("-", $card);
		array_push($tempCardValues, $tempCard[1]);
		}
		return $tempCardValues;
	}
	
	private function checkFlush() {
		$hand = $this->makeRaceHand();
		if (count(array_unique($hand)) == 1) {
			return true;
		}
	}
	
	private function checkStraight(){
		$hand = $this->makeRankHand();	
		if ((count(array_unique($hand)) == 5) and (max($hand)-min($hand)) == 4) {
			return true;
		}	
	}
	
	private function checkRoyalFlush(){
		$hand = $this->makeRankHand();	
		if(min($hand) == 9){
			if($this->checkFlush() == true and $this->checkStraight() == true){
				return true;
			}
			else{return false;}
		}
		else{return false;}
	}
	
	private function checkStraightFlush() {
		if($this->checkStraight() == true and $this->checkFlush() == true) {
			return true;
		}
	}
	
	private function checkFours(){
		$hand = $this->makeRankHand();
		if(count(array_unique($hand)) == 2){
			return true;
		}
	}
	
	private function checkThrees() {
		$tempCardValues = array();
		$index = 0;
		foreach($this->hand->getHand() as $card){
			$tempCard = explode("-", $card);
			if(in_array($tempCard[1], $tempCardValues)) {
				$index += 1;
				if($index == 2){
					return true;
					}
				}
			else {
				return false;
				}
			array_push($tempCardValues, $tempCard[1]);
		}
	
	}
	
	private function checkTwoPairs(){
		$hand = $this->makeRankHand();
		if(count(array_unique($hand)) == 3 and $this->checkThrees() == false){
			return true;
		}
	}
	
	private function checkFullhouse(){
		$hand = $this->makeRankHand();
		if((count(array_unique($hand)) == 2) and $this->checkThrees() == true){
			return true;
		}
	}
	
	private function checkPairs(){
		$tempCardValues = array();
		foreach($this->hand->getHand() as $card){
			$tempCard = explode("-", $card);
			if(in_array($tempCard[1], $tempCardValues)) {
					return true;
				}
			array_push($tempCardValues, $tempCard[1]);
		}
	}
	
	private function getRoundWinnings() {
		$tempCardValues = array();
		$winFactor = unserialize(WINNINGS);
		
		foreach ($winFactor as $key => $value) {
			
			if($this->checkRoyalFlush() == true){
				return array(($this->bet * $winFactor['Royal flush']),"Royal Flush!");;
			}
			elseif($this->checkStraightFlush() == true){
				return array(($this->bet * $winFactor['Straight flush']),"Straight Flush!");;
			}
			elseif($this->checkFours() == true){
				return array(($this->bet * $winFactor['Four of a kind']),"Four of a kind!");;
			}
			elseif($this->checkFullhouse() == true){
				return array(($this->bet * $winFactor['Full house']),"OMG FULL HOUSE!");;
			}
			elseif($this->checkFlush() == true) {
				return array(($this->bet * $winFactor['Flush']),"Flush!");;
			}
			elseif($this->checkStraight() == true) {
				return array(($this->bet * $winFactor['Straight']),"Straight!");
			}	
			elseif($this->checkThrees() == true){
				return array(($this->bet * $winFactor['Three of a kind']),"Three of a kind!");
				}
			elseif($this->checkTwoPairs() == true){
				return array(($this->bet * $winFactor['Two pair']),"Two pairs!");
			}
			elseif($this->checkPairs() == true) {
				return array(($this->bet * $winFactor['One pair']),"One pair -.-");
			}
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