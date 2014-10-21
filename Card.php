<?php
//asd
class Card {

	private $race;
	private $rank;
	
	public function __construct($newRace,$newRank){
		$this->race = $newRace;
		$this->rank = $newRank;
	}

	public function getRank(){
		return $this->rank;
	}
	public function getRace(){
		return $this->race;
	}

	public function getCardData() {
		return "".$this->race."-".$this->rank."";
	}
}
