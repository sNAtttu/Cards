<html>
<head>
	<title> Cards </title>
	<meta <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="play.css" />
</head>
<body>

    <?php 
	include("picturedCard.php");
	$card1 = new picturedCard(1,2);
    ?>
<div class="center"> 
	<h2> Cards dealt </h2>
	<table>
		<td><img src="<?php echo($card1->getPictureFile());?>"/>
	</table>
</div>
<hr/> 
<fieldset><legend>*** Testing ***</legend>
<?php
include "Player.php";
$p = new Player("Santeri",1000);
echo("$p <br>");
echo("<p>Card 1: $card1 <br />");

?>
</body>
</html>
