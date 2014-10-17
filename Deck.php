<?php

class Deck {
	// deck contains 52 cards

	private $cardsUsed = array();
	private $cards = array();

	public function __construct() {
		$this->cards = $this->createCards();
	}

	public function shuffleDeck() {

	}

	public function getCards() {
		return $this->cards;
	}
	
	private function createCards() {
		$temp = array();

		foreach (unserialize(RACES) as $race) {
			$temp[$race] = range(0,13);
		}
		return $temp;
	}
}