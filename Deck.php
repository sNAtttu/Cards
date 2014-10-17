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
		foreach (unserialize(RANKS) as $rank) {
			foreach (unserialize(RACES) as $race) {
				array_push($temp, $race .''. $rank);
			}
		}
		$this->cards = $temp;
	}
}