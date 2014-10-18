<?php 
require("Card.php");

class PicturedCard extends Card{
	public function __construct($newRank,$newRace){
		parent::__construct($newRank,$newRace);
	}
/* 	public function __construct(){
		parent::__construct();
	} */

	public function getPictureFile(){
		return "cardPics/" . $this->getRace() .",". $this->getRank().".png";
	}
	public function __toString(){
		return "Rank = " . $this->getRank(). "Race = ".$this->getRace().
			   ", picture file = " . 
		       $this->getPictureFile();
	}
}