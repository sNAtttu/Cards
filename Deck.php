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

		while (true) {
			$tempRace = unserialize(RACES)[rand(0,3)];
			$tempRank = rand(0,13);
			$tempCardValue = [$tempRace => $tempRank];

			if (!in_array($tempCardValue, $this->cardsUsed)) {
				array_push($this->cardsUsed, $tempCardValue);
				array_push($temp, $tempCardValue);

				if ( sizeof($temp) == 5 ) {
					return $temp;
					echo 'exit';
					break;
				}
			}
		}
	}
}