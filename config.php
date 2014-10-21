<?php

	define ('RACES', 	serialize ( array ( '1', '2', '3', '4')));
	define ('RANKS', 	serialize ( (range( 1, 13 ))));

	define ('WINNINGS', serialize ( array(
		'Royal flush' 		=> 5000,
		'Straight flush' 	=> 2000,
		'Four of a kind' 	=> 200,
		'Full house' 		=> 50,
		'Flush' 			=> 20,
		'Straight' 			=> 10,
		'Three of a kind' 	=> 5,
		'Two pair' 			=> 4,
		'One pair' 			=> 2
	)));