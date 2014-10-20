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

  $('#addCredits').on('click',function(){
  var credits = parseInt($('#credits').val());
  console.log('Credits added: '+credits+' euros');
  });

  var playerChosenCards = [];

  $('#startRoundButton').on('click', function() {
    
    console.log('chosen cards ' , playerChosenCards)
  	console.log('starting a round', $('#cardContainer').children());
  	 $.post("game_controller.php",
	  {
	    bet: parseInt($('#bet').val()),
	    command: 'startNewRound',
      heldCards: playerChosenCards
	  },
	  function(data,status){
	  	if(status === 'success') {
	  		console.log('success, continuing round ' , data)
          for (var i = 0; i < data.pictures.length; i++ ){

            $('#cardContainer').append('<img src="'+data.pictures[i]+'" data="'+data.ids[i]+'" class="picturedCard" />');
          }
	  	} else {
        console.log(data, status)
      }
	  });
  });

   $(document).on("click",".picturedCard",function(){ 
        var cardData = $(this).attr('data');
        playerChosenCards.push(cardData);
        $(this).toggleClass('chosen');
        console.log('picture card clicked', cardData)
    });

  

});
