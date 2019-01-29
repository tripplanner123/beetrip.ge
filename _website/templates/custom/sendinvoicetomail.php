<?php 
if(isset($_GET["itemstobuy"]) && isset($_GET['user_bee'])){
	g_sent_order_mail("unpayed", "payed", "green", $_GET["itemstobuy"], '', $_GET['user_bee']);

	$sql = "UPDATE `cart` SET `status`='payed' WHERE `userid`='".$_GET['user_bee']."' AND `status`='unpayed' AND `readytopay`='ready' AND  `website`='".$_GET['o_website']."'";
	db_query($sql);	
}
?>