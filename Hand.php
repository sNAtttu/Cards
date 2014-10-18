<?php
require ('PicturedCard.php');

class Hand{
	
	private $cardsInHand = array();
	private $cardsInHandAsPictures = array();
	
	public function getHand(){
		return $this->cardsInHand;
	}

	public function getHandAsPictures() {
		return $this->cardsInHandAsPictures;
	}

	public function getPlayersHand($cards) {
		$this->setHand($cards);
		return $this->getHandAsPictures();
	}

	private function setHand($cards) {
		foreach ($cards as $card) {
			foreach ($card as $race => $rank) {
				$tempCard = new PicturedCard($race, $rank);
				array_push($this->cardsInHand, $tempCard);
				array_push($this->cardsInHandAsPictures, $tempCard->getPictureFile());
			}
		}
	}
}