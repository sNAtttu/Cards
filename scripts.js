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
    console.log('x');
    $.post("game_controller.php",
    {
      command: 'forceRestart'
    }
  )});

  $('#startRoundButton').on('click', function() {
    console.log('y');
     $('#cardContainer').html('');

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
	  	} else {
        // handle possible errors
      }
	  });
  });

   $(document).on("click",".picturedCard.false",function(){ 
        var cardData = $(this).attr('data');
        if(playerChosenCards.indexOf(cardData) === -1) {
          playerChosenCards.push(cardData);  
        }
        $(this).toggleClass('chosen');
    });
});