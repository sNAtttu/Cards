<?php
require ('PicturedCard.php');

class Hand{
	
	private $cardsInHand = array();
	private $cardsInHandAsPictures = array();
	
	public function getHand(){
		return $this->cardsInHand;
	}

	public function clearHand() {
		$this->cardsInHand = array();
		$this->cardsInHandAsPictures = array();
	}

	public function getHandAsPictures() {
		return $this->cardsInHandAsPictures;
	}

	public function getPlayersHand($cards) {
		$this->setHand($cards);
		return array('pictures' => $this->getHandAsPictures(), 'ids' => $this->getHand());
	}

	private function setHand($cards) {
		foreach ($cards as $card) {
			foreach ($card as $race => $rank) {
				$tempCard = new PicturedCard($race, $rank);
				array_push($this->cardsInHand, $tempCard->getCardData());
				array_push($this->cardsInHandAsPictures, $tempCard->getPictureFile());
			}
		}
	}
}