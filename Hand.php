<?php
require ('Card.php');

class Hand{
	
	private $cardsInHand = array();
	
	public function getHand(){
		return $this->cardsInHand;
	}

	public function setHand($cards) {
		foreach ($cards as $card) {
			foreach ($card as $race => $rank) {
				$tempCard = new Card($race, $rank);
				array_push($this->cardsInHand, $tempCard);
			}
		}
	}
}