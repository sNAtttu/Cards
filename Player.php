<?php

class Player {

	private $identity;
	private $credits = array();
	
	public function __construct($newIdentity, $newCredits) {
		
		$this->identity = $newIdentity;
		$this->credits = $newCredits;
		
	}
	
	public function addCredits() {
		
		$this->credits += 0;
		
	}
	
	public function getAccountBalance(){
		return array_sum($this->credits);
	}

	public function spendCredits($amountToSpend) {	
		$this->credits -= $amountToSpend;
		if ($this->credits < 0) $this->credits = 0;
	}
	
	public function __toString(){
		return "Player name: ". $this->identity ." and his balance: ". $this->credits . " euros.";
	}

}
