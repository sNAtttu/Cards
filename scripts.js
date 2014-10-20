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

  $('#addCredits').on('click',function() {
	var credits = parseInt($('#credits').val());
	console.log("You added: "+credits+" euros.");
	$.post("Player.php",
		{
			credits: parseInt($('$credit').val())
		});
  });

  var playerChosenCards = [];

  $('#startRoundButton').on('click', function() {
     $('#cardContainer').html('');
    console.log('chosen cards ' , playerChosenCards)

  	 $.post("game_controller.php",
	  {
	    bet: parseInt($('#bet').val()),
	    command: 'startNewRound',
      heldCards: playerChosenCards
	  },
	  function(data,status){
	  	if(status === 'success') {
        playerChosenCards = [];
	  		console.log('success, continuing round ' , data)
         
          for (var i = 0; i < data.gameData.pictures.length; i++ ){
            $('#cardContainer').append('<img src="'+data.gameData.pictures[i]+'" data="'+data.gameData.ids[i]+'" class="picturedCard" />');
          }
	  	} else {
        console.log(data, status)
      }
	  });
  });

   $(document).on("click",".picturedCard",function(){ 
        var cardData = $(this).attr('data');
        if(playerChosenCards.indexOf(cardData) === -1) {
          console.log('adding card')
          playerChosenCards.push(cardData);  
        }
        $(this).toggleClass('chosen');
        console.log('picture card clicked', cardData)
    });
});
