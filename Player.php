<?php

class Player {

	private $identity;
	private $credits;
	
	public function __construct($newIdentity, $newCredits) {
		
		$this->identity = $newIdentity;
		$this->credits = $newCredits;
		
	}
	
	public function addCredits($amount) {
		$this->credits += $amount;
	}
	
	public function getAccountBalance(){
		return $this->credits;
	}

	public function spendCredits($amountToSpend) {	
		$this->credits -= $amountToSpend;
		if ($this->credits < 0) $this->credits = 0;
	}
	
	public function __toString(){
		return "Player name: ". $this->identity ." and his balance: ". $this->credits . " euros.";
	}

}
