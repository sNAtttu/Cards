<?php

class Player{

	private $identity;
	private $credits;
	
	public function __construct($newIdentity, $newCredits) {
		
		$this->identity = $newIdentity;
		$this->credits = $newCredits;
		
	}
	
	public function addCredits() {
		
		$this->credits += 0;
		
	}
	
	public function getAccountBalance(){
		return $this->credits;
	}
	
	public function __toString(){
		return "Player name: ". $this->identity ." and his balance: ". $this->credits . " euros.";
	}
	

}

?>
