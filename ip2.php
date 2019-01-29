<?php 
echo $_SERVER["SERVER_ADDR"]."<br />";
$ch = curl_init("http://icanhazip.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
echo curl_exec($ch);

/*
სერვერის IP:  192.254.186.169
გმავალი IP:  198.57.247.135
*/ 