$(function() {
  
  $('#bet').val(2);

  $('#changeBetButton').on('click', function() {
  	 var bet = parseInt($('#bet').val());

  	 var newBet = bet + 1;
  	 if (newBet === 6) {
  	 	newBet = 1;
  	 }

  	 $('#bet').val(newBet);
  });

  var playerChosenCards = [];

  $('#forceRestart').on('click', function() {
    $.post("game_controller.php",
    {
      command: 'forceRestart'
    }
  )});
  
    $('#addCredits').on('click', function() {
    $.post("game_controller.php",
    {
	  credits: parseInt($('#credits')),
      command: 'addCredits'
    }
  )});

  $('#startRoundButton').on('click', function() {
     $('#cardContainer').html('');
     $('#winInfo').html('');
	 $('#winName').html('');

  	 $.post("game_controller.php",
	  {
	    bet: parseInt($('#bet').val()),
	    command: 'startNewRound',
      heldCards: playerChosenCards
	  },
	  function(data,status){
	  	if(status === 'success') {
        
        playerChosenCards = [];
         
          for (var i = 0; i < data.gameData.pictures.length; i++ ){
            $('#cardContainer').append('<img src="'+data.gameData.pictures[i]+'" data="'+data.gameData.ids[i]+'" class="picturedCard '+data.playerHasChosenCards+'" />');
          }
          $('#creditsLeft').html(data.playerData);
          $('#betAmount').html(data.bet);
          if(data.winnings > 0 ) {
            $('#winInfo').html('You win: ' + data.winnings + '!');
			$('#winName').html('Your hand: ' + data.winName + '!');
          }
          
	  	} else {
        // handle possible errors
      }
	  });
  });

   $(document).on("click",".picturedCard.false",function(){ 
        var cardData = $(this).attr('data');
		try{
			if(playerChosenCards.indexOf(cardData) === -1) {
			  playerChosenCards.push(cardData);  
			}
			$(this).toggleClass('chosen');
			} catch(err){
				document.getElementById("#cardContainer").innerHTML = err.message;
			}
			});
});