<?php

class Deck {
	
	private $cardsUsed = array();

	public function shuffleDeck() {
		$this->cardsUsed = array();
	}

	public function dealCards($heldCards) {
		$temp = array();

		if(isset($heldCards) && sizeof($heldCards) > 0) {

			foreach ($heldCards as $heldCard) {
				$tempSplit = explode("-", $heldCard);
				$tempCardValue = [intval($tempSplit[0]) => intval($tempSplit[1])];
				array_push($temp, $tempCardValue);
				array_push($this->cardsUsed, $tempCardValue);
			}
		}
			
		while (true) {
			$tempRace = unserialize(RACES)[rand(0,3)];
			$tempRank = rand(1,13);

			$tempCardValue = [$tempRace => $tempRank];

			if (!$this->isCardUsed($tempCardValue)) {
				array_push($this->cardsUsed, $tempCardValue);
				array_push($temp, $tempCardValue);

				if ( sizeof($temp) == 5 ) {
					return $temp;
					break;
				}
			}
		}
	}

	private function isCardUsed($cardValue) {
		return in_array($cardValue, $this->cardsUsed);
	}
}