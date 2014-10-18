$(document).ready(function(){
  
  $('#bet').val(2);

  $('#changeBetButton').on('click', function() {
  	 var bet = parseInt($('#bet').val());

  	 var newBet = bet + 1;
  	 if (newBet === 6) {
  	 	newBet = 1;
  	 }

  	 $('#bet').val(newBet);
  });

  $('#startRoundButton').on('click', function() {
  	console.log('starting a round');
  	 $.post("game_controller.php",
	  {
	    bet: parseInt($('#bet').val()),
	    command: 'startNewRound'
	  },
	  function(data,status){
	  	if(status === 'success') {
	  		console.log('success, continuing round ' , data)
	  	}
	  });
  });

});