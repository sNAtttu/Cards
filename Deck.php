<?php

class Deck {
	// deck contains 52 cards

	private $cardsUsed = array();
	private $cards = array();

	//constructor
		// create 52 
	public function __construct() {
		$this->cards = $this->createCards();
	}

	public function shuffleDeck() {

	}
	
	private function createCards() {
		foreach (unserialize(RANKS) as $rank) {
			foreach (unserialize(RACES) as $race) {
				array_push($this->cards, $race .''. $rank);
			}
		}
	}
}