<?php

class Deck {
	// deck contains 52 cards

	private $cardsUsed = array();


	public function __construct() {
		//$this->cards = $this->createCards();
	}

	public function shuffleDeck() {

	}

	public function dealCards() {
		$temp = array();
		for ($i = 0; $i < 5; $i++) {
			$tempRace = unserialize(RACES)[rand(0,3)];
			$tempRank = rand(0,13);
			$tempCardValue = [$tempRace => $tempRank];
			$temp[$i] = $tempCardValue;

			array_push($this->cardsUsed, $tempCardValue);
		}
		return $temp;
	}
}