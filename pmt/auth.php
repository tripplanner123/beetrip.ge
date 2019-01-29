<?php
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
	
	

$uri = $_SERVER['REQUEST_URI'];

 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $url; // Outputs: Full URL
 
#$query = $_SERVER['QUERY_STRING'];
#echo $query; // Outputs: Query String


 #$uri; // Outputs: URI


$data = [
    'url' => $url
];
$sql = "INSERT INTO temp (request) VALUES (:url)";
$stmt= $db_link->prepare($sql);
$stmt->execute($data);



echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<note>

<to><?=$_SERVER["PHP_AUTH_USER"]?></to>

<from>Jani</from>

<heading>Reminder</heading>

<body>Dont forget me this weekend!</body>

</note>

