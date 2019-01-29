<?php
error_reporting(E_ALL);
/*
if($_SERVER["PHP_AUTH_USER"] !== "bbog" && $_SERVER["PHP_AUTH_PW"] !== "b2011bog")
{
	header("WWW-Authenticate: Basic realm=\"thetutlage\"");
	header("HTTP/1.0 401 Unauthorized");
	echo "You dont have permition !";
	exit();
}
*/

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';


$c['database.hostname'] = 'localhost';
$c['database.username'] = 'tripplan_ner';
$c['database.password'] = 'h.eR~[9-3HWK554';
$c['database.name'] = 'tripplan_ner';

try {
    $hostname = $c['database.hostname'];
    $dbname = $c['database.name'];
    $username = $c['database.username'];
    $password = $c['database.password'];
    $db_link = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
    // echo "Connected";
}
catch(PDOException $e)
{
   echo $e->getMessage();
}

$temps = [
		'request' => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
		'posts' => print_r($_POST,true)
	];
	$temps_sql = "INSERT INTO `temp` (request,posts) VALUES (:request,:posts)";
	$temps_stmt= $db_link->prepare($temps_sql);
	$temps_stmt->execute($temps);
	
	

$trx_id='';
$lang_code='';
$merch_id='';
$order_id='';
$o_website='';
$userid='';
$ts='';
if(isset($_GET["trx_id"])){$trx_id=$_GET["trx_id"];}
if(isset($_GET["lang_code"])){$lang_code=$_GET["lang_code"];}
if(isset($_GET["merch_id"])){$merch_id=$_GET["merch_id"];}
if(isset($_GET["o_order_id"])){$order_id=$_GET["o_order_id"];}
if(isset($_GET["o_website"])){$o_website=$_GET["o_website"];}else{ $o_website="beetrip"; }
if(isset($_GET["o_userid"])){$userid=$_GET["o_userid"];}
if(isset($_GET["ts"])){$ts=$_GET["ts"];}

switch($lang_code){
	
	case"KA":
		$language='ge';
	break;
	case"EN":
		$language='en';
	break;
	case"RU":
		$language='ru';
	break;
	default;
	$language='ge';
}
if($merch_id!="" && $merch_id=="D6640FE47F9AE706A041C0D913DCF654"){
	/*insert Transaction data*/
	$data = [
		'trx_id' => $trx_id,
		'lang_code' => $lang_code,
		'order_id' => $order_id,
		'userid' => $userid,
		'ts1' => $ts
	];
	$sql = "INSERT INTO `transactions` (trx_id,lang_code,order_id,userid,ts1) VALUES (:trx_id,:lang_code,:order_id,:userid,:ts1)";
	$stmt= $db_link->prepare($sql);
	$stmt->execute($data);
	$last_id = $db_link->lastInsertId();
	/*get cart info
	*	
	*	`cart`.`uniq`='".$order_id."' 
	*/
	$select = "SELECT 
	`cart`.`pid`,  
	`cart`.`type`,  
	`cart`.`tourplaces`,  
	`cart`.`totalprice`,  
	`cart`.`startplace` AS startplacex,  
	`cart`.`startplace2` AS startplacex2,  
	`cart`.`endplace` AS endplacex,   
	`cart`.`endplace2` AS endplacex2,   
	(SELECT `catalogs`.`title` FROM `catalogs` WHERE `catalogs`.`id`=startplacex AND `language`='".$language."' AND `deleted`=0) AS startPlaceName, 
	(SELECT `catalogs`.`title` FROM `catalogs` WHERE `catalogs`.`id`=endplacex AND `language`='".$language."' AND `deleted`=0) AS endPlaceName,
	(SELECT `catalogs`.`title` FROM `catalogs` WHERE `catalogs`.`id`=startplacex2 AND `language`='".$language."' AND `deleted`=0) AS startPlaceName2, 
	(SELECT `catalogs`.`title` FROM `catalogs` WHERE `catalogs`.`id`=endplacex2 AND `language`='".$language."' AND `deleted`=0) AS endPlaceName2
	FROM `cart`
	WHERE 
	`cart`.`userid`='".$userid."' AND 
	`cart`.`readytopay`='ready' AND 
	`cart`.`website`='".$o_website."' AND 
	`cart`.`status`='unpayed'";

	// error_log($select);
	
	$prepare = $db_link->prepare($select);
	$prepare->execute();

	if($prepare->rowCount()){
		$totalprice=0;
		$short_desc='';
		$full_desc='';
		$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			
		
		foreach($fetch as $cart_data){
			$totalprice = $totalprice+$cart_data["totalprice"];

			if($o_website=="tripplanner"){
				switch ($cart_data["type"]) {
					case 'transport':
						$short_desc .= htmlspecialchars($cart_data["startPlaceName"].' - '.$cart_data["endPlaceName"]).', ';
						$short_desc .= htmlspecialchars($cart_data["startPlaceName2"].' - '.$cart_data["endPlaceName2"]).', ';
						break;
					case 'plantrip':
						$ex = explode(",", $cart_data["tourplaces"]);
						$select2 = "SELECT `title` FROM `catalogs` WHERE `id` IN (".implode(",", $ex).") AND `language`='".$language."' AND `deleted`=0";
						$prepare2 = $db_link->prepare($select2);
						$prepare2->execute();
						if($prepare2->rowCount()){
							$fetch2 = $prepare2->fetchAll(PDO::FETCH_ASSOC);
							foreach ($fetch2 as $cart_data2) {
								$short_desc .= htmlspecialchars($cart_data2["title"]).', ';
							}
						}
						break;
					case 'ongoing':
						$pid = $cart_data["pid"];
						$select2 = "SELECT `title` FROM `catalogs` WHERE `id`='".(int)$pid."'";
						$prepare2 = $db_link->prepare($select2);
						$prepare2->execute();
						if($prepare2->rowCount()){
							$fetch2 = $prepare2->fetch(PDO::FETCH_ASSOC);
							$short_desc .= htmlspecialchars($fetch2["title"]).', ';
						}
					default:
						$short_desc .= "No desc";
						break;
				}
			}else{
				$short_desc .= htmlspecialchars($cart_data["startPlaceName"].' - '.$cart_data["endPlaceName"]).', ';
				$short_desc .= htmlspecialchars($cart_data["startPlaceName2"].' - '.$cart_data["endPlaceName2"]).', ';
			}
		}

	
		$full_desc = substr($short_desc,0,-2);
		$short_desc = substr($short_desc,0,-2);
		$short_desc = mb_substr(utf8_decode(utf8_encode(strip_tags($short_desc))), 0, 30, 'UTF-8');
		$totalprice = ($totalprice*100);
	
	echo '
<payment-avail-response>
	<result>
		<code>1</code>
		<desc>OK</desc>
	</result>
	<merchant-trx>'.$trx_id.'</merchant-trx>
	<purchase>
		<shortDesc>'.$short_desc.'</shortDesc>
		<longDesc>'.$full_desc.'</longDesc>
		<account-amount>
			<id>A7847EF2E8698E32F5049A983B1AE234</id>
			<amount>'.$totalprice.'</amount>
			<currency>981</currency>
			<exponent>2</exponent>
		</account-amount>
	</purchase>
</payment-avail-response>';
		
		
		/*
		OLD RESPONSE
		<payment-avail-response>
				<result>
					<code>1</code>
					<desc>OK</desc>
		  		</result>
		  		<merchant-trx>'.$last_id.'</merchant-trx>
		  		<transaction-type>Payment</transaction-type>

		  		<purchase> 
					<shortDesc>'.$short_desc.'</shortDesc>
					<longDesc>'.$full_desc.'</longDesc>
					<account-amount> 
			  			<amount>'.$totalprice.'</amount>
			  			<fee>0</fee>
			  			<currency>981</currency>
			  			<exponent>2</exponent>
					</account-amount>
		  		</purchase>
		  		
		  		<order-params>
					<param>
						<name>extended3DSResults</name>
						<value>true</value>
					</param>
		  		</order-params>
			</payment-avail-response>
		*/

		exit;
	}
	
}
echo '
	<payment-avail-response>
 		<result>
 			<code>2</code>
 			<desc>Unable to accept this payment</desc>
 		</result>
	</payment-avail-response>
';

?>