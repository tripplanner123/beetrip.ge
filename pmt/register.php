<?php
error_reporting(0);
ini_set('display_errors', false);
/*
if($_SERVER["PHP_AUTH_USER"] !== "bbog" && $_SERVER["PHP_AUTH_PW"] !== "b2011bog")
{
	header("WWW-Authenticate: Basic realm=\"thetutlage\"");
	header("HTTP/1.0 401 Unauthorized");
	echo "You dont have permition !";
	exit();
}
*/

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
$merch_id='';
$merchant_trx='';
$order_id='';
$result_code=2;
$amount='';
$account_id='';
$m_extended3DSResults='';
$o_order_id='';
$o_userid='';
$o_lang='';
$p_isFullyAuthenticated='';
$p_maskedPan='';
$p_cardholder='';
$ts2='';
$signature='';
$o_website='';
$o_currency='gel';

if(isset($_GET["trx_id"])){$trx_id=$_GET["trx_id"];}
if(isset($_GET["merch_id"])){$merch_id=$_GET["merch_id"];}
if(isset($_GET["merchant_trx"])){$merchant_trx=$_GET["merchant_trx"];}
if(isset($_GET["result_code"])){$result_code=$_GET["result_code"];}
if(isset($_GET["amount"])){$amount=$_GET["amount"];}
if(isset($_GET["account_id"])){$account_id=$_GET["account_id"];}
if(isset($_GET["m_extended3DSResults"])){$m_extended3DSResults=$_GET["m_extended3DSResults"];}
if(isset($_GET["o_order_id"])){$o_order_id=$_GET["o_order_id"];}
if(isset($_GET["o_userid"])){$o_userid=$_GET["o_userid"];}
if(isset($_GET["o_lang"])){$o_lang=$_GET["o_lang"];}
if(isset($_GET["o_website"])){$o_website=$_GET["o_website"];}else{ $o_website="beetrip"; }
if(isset($_GET["p_isFullyAuthenticated"])){$p_isFullyAuthenticated=$_GET["p_isFullyAuthenticated"];}
if(isset($_GET["p_maskedPan"])){$p_maskedPan=$_GET["p_maskedPan"];}
if(isset($_GET["p_cardholder"])){$p_cardholder=$_GET["p_cardholder"];}
if(isset($_GET["ts"])){$ts2=$_GET["ts"];}
if(isset($_GET["signature"])){$signature=$_GET["signature"];}
if(isset($_GET["o_currency"])){$o_currency=$_GET["o_currency"];}


if($trx_id!="" && $merchant_trx!="" && $merch_id!="" && $merch_id=="D6640FE47F9AE706A041C0D913DCF654"){


	/*update transaction results*/
	$data = [
		'id' => $merchant_trx,
		'result_code' => $result_code,
		'amount' => $amount,
		'account_id' => $account_id,
		'm_extended3DSResults' => $m_extended3DSResults,
		'p_isFullyAuthenticated' => $p_isFullyAuthenticated,
		'p_maskedPan' => $p_maskedPan,
		'p_cardholder' => $p_cardholder,
		'ts2' => $ts2,
		'signature' => $signature
	];
	$sql = "UPDATE `transactions` SET `result_code`=:result_code, `amount`=:amount, `account_id`=:account_id, `m_extended3DSResults`=:m_extended3DSResults, `p_isFullyAuthenticated`=:p_isFullyAuthenticated, `p_maskedPan`=:p_maskedPan, `p_cardholder`=:p_cardholder, ts2=:ts2, `signature`=:signature WHERE `id`=:id";
	$stmt= $db_link->prepare($sql);
	$stmt->execute($data);
	
	/*update cart*/
	if($result_code==1){
		if($o_website=="beetrip"){//send invoice
			$select = "SELECT `id` FROM `cart` WHERE `status`='unpayed' AND `userid`='".$o_userid."' AND `readytopay`='ready' AND `website`='".$o_website."'";
			$prepare = $db_link->prepare($select);
			$prepare->execute();
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			$itemstobuy = array();
			foreach ($fetch as $value) {
				$itemstobuy[] = $value["id"];
			}
			$itemstobuy = implode(",", $itemstobuy);
			$path = "https://beetrip.ge/".$o_lang."/sendinvoicetomail/?itemstobuy=".$itemstobuy."&user_bee=".$o_userid."&o_website=".$o_website;
			file_get_contents($path);
			// error_log($path);
		}else{
			$select = "SELECT `uniq` FROM `cart` WHERE `status`='unpayed' AND `userid`='".$o_userid."' AND `readytopay`='ready' AND `website`='".$o_website."'";
			$prepare = $db_link->prepare($select);
			$prepare->execute();
			$fetch = $prepare->fetchAll(PDO::FETCH_ASSOC);
			$itemstobuy = array();
			foreach ($fetch as $value) {
				$itemstobuy[] = $value["uniq"];
			}
			// $itemstobuy = implode(",", $itemstobuy);
			$path = "https://tripplanner.ge/".$o_lang."/sendinvoicetomail/?itemstobuy=".$itemstobuy[0]."&user_trip=".$o_userid."&o_website=".$o_website;
			file_get_contents($path);
			//error_log($path);


			// $sql = "UPDATE `cart` SET `status`=:status WHERE `userid`=:userid AND `status`='unpayed' AND `readytopay`='ready' AND  `website`='{$o_website}'";
			// $stmt= $db_link->prepare($sql);
			// $stmt->execute(array(
			// 	':userid' => $o_userid,
			// 	':status' => 'payed'
			// ));
		}
	}
	
	#print_r($stmt->errorInfo());
	/*rodesac yvelaferi rigzea*/
	echo '
	<register-payment-response>
	 <result>
	 <code>1</code>
	 <desc>OK</desc>
	 </result>
	</register-payment-response>';
	exit;
}
/*roca shecdomaa sistemashi an momartvashi*/

echo '<register-payment-response>
 <result>
 <code>2</code>
 <desc>Temporary unavailable</desc>
 </result>
</register-payment-response>';
/*update cart*/
	// $data = [
	// 	'userid' => $o_userid,
	// 	'status' => 'unpayed'
	// ];
	// $sql = "UPDATE `cart` SET `status`=:status WHERE `userid`=:userid";
	// $stmt= $db_link->prepare($sql);
	// $stmt->execute($data);
?>