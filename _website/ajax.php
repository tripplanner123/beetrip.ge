<?php
    defined('DIR') OR exit;

    if(!session_id()) {
        session_start();
    }

    $out = array(
        "Error" => array(
            "Code"=>1, 
            "Text"=>l("error"),
            "gErrorRedLine"=>array("popupbox"),
            "Details"=>""
        ),
        "Success"=>array(
            "Code"=>0, 
            "Text"=>"",
            "Details"=>""
        )
    ); 

    if(isset($_GET['fb-callback']) ){
        require_once('_plugins/php-graph-sdk-5.x/src/Facebook/autoload.php'); 
        $fb = new Facebook\Facebook([
            'app_id' => '202840937188596', // Replace {app-id} with your app id
            'app_secret' => 'd4823824542c5b7ef24896eb5a39c354',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // echo 'Graph returned an error: ' . $e->getMessage();
            header("Location: /");
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // echo '123 Facebook SDK returned an error: ' . $e->getMessage();
          // exit;
        }

        if (!isset($accessToken)) {
          if ($helper->getError()) {
            // header('HTTP/1.0 401 Unauthorized');
            // echo "Error: " . $helper->getError() . "\n";
            // echo "Error Code: " . $helper->getErrorCode() . "\n";
            // echo "Error Reason: " . $helper->getErrorReason() . "\n";
            // echo "Error Description: " . $helper->getErrorDescription() . "\n";
            header("Location: /");
            exit;
          } else {
            // header('HTTP/1.0 400 Bad Request');
            // echo 'Bad request';
            header("Location: /");
            exit;
          }
          exit;
        }

        $_SESSION['fb_access_token'] = (string) $accessToken;        

        try {
          $response = $fb->get('/me?fields=birthday,name,email,gender,picture.width(350).height(350)', $accessToken);         
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // echo 'Graph returned an error: ' . $e->getMessage();
            header("Location: /");
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // echo 'Facebook SDK returned an error: ' . $e->getMessage(); 
          // exit;
            header("Location: /");
        }
        $user = $response->getGraphUser();
        //print_r($response);

        $sql = "SELECT * FROM `site_users` WHERE `email`='".$user['email']."' AND `deleted`=0";
        $fetch = db_fetch($sql);
        if(isset($fetch['id'])){
            $_SESSION["beetrip_user"] = $user['email'];
            $_SESSION["beetrip_user_info"] = $fetch;

            if(isset($_SESSION["cartsession"]))
            {
                $userid = $_SESSION["cartsession"];
                $sql5 = "UPDATE `cart` SET `userid`='".$user['email']."' WHERE `userid`='".$userid."'";
                db_query($sql5);
            }

            $redirect = $_SERVER['HTTP_REFERER'];
            if(
                !preg_match_all("/facebook\.com/", $redirect, $matches) && 
                !preg_match_all("/https:\/\/beetrip.ge\/\w{2}\/registration/", $redirect, $matches)
            ){
                $redirect = $_SERVER['HTTP_REFERER'];
            }else{
                $redirect = 'https://' . $_SERVER['HTTP_HOST'] . '/'.l().'/home';
            }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirect);
            exit;
        }else{

            $name = (isset($user['name'])) ? explode(" ", $user['name']) : "";
            $picture = (isset($user['picture'])) ? $user['picture']['url'] : "";
            $firstname = (isset($name[0])) ? $name[0] : '';
            $lastname = (isset($name[1])) ? $name[1] : '';

            $sql = "INSERT INTO `site_users` SET `date`='".time()."', `username`='".$user['email']."', `userpass`='".md5(156484691)."', `email`='".$user['email']."', `firstname`='".$firstname."', `lastname`='".$lastname."', `picture`='".$picture."', `website`='beetrip'";

            db_query($sql);

            $sql = "SELECT * FROM `site_users` WHERE `email`='".$user['email']."' AND `deleted`=0";
            $fetch = db_fetch($sql);
            $_SESSION["beetrip_user"] = $user['email'];
            $_SESSION["beetrip_user_info"] = $fetch;

            if(isset($_SESSION["cartsession"]))
            {
                $userid = $_SESSION["cartsession"];
                $sql5 = "UPDATE `cart` SET `userid`='".$user['email']."' WHERE `userid`='".$userid."'";
                db_query($sql5);
            }

            $redirect = $_SERVER['HTTP_REFERER'];
            if(!preg_match_all("/https:\/\/beetrip.ge\/\w{2}\/registration/", $redirect, $matches)){
                $redirect = $_SERVER['HTTP_REFERER'];
            }else{
                $redirect = 'https://' . $_SERVER['HTTP_HOST'] . '/'.l().'/home';
            }
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $redirect);
            exit();
        }
        exit();
    }

    if(isset($_GET["sql"])){
        exit();
    }

    if(isset($_POST["type"]))
    {
        $type = $_POST["type"];
        switch ($type) {
            case 'savePickupPlaces':
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["pickupplacses"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");
                    $successText = "";          
                    $countCartitem = 0;
                }else{
                    $json = json_decode($_POST["pickupplacses"], true);
                    $update = "";
                    foreach ($json as $v) {
                        if($v["double"]=="false"){
                            $update .= "UPDATE `cart` SET `wherepickup`='".$v["value"]."' WHERE `id`='".$v["id"]."';"; 
                        }else{
                            $update .= "UPDATE `cart` SET `wherepickup2`='".$v["value"]."' WHERE `id`='".$v["id"]."';"; 
                        }
                    }
                    db_query($update);

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $successText = l("welldone");
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case 'insertTransCart':
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["startplace"]) || 
                    empty($_POST["endplace"]) || 
                    empty($_POST["startdatetrans"]) || 
                    empty($_POST["timeTrans"]) || 
                    empty($_POST["guestnumber"]) ||
                    empty($_POST["TransporDropDownId"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");
                    $successText = "";          
                    $countCartitem = 0;
                }else{
                    $roud1_price = 0;
                    $roud2_price = 0;


                    $sql = "SELECT `map_coordinates` FROM `catalogs` WHERE `id`='".(int)$_POST["startplace"]."' AND `language`='".$_POST["input_lang"]."' AND `deleted`=0 AND `visibility`=1";
                    $fetch = db_fetch($sql);
                    $map_coordinates1 = str_replace(":", ",", $fetch['map_coordinates']);
                    $ex = explode(",", $map_coordinates1);
                    $lat1 = $ex[0];
                    $long1 = $ex[1];

                    $sql2 = "SELECT `map_coordinates` FROM `catalogs` WHERE `id`='".(int)$_POST["endplace"]."' AND `language`='".$_POST["input_lang"]."' AND `deleted`=0 AND `visibility`=1";
                    $fetch2 = db_fetch($sql2);
                    $map_coordinates2 = str_replace(":", ",", $fetch2['map_coordinates']);
                    $ex2 = explode(",", $map_coordinates2);
                    $lat2 = $ex2[0];
                    $long2 = $ex2[1];                    

                    $sql3 = "SELECT * FROM `pages` WHERE `id`='".(int)$_POST['TransporDropDownId']."' AND `deleted`=0 AND `language`='".$_POST["input_lang"]."'";
                    $fetch3 = db_fetch($sql3);
                    // $google = g_getDrivingDistance($lat2, $long2, $lat1, $long1);
                    // $km = (float)$google['distance'];
                    $km = (float)$_POST['km'];
                    
                    $totalCrew = (int)$_POST["guestnumber"] + (int)$_POST["numberofchildren612"] + (int)$_POST["numberofchildren05"]; 

                    if($km<=49){
                        $transport_price_per_km = (float)$fetch3['menutitle'];
                    }else if($km<=99){
                        $transport_price_per_km = (float)$fetch3['menutitle2'];
                    }else if($km<=149){
                        $transport_price_per_km = (float)$fetch3['menutitle3'];
                    }else if($km<=199){
                        $transport_price_per_km = (float)$fetch3['menutitle4'];
                    }else if($km<=249){
                        $transport_price_per_km = (float)$fetch3['menutitle5'];
                    }else if($km<=299){
                        $transport_price_per_km = (float)$fetch3['menutitle6'];
                    }else if($km<=349){
                        $transport_price_per_km = (float)$fetch3['menutitle7'];
                    }else if($km<=399){
                        $transport_price_per_km = (float)$fetch3['menutitle8'];
                    }else if($km>=400){
                        $transport_price_per_km = (float)$fetch3['menutitle9'];
                    }

                    $howManyVehicle = ceil($totalCrew / (int)$fetch3['menutitle10']);

                    $transport_name1 = "";
                    if($_POST['TransporDropDownId']==125){//sedan
                        $transport_name1 = "Sedan";
                    }else if($_POST['TransporDropDownId']==126){//minivan
                        $transport_name1 = "Minivan";
                    }else if($_POST['TransporDropDownId']==127){//bus
                        $transport_name1 = "Bus";
                    }else if($_POST['TransporDropDownId']==220){//Mini bus
                        $transport_name1 = "MiniBus";
                    }

                    $totalprice = ((int)round($km*$transport_price_per_km) * $howManyVehicle) + (int)$_POST["ten1"];
                    
                    $incomeProcent = (int)$fetch3['menutitle11'];
                    $totalprice = $totalprice + ($totalprice * $incomeProcent / 100);

                    $roud1_price = $totalprice;


                    /* double way start */
                    $transport_name2 = "";
                    $startplace2 = "";
                    $endplace2 = "";
                    if(
                        isset($_POST["startplace2"]) && 
                        isset($_POST["endplace2"]) && 
                        !empty($_POST["startplace2"]) && 
                        !empty($_POST["endplace2"]) 
                    ){
                        $sql500 = "SELECT * FROM `pages` WHERE `id`='".(int)$_POST['TransporDropDownId2']."' AND `deleted`=0 AND `language`='".$_POST["input_lang"]."'";
                        $fetch500 = db_fetch($sql500);

                        $startplace2 = $_POST["startplace2"];
                        $endplace2 = $_POST["endplace2"];
                        $sql4 = "SELECT `map_coordinates` FROM `catalogs` WHERE `id`='".(int)$_POST["startplace2"]."' AND `language`='".$_POST["input_lang"]."' AND `deleted`=0 AND `visibility`=1";
                        $fetch4 = db_fetch($sql4);
                        $map_coordinates4 = str_replace(":", ",", $fetch4['map_coordinates']);
                        $ex4 = explode(",", $map_coordinates4);
                        $lat4 = $ex4[0];
                        $long4 = $ex4[1];

                        $sql5 = "SELECT `map_coordinates` FROM `catalogs` WHERE `id`='".(int)$_POST["endplace2"]."' AND `language`='".$_POST["input_lang"]."' AND `deleted`=0 AND `visibility`=1";
                        $fetch5 = db_fetch($sql5);
                        $map_coordinates5 = str_replace(":", ",", $fetch5['map_coordinates']);
                        $ex5 = explode(",", $map_coordinates5);
                        $lat5 = $ex5[0];
                        $long5 = $ex5[1];

                        $kmDouble = (float)$_POST['km2'];
                        $totalCrew2 = (int)$_POST["guestnumber2"] + (int)$_POST["numberofchildren612_"] + (int)$_POST["numberofchildren05_"]; 
                        

                        if($kmDouble<=49){
                            $transport_price_per_km2 = (float)$fetch500['menutitle'];
                        }else if($kmDouble<=99){
                            $transport_price_per_km2 = (float)$fetch500['menutitle2'];
                        }else if($kmDouble<=149){
                            $transport_price_per_km2 = (float)$fetch500['menutitle3'];
                        }else if($kmDouble<=199){
                            $transport_price_per_km2 = (float)$fetch500['menutitle4'];
                        }else if($kmDouble<=249){
                            $transport_price_per_km2 = (float)$fetch500['menutitle5'];
                        }else if($kmDouble<=299){
                            $transport_price_per_km2 = (float)$fetch500['menutitle6'];
                        }else if($kmDouble<=349){
                            $transport_price_per_km2 = (float)$fetch500['menutitle7'];
                        }else if($kmDouble<=399){
                            $transport_price_per_km2 = (float)$fetch500['menutitle8'];
                        }else if($kmDouble>=400){
                            $transport_price_per_km2 = (float)$fetch500['menutitle9'];
                        }

                        $howManyVehicle2 = ceil((int)$totalCrew / (int)$fetch500['menutitle10']);

                        if($_POST['TransporDropDownId2']==125){//sedan
                            $transport_name2 = "Sedan";
                        }else if($_POST['TransporDropDownId2']==126){//minivan
                            $transport_name2 = "Minivan";
                        }else if($_POST['TransporDropDownId2']==127){//bus
                            $transport_name2 = "Bus";
                        }else if($_POST['TransporDropDownId2']==220){//mini bus
                            $transport_name2 = "Mini Bus";
                        }

                        //same way back discount
                        if($_POST["startplace"]==$_POST["endplace2"] && $_POST["endplace"]==$_POST["startplace2"] && $_POST["startdatetrans"]==$_POST["startdatetrans2"]){
                            $transport_price_per_km2 = $transport_price_per_km2 - (((float)$transport_price_per_km2*(int)$fetch500["samewaydiscount2"]) / 100);
                        }

                        $roud2_price = round((float)$kmDouble*(float)$transport_price_per_km2) * $howManyVehicle2 + (int)$_POST["ten2"];

                        $incomeProcent2 = (int)$fetch500['menutitle11'];
                        $roud2_price = $roud2_price + ($roud2_price * $incomeProcent2 / 100);



                        $totalprice += $roud2_price;
                    }
                    /* double way end */

                    if(isset($_SESSION["beetrip_user"])){
                        $userid = $_SESSION["beetrip_user"];
                    }else{
                        if(isset($_SESSION["cartsession"]))
                        {
                            $userid = $_SESSION["cartsession"];
                        }else{
                            $_SESSION["cartsession"] = g_random(15);
                            $userid = $_SESSION["cartsession"];
                        }
                    }							
 
					/*mamuka*/
					$select = "SELECT `uniq` FROM `cart` WHERE `status`='unpayed' AND `userid`='".$userid."'";
					$fetch = db_fetch($select);
					if(isset($fetch["uniq"]) && $fetch["uniq"]!=""){
						$code=$fetch["uniq"];
					}
					else{
						$code= substr(md5(uniqid(mt_rand(),true)), 11);
					}
                    $startDate = explode("-", $_POST["startdatetrans"]);
                    $day = (isset($startDate[0])) ? $startDate[0] : 0;
                    $month = (isset($startDate[1])) ? $startDate[1] : 0;
                    $year = (isset($startDate[2])) ? $startDate[2] : 0;
                    $startDate = sprintf("%s-%s-%s", $year, $month, $day);

                    //$_POST[""]
                    $startDate2 = explode("-", $_POST["startdatetrans2"]);
                    $day2 = (isset($startDate2[0])) ? $startDate2[0] : 0;
                    $month2 = (isset($startDate2[1])) ? $startDate2[1] : 0;
                    $year2 = (isset($startDate2[2])) ? $startDate2[2] : 0;
                    $startDate2 = sprintf("%s-%s-%s", $year2, $month2, $day2);

					/*mamuka*/
                    $sqlCart = "INSERT INTO `cart` SET 
                    `uniq`='".$code."',					
					`date`='".time()."',
                    `pid`='0', 
                    `userid`='{$userid}', 
                    `type`='transport', 
                    `startdate`='{$startDate}', 
                    `timetrans`='{$_POST["timeTrans"]}', 
                    `startplace`='{$_POST["startplace"]}', 
                    `endplace`='{$_POST["endplace"]}', 
                    `guests`='{$_POST["guestnumber"]}',
                    `children`='{$_POST["numberofchildren612"]}',
                    `childrenunder`='{$_POST["numberofchildren05"]}',
                    `double`='0', 
                    `startdate2`='{$startDate2}', 
                    `timetrans2`='{$_POST["timeTrans2"]}', 
                    `startplace2`='{$_POST["startplace2"]}', 
                    `endplace2`='{$_POST["endplace2"]}', 
                    `guests2`='{$_POST["guestnumber2"]}',
                    `children2`='{$_POST["numberofchildren612_"]}',
                    `childrenunder2`='{$_POST["numberofchildren05_"]}',
                    `totalprice`='{$totalprice}', 
                    `transport_name1`='{$transport_name1}', 
                    `transport_name2`='{$transport_name2}', 
                    `roud1_price`='{$roud1_price}', 
                    `roud2_price`='{$roud2_price}',
                    `website`='beetrip'
                    ";
                    db_query($sqlCart);

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $successText = l("welldoneorder");
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case 'mapClicked':

                $Html = "";

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["map_id"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    $successText = "";                

                    $countCartitem = 0;  

                    $Html = "";              

                }else{

                    $map_id = (isset($_POST["map_id"])) ? $_POST["map_id"] : 0;

                    switch ($map_id) {

                        case 1:

                            $map_id = 101;

                            break;

                        case 2:

                            $map_id = 92;

                            break;

                        case 3:

                            $map_id = 98;

                            break;

                        case 4:

                            $map_id = 90;

                            break;

                        case 5:

                            $map_id = 100;

                            break;

                        case 6:

                            $map_id = 94;

                            break;

                        case 7:

                            $map_id = 93;

                            break;

                        case 8:

                            $map_id = 97;

                            break;

                        case 11:

                            $map_id = 96;

                            break;

                        case 9:

                            $map_id = 95;

                            break;

                        case 10:

                            $map_id = 99;

                            break;

                        case 12:

                            $map_id = 91;

                            break;

                    }



                    $sql = "SELECT 

                    (

                        SELECT 

                        COUNT(`catalogs`.`id`)

                        FROM 

                        `catalogs`

                        WHERE 

                        FIND_IN_SET(`pages`.`id`, `catalogs`.`regions`) AND 

                        FIND_IN_SET('105', `catalogs`.`categories`) AND 

                        `catalogs`.`menuid`=24 AND 

                        `catalogs`.`language`='".$_POST["input_lang"]."' AND 

                        `catalogs`.`visibility`=1 AND 

                        `catalogs`.`deleted`=0

                    ) AS sights_counted,

                    (

                        SELECT 

                        COUNT(`catalogs`.`id`)

                        FROM 

                        `catalogs`

                        WHERE 

                        FIND_IN_SET(`pages`.`id`, `catalogs`.`regions`) AND 

                        FIND_IN_SET('106', `catalogs`.`categories`) AND 

                        `catalogs`.`menuid`=24 AND 

                        `catalogs`.`language`='".$_POST["input_lang"]."' AND 

                        `catalogs`.`visibility`=1 AND 

                        `catalogs`.`deleted`=0

                    ) AS wine_counted, 

                    (

                        SELECT 

                        COUNT(`catalogs`.`id`)

                        FROM 

                        `catalogs`

                        WHERE 

                        FIND_IN_SET(`pages`.`id`, `catalogs`.`regions`) AND 

                        FIND_IN_SET('107', `catalogs`.`categories`) AND 

                        `catalogs`.`menuid`=24 AND 

                        `catalogs`.`language`='".$_POST["input_lang"]."' AND 

                        `catalogs`.`visibility`=1 AND 

                        `catalogs`.`deleted`=0

                    ) AS natural_counted, 

                    (

                        SELECT 

                        COUNT(`catalogs`.`id`)

                        FROM 

                        `catalogs`

                        WHERE 

                        FIND_IN_SET(`pages`.`id`, `catalogs`.`regions`) AND 

                        FIND_IN_SET('108', `catalogs`.`categories`) AND 

                        `catalogs`.`menuid`=24 AND 

                        `catalogs`.`language`='".$_POST["input_lang"]."' AND 

                        `catalogs`.`visibility`=1 AND 

                        `catalogs`.`deleted`=0

                    ) AS museum_counted, 

                    `pages`.* 

                    FROM 

                    `pages` 

                    WHERE 

                    `pages`.`id`='".(int)$map_id."' AND 

                    `pages`.`menuid`=27 AND 

                    `pages`.`language`='".$_POST["input_lang"]."'";

                    $fetch = db_fetch($sql);

                    $title = (isset($fetch['title'])) ? $fetch['title'] : '';

                    

                    $sights_counted = (isset($fetch['sights_counted'])) ? $fetch['sights_counted'] : 0;

                    $wine_counted = (isset($fetch['wine_counted'])) ? $fetch['wine_counted'] : 0;

                    $natural_counted = (isset($fetch['natural_counted'])) ? $fetch['natural_counted'] : 0;

                    $museum_counted = (isset($fetch['museum_counted'])) ? $fetch['museum_counted'] : 0;

                    $description = (isset($fetch['description'])) ? $fetch['description'] : '';



                    $Html .= "<div class=\"MapInfoModal\">";

                    $Html .= "<div class=\"InfoHeader\" style=\"background:url('_website/img/modal_bg.png');\">";

                    $Html .= sprintf(

                        "<div class=\"Title\">%s</div>", 

                        $title

                    );

                    $Html .= "</div>";

                    $Html .= "<ul class=\"CatInfoButtons\">";

                    $Html .= "<li class=\"active\"><a data-toggle=\"tab\" href=\"#CategoriesLink\">Categories</a></li>";

                    $Html .= "<li><a data-toggle=\"tab\" href=\"#InformationLink\">Information</a></li>";

                    $Html .= "</ul>";



                    $Html .= "<div class=\"tab-content\">";

                    

                    $Html .= "<div id=\"CategoriesLink\" class=\"tab-pane fade in active\">";

                    $Html .= "<div class=\"MapCategoryDiv\">";

                    

                    $Html .= "<div class=\"col-sm-3\">";

                    $Html .= sprintf(

                        "<a href=\"/%s/ongoing-tours/?page=1&pri=0&cat=108&reg=%s\" class=\"Item\">",

                        $_POST["input_lang"],

                        $fetch['id']

                    );

                    $Html .= "<div class=\"MuseumIcon\"></div>";

                    $Html .= "<div class=\"Title\">Museums</div>";

                    $Html .= sprintf("<div class=\"Count\">%s</div>", $museum_counted);

                    $Html .= "</a>";

                    $Html .= "</div>";



                    $Html .= "<div class=\"col-sm-3\">";

                    $Html .= sprintf(

                        "<a href=\"/%s/ongoing-tours/?page=1&pri=0&cat=107&reg=%s\" class=\"Item\">",

                        $_POST["input_lang"],

                        $fetch['id']

                    );

                    $Html .= "<div class=\"NaturalIcon\"></div>";

                    $Html .= "<div class=\"Title\">Natural Sights</div>";

                    $Html .= sprintf("<div class=\"Count\">%s</div>", $natural_counted);

                    $Html .= "</a>";

                    $Html .= "</div>";



                    $Html .= "<div class=\"col-sm-3\">";

                    $Html .= sprintf(

                        "<a href=\"/%s/ongoing-tours/?page=1&pri=0&cat=105&reg=%s\" class=\"Item\">",

                        $_POST["input_lang"],

                        $fetch['id']

                    );

                    $Html .= "<div class=\"CulturalIcon\"></div>";

                    $Html .= "<div class=\"Title\">Cultural Sights</div>";

                    $Html .= sprintf("<div class=\"Count\">%s</div>", $sights_counted);

                    $Html .= "</a>";

                    $Html .= "</div>";



                    $Html .= "<div class=\"col-sm-3\">";

                    $Html .= sprintf(

                        "<a href=\"/%s/ongoing-tours/?page=1&pri=0&cat=106&reg=%s\" class=\"Item\">",

                        $_POST["input_lang"],

                        $fetch['id']

                    );

                    $Html .= "<div class=\"WineToursIcon\"></div>";

                    $Html .= "<div class=\"Title\">Wine Tours</div>";

                    $Html .= sprintf("<div class=\"Count\">%s</div>", $wine_counted);

                    $Html .= "</a>";

                    $Html .= "</div>";

                    $Html .= "</div>";



                    $Html .= "</div>";



                    $Html .= "<div id=\"InformationLink\" class=\"tab-pane fade\">";

                    $Html .= "<div class=\"MapInformationDiv\">";

                    $Html .= "<div class=\"Description\">";

                    $Html .= strip_tags($description, "<p><br><strong><a>");



                    $Html .= "</div>";



                    $Html .= "<div class=\"row\">";

                    $Html .= "<div class=\"InformationList\">";

                    

                    $files = db_fetch_all("SELECT * FROM " . c("table.attached") . " WHERE `page` = {$fetch['id']} AND `language`='".l()."' ORDER BY `position` ASC;");

                    // $Html .= print_r($files, true); 



                    foreach($files as $file):

                        if(isset($file['file']) && !empty($file['file'])):

                        $Html .= "<div class=\"col-sm-4\">";

                        $Html .= "<a href=\"#\" class=\"Item\">";

                        $Html .= "<div class=\"Image\">";

                        $Html .= sprintf(

                            "<div class=\"Background\" style=\"background:url('%s');\"></div>",

                            $file['file']

                        );

                        $Html .= "</div>";

                        $Html .= sprintf("<div class=\"Title\">%s</div>", $file['title']);

                        $Html .= "</a>";

                        $Html .= "</div>";

                        endif;

                    endforeach;



                    $Html .= "</div>";

                    $Html .= "</div>";

                    $Html .= "</div>";



                    $Html .= "</div>";

                    $Html .= "</div>";

                    $Html .= "</div>";





                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Html"=>$Html,

                        "Details"=>""

                    )

                );

                break;

            case 'addTripPlanToCart':

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["places"]) || 

                    empty($_POST["startDatePicker"]) || 

                    empty($_POST["endDatePicker"]) || 

                    empty($_POST["guests"]) || 

                    empty($_POST["price"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    $successText = "";                

                    $countCartitem = 0;                

                }else{

                    if(isset($_SESSION["trip_user"])){

                        $userid = $_SESSION["trip_user"];

                    }else{

                        if(isset($_SESSION["cartsession"]))

                        {

                            $userid = $_SESSION["cartsession"];

                        }else{

                            $_SESSION["cartsession"] = g_random(15);

                            $userid = $_SESSION["cartsession"];

                        }

                    }



                    $totalprice = (int)$_POST["price"];



                    $insert = "INSERT INTO `cart` SET `date`='{time()}', `startdate`='{$_POST["startDatePicker"]}', `startdate2`='{$_POST["endDatePicker"]}', `guests`='{$_POST["guests"]}', `pid`='0', `userid`='{$userid}', `sold`=0, `quantity`=0, `type`='plantrip', `totalprice`='{$totalprice}', `tourplaces`='{$_POST['places']}', `website`='beetrip'";

                    db_query($insert);

                   

                    $countCartitem = g_cart_count($userid);



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }



                $out = array(

                    "Error" => array( 

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>"",

                        "countCartitem"=>$countCartitem

                    )

                );

                break;

            case 'removeCartItem':

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["id"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    $successText = "";                

                    $countCartitem = 0;                

                }else{

                    if(isset($_SESSION["beetrip_user"])){

                        $userid = $_SESSION["beetrip_user"];

                    }else{

                        if(isset($_SESSION["cartsession"]))

                        {

                            $userid = $_SESSION["cartsession"];

                        }else{

                            $userid = 0;

                        }

                    }

                    $ids = explode(",", $_POST["id"]);

                    db_query("DELETE FROM `cart` WHERE `id` IN (".implode(",",  $ids).") AND `userid`='".$userid."'"); 

                    

                    $countCartitem = g_cart_count($userid);



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array( 

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>"",

                        "countCartitem"=>$countCartitem

                    )

                );

            break;
            case 'updateCart':
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["id"]) || 
                    empty($_POST["guestNuber"]) ||  
                    empty($_POST["token"])  
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");
                    $successText = "";
                    $updateType = "";
                    $countCartitem = 0;
                }else{
                    $children = (isset($_POST["children"])) ? $_POST['children'] : 0;
                    if(isset($_SESSION["beetrip_user"])){
                        $userid = $_SESSION["beetrip_user"];
                    }else{
                        if(isset($_SESSION["cartsession"]))
                        {
                            $userid = $_SESSION["cartsession"];
                        }else{
                            $_SESSION["cartsession"] = g_random(15);
                            $userid = $_SESSION["cartsession"];
                        }
                    }

                    $g_insuarance_damzgvevi = (isset($_POST["g_insuarance_damzgvevi"])) ? $_POST["g_insuarance_damzgvevi"] : ' ';
                    $g_insuarance_dazgveuli = (isset($_POST["g_insuarance_dazgveuli"])) ? $_POST["g_insuarance_dazgveuli"] : ' ';
                    $g_insuarance_misamarti = (isset($_POST["g_insuarance_misamarti"])) ? $_POST["g_insuarance_misamarti"] : ' ';
                    $g_insuarance_dabtarigi = (isset($_POST["g_insuarance_dabtarigi"])) ? $_POST["g_insuarance_dabtarigi"] : ' ';
                    $g_insuarance_pasporti = (isset($_POST["g_insuarance_pasporti"])) ? $_POST["g_insuarance_pasporti"] : ' ';
                    $g_insuarance_piradinomeri = (isset($_POST["g_insuarance_piradinomeri"])) ? $_POST["g_insuarance_piradinomeri"] : ' ';
                    $g_insuarance_telefonis = (isset($_POST["g_insuarance_telefonis"])) ? $_POST["g_insuarance_telefonis"] : ' ';

                    
                    $selectProduct = "SELECT * FROM `catalogs` WHERE `id`='".(int)$_POST["id"]."' AND `language`='".l()."' AND `deleted`=0 AND `visibility`=1";
                    $fetchProduct = db_fetch($selectProduct);
                        
                    $totalprice = 0;
                    $crew = (int)$_POST["guestNuber"]; 
                    $totalCrew = (int)$_POST["guestNuber"] + (int)$children + (int)$_POST['childrenunder'];
                    $perprice = 0;


                    $transportP = g_transports();
                    $maxCrow = array();
                    foreach ($transportP as $v) {
                        if($v["id"]==125){//sedan
                            $maxCrow["sedan"] = $v["p_ongoing_max_crowd"];
                        }else if($v["id"]==126){//minivan
                            $maxCrow["minivan"] = $v["p_ongoing_max_crowd"];
                        }else if($v["id"]==127){//minibus
                            $maxCrow["minibus"] = $v["p_ongoing_max_crowd"];
                        }else if($v["id"]==220){//bus
                            $maxCrow["bus"] = $v["p_ongoing_max_crowd"];
                        }
                    }
                    
                    if($totalCrew<=$maxCrow["sedan"]){// sedan
                      $tour_margin = 100 - (int)$fetchProduct['tour_margin'];
                      $bep = ceil(((int)$fetchProduct["price_sedan"] / 100) * $tour_margin); 
                      if($totalCrew<=$fetchProduct["guest_sedan"]){
                        $perprice = $bep / $totalCrew;
                      }else{
                        $perprice = (int)$fetchProduct["price_sedan"] / $totalCrew;
                      }
                    }else if($totalCrew > $maxCrow["sedan"] && $totalCrew <= $maxCrow["minivan"]){
                      $perprice = (int)$fetchProduct["price_minivan"] / $totalCrew;      
                    }else if($totalCrew > $maxCrow["minivan"] && $totalCrew <= $maxCrow["minibus"]){
                      $perprice = (int)$fetchProduct["price_minibus"] / $totalCrew;      
                    }else{
                      if($totalCrew<=$maxCrow["bus"]){ 
                        $perprice = (int)$fetchProduct["price_bus"] / $totalCrew;
                      }else{
                        $howManyBus = ceil($totalCrew / $maxCrow["bus"]);
                        $bussesTotalPrice = ceil((int)$fetchProduct["price_bus"] * $howManyBus);
                        $perprice = $bussesTotalPrice / $totalCrew;
                      }
                    }

                    // $child_price = 0;

                    $cuisune_price = $crew * (int)$fetchProduct['cuisune_price1person'];
                    $ticket_price = $crew * (int)$fetchProduct['ticketsandother_price1person'];
                    $guidepricefortour = (int)$fetchProduct['guidepricefortour'];

                    $cuisune_price_child = 0;
                    $ticket_price_child = 0;
                    for($i = 0; $i < $children; $i++){
                        // $child_price += ceil($perprice / 2);
                        $cuisune_price_child += ceil((int)$fetchProduct['cuisune_price1person'] / 2);
                        $ticket_price_child += ceil((int)$fetchProduct['ticketsandother_price1person'] / 2);
                    }

                    $totalprice = number_format(($perprice * $totalCrew) + $cuisune_price + $ticket_price + $cuisune_price_child + $ticket_price_child + $guidepricefortour, 2, ".", "");
                    
                    if($fetchProduct["tour_income_margin"]){
                        $incomePrice = $totalprice * (int)$fetchProduct["tour_income_margin"] / 100;
                        $totalprice = round($totalprice + $incomePrice);
                    }

                    $childrenunder = (isset($_POST['childrenunder']) && is_numeric($_POST['childrenunder'])) ? $_POST['childrenunder'] : 0;

                    if(isset($_POST["inside"]) && $_POST["inside"]!="false"){
                        $startdate = strtotime($_POST["inside"]);
                        $startdate = date("Y-m-d", $startdate);
                    }else{
                        $startdate = date("Y-m-d", time()+172800);
                    }         

                    $insurance = (isset($_POST["insurance123"]) && $_POST["insurance123"]==1) ? '1' : 'NULL';  

                    $insert = "INSERT INTO `cart` SET 
                    `date`='".time()."', 
                    `pid`='".(int)$_POST["id"]."', 
                    `userid`='".$userid."', 
                    `guests`='".(int)$_POST["guestNuber"]."', 
                    `children`='".(int)$children."', 
                    `childrenunder`='".(int)$childrenunder."', 
                    `totalprice`='".(float)$totalprice."', 
                    `sold`=0, 
                    `quantity`=0,
                    `damzgvevi`='{$g_insuarance_damzgvevi}',
                    `dazgveuli`='{$g_insuarance_dazgveuli}', 
                    `misamarti`='{$g_insuarance_misamarti}',
                    `dabtarigi`='{$g_insuarance_dabtarigi}',
                    `pasporti`='{$g_insuarance_pasporti}',
                    `piradinomeri`='{$g_insuarance_piradinomeri}',
                    `telefonis`='{$g_insuarance_telefonis}',
                    `insurance`='{$insurance}',
                    `website`='beetrip',
                    `startdate`='".$startdate."'
                    ";
                    db_query($insert);
                    $updateType = "inserted";
                    
                   
                    $countCartitem = g_cart_count($userid);

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $successText = l("welldone");
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "updateType"=>$updateType,
                        "countCartitem"=>$countCartitem,
                        "Details"=>""
                    )
                );
                break;

            case 'loadcatalog':

                $filter = "";

                $Html = "";

                $out_couned = 0;

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["current_page"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    $successText = "";

                }else{

                    $res = g_ajax_catalog_list_load();

                    $out_couned = (isset($res[0]["counted"])) ? $res[0]["counted"] : 0;

                    if($out_couned>0){

                        foreach ($res as $item): 

                            $link = href(63, array(), l(), $item['id']);

                            $Html .= "<div class=\"col-sm-3\">";

                            $Html .= "<div class=\"Item\">";

                            $Html .= sprintf(

                                "<div class=\"TopInfo\" onclick=\"location.href='%s'\">", 

                                str_replace(array('"',"'"," "),"",$link)

                            );

                            $Html .= sprintf(

                                "<div class=\"Background\" style=\"background:url('%s');\"></div>",

                                $item['image1']

                            );

                            // $Html .= sprintf(

                            //     "<div class=\"UserCount\"><span>%s</span></div>",

                            //     $item['tourists']

                            // );

                            $Html .= "</div>";

                            $Html .= sprintf(

                                "<div class=\"BottomInfo\" onclick=\"location.href='%s'\">",

                                $link

                            );

                            $Html .= sprintf(

                                "<div class=\"Title\">%s</div>",

                                g_cut($item['title'], 40)

                            );

                            $Html .= sprintf(

                                "<div class=\"Day\">%s %s</div>",

                                $item['day_count'],

                                l("days")

                            );

                            // $Html .= sprintf(

                            //     "<div class=\"Price\">Package Price: <span>%s <i>A</i></span></div>",

                            //     $item['price']

                            // );

                            $Html .= "</div>";

                            $Html .= "<div class=\"Buttons\">";

                            $activeCart = (!empty($item['cartId'])) ? ' active' : '';

                            $Html .= sprintf(

                                "<a href=\"javascript:void(0)\" class=\"addCart%s\" data-id=\"%s\" data-title=\"%s\" data-errortext=\"%s\"><span class=\"CartIcon\"></span> %s</a>",

                                $activeCart,

                                $item['id'], 

                                l("message"),

                                l("error"),

                                l("addtocart")

                            );

                            $Html .= sprintf(

                                "<a href=\"%s\"><span class=\"WishListIcon\"></span> %s</a>",

                                $link,

                                l("more")

                            );

                            $Html .= "</div>";

                            $Html .= "</div>";

                            $Html .= "</div>";

                        

                        endforeach;

                    }

                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array(

                        "out_couned"=>$out_couned, 

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Html"=>$Html,

                        "Details"=>""

                    )

                );

                break;

            case 'loadmorecatalog':

                $filter = "";

                $Html = "";

                $out_couned = 0;

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["current_page"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    $successText = "";

                }else{

                    $res = g_ajax_catalog_list_load();

                    $out_couned = (isset($res[0]["counted"])) ? $res[0]["counted"] : 0;

                    foreach ($res as $item): 

                        $link = href(63, array(), l(), $item['id']);

                        $Html .= "<div class=\"col-sm-3\">";

                        $Html .= "<div class=\"Item\">";

                        $Html .= sprintf(

                            "<div class=\"TopInfo\" onclick=\"location.href='%s'\">", 

                            str_replace(array('"',"'"," "),"",$link)

                        );

                        $Html .= sprintf(

                            "<div class=\"Background\" style=\"background:url('%s');\"></div>",

                            $item['image1']

                        );

                        // $Html .= "<div class=\"UserCount\"><span>7</span></div>";

                        $Html .= "</div>";

                        $Html .= sprintf(

                            "<div class=\"BottomInfo\" onclick=\"location.href='%s'\">",

                            $link

                        );

                        $Html .= sprintf(

                            "<div class=\"Title\">%s</div>",

                            g_cut($item['title'], 40)

                        );

                        $Html .= sprintf(

                            "<div class=\"Day\">%s %s</div>",

                            $item['day_count'],

                            l("days")

                        );

                        // $Html .= sprintf(

                        //     "<div class=\"Price\">Package Price: <span>%s <i>A</i></span></div>",

                        //     $item['price']

                        // );

                        $Html .= "</div>";

                        $Html .= "<div class=\"Buttons\">";

                        $Html .= sprintf(

                            "<a href=\"javascript:void(0)\" class=\"addCart\" data-id=\"%s\"><span class=\"CartIcon\"></span> %s</a>",

                            $item['id'],

                            l("addtocart")

                        );

                        $Html .= sprintf(

                            "<a href=\"%s\"><span class=\"WishListIcon\"></span> %s</a>",

                            $link,

                            l("more")

                        );

                        $Html .= "</div>";

                        $Html .= "</div>";

                        $Html .= "</div>";

                    

                    endforeach;

                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array(

                        "out_couned"=>$out_couned, 

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Html"=>$Html,

                        "Details"=>""

                    )

                );

                break;

            case "logout":

                $errorCode = 0;

                $successCode = 1;

                $errorText = "";

                $successText = l("welldone");



                unset($_SESSION["beetrip_user"]);

                unset($_SESSION["beetrip_user_info"]);



                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>""

                    )

                );

                break;

            case 'logintry':

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["login"]) ||                    

                    empty($_POST["password"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    if(empty($_POST["login"]) && !isset($_POST["top"])){

                         $gErrorRedLine[] ="login-email-box";

                    }

                    

                    if(empty($_POST["password"]) && !isset($_POST["top"])){

                         $gErrorRedLine[] = "login-password-box";

                    }



                    if(empty($_POST["login"]) && isset($_POST["top"])){

                         $gErrorRedLine[] ="top-login-email-box";

                    }

                    

                    if(empty($_POST["password"]) && isset($_POST["top"])){

                         $gErrorRedLine[] = "top-login-password-box";

                    }

                    $successText = "";

                }else if(!filter_var($_POST["login"], FILTER_VALIDATE_EMAIL)){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("emailerror");

                    if(!isset($_POST["top"])){

                        $gErrorRedLine = array(

                            "login-email-box"

                        );

                    }else{

                        $gErrorRedLine = array(

                            "top-login-email-box"

                        );

                    }

                    $successText = "";

                }else if(g_user_exists($_POST["login"], $_POST["password"])){
                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $gErrorRedLine = array();
                    $successText = l("welldone");

                    $_SESSION["beetrip_user"] = $_POST["login"];
                    $_SESSION["beetrip_user_info"] = g_userinfo();

                    if(isset($_SESSION["cartsession"]))
                    {
                        $userid = $_SESSION["cartsession"];
                        $sql5 = "UPDATE `cart` SET `userid`='".$_POST["login"]."' WHERE `userid`='".$userid."'";
                        db_query($sql5);
                    }
                }else{
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("usernotexists");
                    $gErrorRedLine = array(
                        "popupbox"
                    );
                    $successText = "";
                }

                $redirect = $_SERVER['HTTP_REFERER'];
                if(!preg_match_all("/https:\/\/beetrip.ge\/\w{2}\/registration/", $redirect, $matches)){
                    $redirect = $_SERVER['HTTP_REFERER'];
                }else{
                    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . '/'.l().'/home';
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "errorFields"=>$gErrorRedLine,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "redirect"=>$redirect,
                        "Details"=>""
                    )
                );

                break;

            case 'updateprofileinfo':

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["firstname"]) || 

                    empty($_POST["lastname"]) || 

                    empty($_POST["idnumber"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");                    

                    $successText = "";

                }else if(!empty($_POST['birthdaydate']) && !preg_match_all("/\d{4}-\d{2}-\d{2}/", $_POST['birthdaydate'], $matches)){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("dateformaterror");

                    $successText = "";

                }else if(!empty($_POST['mobile']) && !preg_match_all("/\+\(\d{3}\)\s\d{3}\s\d{2}-\d{2}-\d{2}/", $_POST['mobile'], $matches)){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("mobileformaterror");

                    $successText = "";

                }else if(!empty($_POST['city']) && !preg_match_all("~^[\p{L}\p{Z}]+$~u", $_POST['city'], $matches)){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("cityillegal");

                    $successText = "";

                }else{
                    $mobile = (isset($_POST['mobile'])) ? $_POST['mobile']  : "";
                    $birthdaydate = (isset($_POST['birthdaydate'])) ? $_POST['birthdaydate']  : "";
                    $country = (isset($_POST['country'])) ? $_POST['country']  : "";
                    $city = (isset($_POST['city'])) ? $_POST['city']  : "";

                    db_query("UPDATE `site_users` SET
                        `firstname`='".$_POST['firstname']."', 
                        `lastname`='".$_POST['lastname']."', 
                        `pn`='".$_POST['idnumber']."', 
                        `mobile`='".$mobile."',
                        `birthdate`='".$birthdaydate."', 
                        `country`='".(int)$country."', 
                        `city`='".$city."'  
                        WHERE 
                        `email`='".$_SESSION["beetrip_user"]."'
                    ");

                    $sql = "SELECT * FROM `site_users` WHERE `email`='".$_SESSION["beetrip_user"]."' AND `deleted`=0";
                    $fetch = db_fetch($sql);

                    if(isset($fetch['id'])){
                        $_SESSION["beetrip_user_info"] = $fetch;
                    }



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $gErrorRedLine = array();

                    $successText = l("welldone");

                }

                

                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>""

                    )

                );

                break;

            case "contactsendmail":
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["entername"]) || 
                    empty($_POST["email"]) || 
                    empty($_POST["subject"]) || 
                    empty($_POST["message"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                    
                    $successText = "";
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("emailerror");
                    $successText = "";
                }else{                
                    $email_text = "<h2>Contact message</h2>";
                    $email_text .= "<strong>Name:</strong> <span>".$_POST["entername"]."<span><br >";

                    $email_text .= "<strong>Email:</strong> <span>".$_POST["email"]."<span><br />";

                    $email_text .= "<strong>Subject:</strong> <span>".$_POST["subject"]."<span><br />";

                    $email_text .= "<strong>Message:</strong><br />";

                    $email_text .= "<span>".$_POST["message"]."<span>";



                    g_send_email(array(
                      "sendTo"=>$c['contact.email'], 
                      "subject"=>"BeeTrip contact message", 
                      "body"=>$email_text 
                    ));

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $gErrorRedLine = array();
                    $successText = l("thankyou");
                }
                
                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case 'addInvoice':
                $errorCode = 1;
                $successCode = 0;
                $errorText = l("error");                    
                $successText = "";

                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["itemstobuy"]) || 
                    empty($_POST["company"]) || 
                    empty($_POST["address"]) || 
                    empty($_POST["id"]) || 
                    empty($_POST["vat"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                    
                    $successText = "";
                }else{
                    if(isset($_POST["notSelected"]) && !empty($_POST["notSelected"])){
                        $expl = explode(",", $_POST["notSelected"]);
                        $update = "UPDATE `cart` SET `readytopay`='notready' WHERE `id` IN (".implode(",",$expl).")";
                        db_query($update);
                    }

                    $updateStatus = "UPDATE `cart` SET `status`='invoiced' WHERE `readytopay`='ready' AND `userid`='{$_SESSION["beetrip_user"]}'";
                    db_query($updateStatus);

                       

                    $email_text = "";
                    $email_text .= sprintf("<p style=\"margin:0; padding:5px 0; font-size: 16px;\"><strong>Company:</strong> <span>%s</span></p>", $_POST["company"]);
                    $email_text .= sprintf("<p style=\"margin:0; padding:5px 0; font-size: 16px;\"><strong>Address:</strong> <span>%s</span></p>", $_POST["address"]);
                    $email_text .= sprintf("<p style=\"margin:0; padding:5px 0; font-size: 16px;\"><strong>ID Number:</strong> <span>%s</span></p>", $_POST["id"]);
                    $email_text .= sprintf("<p style=\"margin:0; padding:5px 0; font-size: 16px;\"><strong>VAT Reg:</strong> <span>%s</span></p>", $_POST["vat"]);

                    if(g_sent_order_mail("invoiced", "unpayed", "red", $_POST["itemstobuy"], $email_text))
                    {
                        $errorCode = 0;
                        $successCode = 1;
                        $errorText = "";
                        $gErrorRedLine = array();
                        $successText = l("checkyouremail");
                    }
                }

                   $out = array(
                        "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case 'registernewuser':
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["firstname"]) || 
                    empty($_POST["lastname"]) || 
                    empty($_POST["idnumber"]) || 
                    empty($_POST["birthday"]) || 
                    empty($_POST["country"]) || 
                    empty($_POST["city"]) || 
                    empty($_POST["mobilenumber"]) || 
                    empty($_POST["email"]) || 
                    empty($_POST["password"]) || 
                    empty($_POST["passwordConfirm"]) || 
                    empty($_POST["capchacode"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                    
                    $successText = "";
                }else if($_SESSION["php_captcha"]!=$_POST["capchacode"]){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("error");
                    $successText = "";
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("emailerror");
                    $successText = "";
                }else if(g_user_exists($_POST["email"])){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("userexists");
                    $successText = "";
                }else if(!is_numeric($_POST["country"])){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("error");
                    $successText = "";
                }else if(!preg_match_all("~^[\p{L}\p{Z}]+$~u", $_POST['city'], $matches)){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("cityillegal");
                    $successText = "";
                }else if(strlen($_POST["password"]) <= 4){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("passworderror");
                    $successText = "";
                }else if($_POST["password"]!==$_POST["passwordConfirm"]){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("passwordmatch");
                    $successText = "";
                }else if($_POST["termsCondi"]!="true"){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("pleaseagree");
                    $successText = "";
                }else{
                    $random_number = rand(50000,100000);
                    $insert = db_insert("site_users", array(
                        'date' => time(),
                        'firstname' => $_POST["firstname"],
                        'lastname' => $_POST["lastname"],
                        'pn' => "{$_POST["idnumber"]}",
                        'birthdate' => $_POST["country"],
                        'country' => $_POST["birthday"],
                        'city' => $_POST["city"],
                        'birthdate' => $_POST["birthday"],
                        'username' => $_POST["email"],
                        'userpass' => md5($_POST["password"]),
                        'mobile' => $_POST["mobilenumber"],
                        'email' => $_POST["email"],
                        'active' => 0,
                        'random' => $random_number,
                        'banned' => 0,
                        'deleted' => 0,
                        'regdate' => date("Y-m-d"), 
                        'website' => 'beetrip' 
                    ));
                    db_query($insert);

                    $email_text = "<img src=\"http://beetrip.ge/_website/images/logo.png\" width=\"150\" alt=\"logo\" align=\"center\" /><br><br><br>";
                    $email_text .= l("emailbeetriptext");

                    $email_text .= sprintf(
                        "<br><br><a href=\"%s%s/activate-account/?a=%s\">%s</a><br><br>", 
                        WEBSITE_BASE, 
                        l(),
                        $random_number, 
                        l("verifyaccountbeetrip") 
                    );

                    $email_text .= "The BeeTrip Team";

                    g_send_email(array(
                      "sendTo"=>$_POST["email"], 
                      "subject"=>l("emailsubject"), 
                      "body"=>$email_text 
                    ));

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $gErrorRedLine = array();
                    $successText = l("checkyouremail");
                }
                
                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "recoverStepTwo":
                 if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["password"]) || 
                    empty($_POST["confirm"]) ||
                    empty($_POST["code"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                    
                    $successText = "";
                }else if(strlen($_POST["password"]) <= 4){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("passworderror");                    
                    $successText = "";
                }else if($_POST["password"]!=$_POST["confirm"]){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("passwordmatch");                    
                    $successText = "";
                }else{
                    $select = "SELECT `id` FROM `site_users` WHERE `recover`='".$_POST['code']."'"; 
                    if(db_fetch($select)){
                        $update = "UPDATE `site_users` SET 
                            `userpass`='".md5($_POST["password"])."', 
                            `recover`='' 
                            WHERE 
                            `recover`='".$_POST['code']."' AND 
                            `deleted`=0
                        "; 
                        if(db_query($update)){
                            $errorCode = 0;
                            $successCode = 1;
                            $errorText = "";
                            $successText = l("welldone");
                        }else{
                            $errorCode = 1;
                            $successCode = 0;
                            $errorText = l("error");                    
                            $successText = "";
                        }
                    }else{
                        $errorCode = 1;
                        $successCode = 0;
                        $errorText = l("error");                    
                        $successText = "";
                    }
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "recoverStepOne":
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["email"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                    
                    $successText = "";
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("emailerror");
                    $successText = "";
                }else if(g_user_exists($_POST["email"])){
                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";
                    $successText = l("checkmailtext");

                    $random = rand(1000000,9999999);
                    $email_text = "<img src=\"https://beetrip.ge/_website/images/logo.png\" alt=\"\" width=\"200px\" style=\"display:block\" /><br /><br />Someone has requested a link to change your password, and you can do this through the link below. <br /><br /><a href='".WEBSITE_BASE.l()."/recover-password?r=".$random."'>Change my password</a><br /><br />If you did not request a new password, please ignore this email. Your password won't change until you access the link above and create a new one.<br /><br />The BeeTrip Team";

                    $update = "UPDATE `site_users` SET 
                        `recover`='".$random."'
                        WHERE 
                        `username`='".$_POST["email"]."' AND 
                        `deleted`=0
                    "; 
                    if(db_query($update)){
                        g_send_email(array(
                          "sendTo"=>$_POST["email"], 
                          "subject"=>"Password Recovery", 
                          "body"=>$email_text 
                        ));   
                    }
                }else{
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("usernotexists");
                    $successText = "";
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "editprofile":
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["firstname"]) || 
                    empty($_POST["lastname"]) || 
                    empty($_POST["idnumber"]) || 
                    empty($_POST["birthday"]) || 
                    empty($_POST["mobilenumber"]) || 
                    empty($_POST["email"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");
                    if(empty($_POST["firstname"])){
                         $gErrorRedLine[] ="profile-first-name-box";
                    }
                    if(empty($_POST["lastname"])){
                         $gErrorRedLine[] = "profile-last-name-box";

                    }
                    if(empty($_POST["idnumber"])){
                         $gErrorRedLine[] = "profile-id-number-box";
                    }
                    if(empty($_POST["birthday"])){
                         $gErrorRedLine[] = "profile-birthday-box";
                    }

                    if(empty($_POST["mobilenumber"])){
                         $gErrorRedLine[] = "profile-mobile-box";
                    }
                    if(empty($_POST["email"])){
                         $gErrorRedLine[] = "profile-email-box";
                    }
                    
                    $successText = "";
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("emailerror");
                    $gErrorRedLine = array(
                        "profile-email-box"
                    );
                    $successText = "";
                }else{
                    $username = (isset($_SESSION["trip_user"])) ? $_SESSION["trip_user"] : "";
                    $update = "UPDATE `site_users` SET 
                        `firstname`='".$_POST["firstname"]."', 
                        `lastname`='".$_POST["lastname"]."', 
                        `pn`='".$_POST["idnumber"]."', 
                        `birthdate`='".$_POST["birthday"]."', 
                        `mobile`='".$_POST["mobilenumber"]."', 
                        `email`='".$_POST["email"]."' 
                        WHERE 
                        `username`='".$username."' AND 
                        `deleted`=0
                    "; 
                    if(db_query($update)){
                        $errorCode = 0;
                        $successCode = 1;
                        $errorText = "";
                        $gErrorRedLine = array("popupbox");
                        $successText = l("welldone");
                        unset($_SESSION["trip_user_info"]); 
                        $_SESSION["trip_user_info"] = g_userinfo();
                    }                    
                }
                
                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "errorFields"=>$gErrorRedLine,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "contactus":

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["firstname"]) || 

                    empty($_POST["lastname"]) || 

                    empty($_POST["mobilenumber"]) || 

                    empty($_POST["email"]) || 

                    empty($_POST["comment"]) 

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");

                    if(empty($_POST["firstname"])){

                         $gErrorRedLine[] ="contact-firstname-box";

                    }

                    if(empty($_POST["lastname"])){

                         $gErrorRedLine[] = "contact-lastname-box";

                    }

                    if(empty($_POST["mobilenumber"])){

                         $gErrorRedLine[] = "contact-mobile-box";

                    }

                    if(empty($_POST["email"])){

                         $gErrorRedLine[] = "contact-email-box";

                    }

                    if(empty($_POST["comment"])){

                         $gErrorRedLine[] = "contact-comment-box";

                    }

                    $successText = "";

                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("emailerror");

                    $gErrorRedLine = array(

                        "contact-email-box"

                    );

                    $successText = "";

                }else{

                    $body = sprintf("<strong>%s</strong> %s<br />", l("firstname"), $_POST["firstname"]);

                    $body .= sprintf("<strong>%s</strong> %s<br />", l("lastname"), $_POST["lastname"]);

                    $body .= sprintf("<strong>%s</strong> %s<br />", l("email"), $_POST["email"]);

                    $body .= sprintf("<strong>%s</strong> %s<br />", l("mobile"), $_POST["mobilenumber"]);

                    $body .= sprintf("<strong>%s</strong> %s<br />", l("comment"), $_POST["comment"]);

                    



                    $email_text = sprintf(

                      l("registrationemailtext"), 

                      "<strong>Trip Planner</strong>",

                      $body

                    );



                    g_send_email(array(

                      "sendTo"=>$c['contact.email'], 

                      "subject"=>"Contact us", 

                      "body"=>$email_text 

                    ));



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $gErrorRedLine = array("popupbox");

                    $successText = l("welldone");

                }



                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "errorFields"=>$gErrorRedLine,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>""

                    )

                );

                break;

            case "updatepassword":

                $username = (isset($_SESSION["beetrip_user"])) ? $_SESSION["beetrip_user"] : "";

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["currentpassword"]) || 

                    empty($_POST["newpassword"]) || 

                    empty($_POST["comfirmpassword"])

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");                   

                    $successText = "";

                }else if(strlen($_POST["newpassword"]) <= 4){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("passworderror");

                    $successText = "";

                }else if($_POST["newpassword"]!==$_POST["comfirmpassword"]){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("passwordmatch");

                    $successText = "";

                }else if(!g_user_exists($username, $_POST["currentpassword"])){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("oldpasswordnotright");

                    $successText = "";

                }else{

                    

                    $update = "UPDATE `site_users` SET 

                        `userpass`='".md5($_POST["newpassword"])."'

                        WHERE 

                        `username`='".$username."' AND 

                        `deleted`=0

                    "; 

                    if(db_query($update)){

                        $errorCode = 0;

                        $successCode = 1;

                        $errorText = "";

                        $successText = l("welldone");

                    }

                }

                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Details"=>""

                    )

                );

                break;

            case "loadPlaces": 

                $html = "";

                if(

                    empty($_POST["input_lang"]) || 

                    empty($_POST["categoryList"]) || 

                    count(json_decode($_POST["categoryList"], true))<=0 || 

                    empty($_POST["regionList"])

                ){

                    $errorCode = 1;

                    $successCode = 0;

                    $errorText = l("allfields");                   

                    $successText = "";

                }else{



                    $list = json_decode($_POST["regionList"], true);

                    $regionList = "";

                    if(count($list)){

                        $regionList .= "AND (";

                        foreach ($list as $v) {

                          $regionList .= "FIND_IN_SET({$v}, `regions`) OR ";

                        }

                        $regionList = substr($regionList, 0, -4);

                        $regionList .= ")";

                    }



                    $list2 = json_decode($_POST["categoryList"], true);

                    $categoryList = "";

                    if(count($list2))

                    {

                        $categoryList .= "AND (";

                        foreach ($list2 as $v) {

                          $categoryList .= "FIND_IN_SET({$v}, `categories`) OR ";

                        }

                        $categoryList = substr($categoryList, 0, -4);

                        $categoryList .= ")";

                    }



                    $sql = "SELECT `id`, `title`, `description`, `image1`, `map_coordinates`, `regions`, `categories` FROM `catalogs` WHERE `language`='".l()."' AND `menuid`=36 AND `visibility`=1 AND `deleted`=0  AND `planner_show`=1 AND `startedplace`!=1 AND `map_coordinates`!='' {$categoryList} {$regionList} ORDER BY `position` ASC";  

                    $fetch = db_fetch_all($sql);



                    // echo $sql;

                    // exit();



                    foreach ($fetch as $v):

                    $html .= "<div class=\"CheckBoxItem col-sm-3\">";

                    $html .= sprintf(

                        "<input class=\"TripCheckbox\" type=\"checkbox\" name=\"layout\" id=\"%s\" value=\"%s\" data-map=\"%s\" data-title=\"%s\" data-categories=\"%s\" onclick=\"ColorDistance()\" />", 

                        $v["id"], 

                        $v["id"], 

                        str_replace(":",",", $v["map_coordinates"]), 

                        $v["title"],

                        $v["categories"]

                    );

                    $html .= sprintf("<label class=\"pull-left Text FontNormal\" for=\"%s\">", $v["id"]);

                    $html .= $v["title"];

                    $html .= "<div class=\"PositionRelative\">";

                    $html .= "<div class=\"ShowWindow1\">";

                    $html .= sprintf("<div class=\"Title\">%s</div>", $v["title"]);

                    // if(!empty($v["image1"]) && $v["image1"]!=""):

                    // $html .= sprintf("<div class=\"Image\"><img src=\"%s\"/></div>", $v["image1"]);

                    // endif;

                    if(!empty($v["image1"]) && $v["image1"]!=""):

                    $html .= sprintf("<div class=\"Image LoadImage\" data-image=\"%s\"></div>", $v["image1"]);

                    endif;

                    $html .= "<div class=\"Text\">";

                    $html .= strip_tags($v["description"], "<p><a><strong>");

                    $html .= "</div>";

                    $html .= "</div>";

                    $html .= "</div>";

                    $html .= "</label>";

                    $html .= "</div>";

                    endforeach;



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Regions"=>$html,

                        "Details"=>""

                    )

                );

                break;
            case "insertpickupplace":
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["cartid"])
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                   
                    $successText = "";
                }else{
                    $update = "UPDATE `cart` SET 
                        `wherepickup`='".$_POST["pick1"]."', 
                        `wherepickup2`='".$_POST["pick2"]."'
                        WHERE 
                        `id`='".$_POST["cartid"]."'
                    "; 

                    if(db_query($update)){
                        $errorCode = 0;
                        $successCode = 1;
                        $errorText = "";
                        $successText = l("welldone");
                    }
                }
                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "loadorders":
                if(
                    empty($_POST["input_lang"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("error");                   
                    $successText = "";
                }else{
                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";                   
                    $successText = l("welldone");
                }
                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;
            case "loadPlacesMobile":
                $html = "";
                if(
                    empty($_POST["input_lang"]) || 
                    empty($_POST["categoryList"]) ||
                    count(json_decode($_POST["categoryList"], true))<=0 || 
                    empty($_POST["regionList"])
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                   
                    $successText = "";
                }else{
                    $list = json_decode($_POST["regionList"], true);
                    $regionList = "";
                    if(count($list)){
                        $regionList .= "AND (";

                        foreach ($list as $v) {

                          $regionList .= "FIND_IN_SET({$v}, `regions`) OR ";

                        }

                        $regionList = substr($regionList, 0, -4);

                        $regionList .= ")";

                    }



                    $list2 = json_decode($_POST["categoryList"], true);

                    $categoryList = "";

                    if(count($list2))

                    {

                        $categoryList .= "AND (";

                        foreach ($list2 as $v) {

                          $categoryList .= "FIND_IN_SET({$v}, `categories`) OR ";

                        }

                        $categoryList = substr($categoryList, 0, -4);

                        $categoryList .= ")";

                    }



                    $sql = "SELECT `id`, `title`, `description`, `image1`, `map_coordinates`, `regions`, `categories` FROM `catalogs` WHERE `language`='".l()."' AND `menuid`=36 AND `visibility`=1 AND `deleted`=0  AND `planner_show`=1 AND `startedplace`!=1 AND `map_coordinates`!='' {$categoryList} {$regionList} ORDER BY `position` ASC";  

                    $fetch = db_fetch_all($sql);



                    foreach ($fetch as $item):

                    $html .= "<div class=\"Item\">";

                    $html .= sprintf(

                        "<input class=\"TripCheckbox\" type=\"checkbox\" id=\"Chek%d\" data-map=\"%s\" data-categories=\"%s\" data-title=\"%s\" />",

                        $item['id'],

                        $item['map_coordinates'],

                        $item['categories'],

                        htmlentities($item['title'])

                    );

                    $html .= sprintf(

                        "<label class=\"pull-left Text FontNormal\" for=\"Chek%d\">", 

                        $item['id']

                    );

                    $html .= sprintf(

                        "<img src=\"%s\" alt=\"\" />",

                        $item['image1']

                    );

                    $html .= "<div class=\"Info\">";

                    $html .= sprintf(

                        "<div class=\"Title\">%s</div>",

                        $item['title']

                    );

                    $html .= sprintf(

                        "<div class=\"Text\">%s</div>",

                        g_cut($item['description'], 120)

                    );

                    $html .= "</div>";

                    $html .= "</label>";

                    $html .= "</div>";

                    endforeach;



                    $errorCode = 0;

                    $successCode = 1;

                    $errorText = "";

                    $successText = l("welldone");

                }

                $out = array(

                    "Error" => array(

                        "Code"=>$errorCode, 

                        "Text"=>$errorText,

                        "Details"=>""

                    ),

                    "Success"=>array(

                        "Code"=>$successCode, 

                        "Text"=>$successText,

                        "Regions"=>$html,

                        "Details"=>""

                    )

                );

                break;
            case "currencyChange":
                $html = "";
                if(
                    empty($_POST["cur"]) || 
                    empty($_POST["input_lang"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                   
                    $successText = "";
                }else{
                    $_SESSION["currency_123"] = $_POST["cur"];

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";                   
                    $successText = l("welldone");
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Regions"=>$html,
                        "Details"=>""
                    )
                );                
                break;
            case "changeSiteRules":
                if(
                    empty($_POST["siterules"]) || 
                    empty($_POST["input_lang"]) 
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                   
                    $successText = "";
                }else{
                    $_SESSION["siterules"] = $_POST["siterules"];

                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";                   
                    $successText = l("welldone");
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Regions"=>"",
                        "Details"=>""
                    )
                );
                break;
            case "cartItemNotReady":
                if(
                    empty($_POST["input_lang"])
                ){
                    $errorCode = 1;
                    $successCode = 0;
                    $errorText = l("allfields");                   
                    $successText = "";
                }else{
                    if(!empty($_POST["notready"])){
                        $expl = explode(",", $_POST["notready"]);
                        $update = "UPDATE `cart` SET `readytopay`='notready' WHERE `id` IN (".implode(",",$expl).")";
                        db_query($update);
                    }

                    
                    $errorCode = 0;
                    $successCode = 1;
                    $errorText = "";                   
                    $successText = l("welldone");

                    
                }

                $out = array(
                    "Error" => array(
                        "Code"=>$errorCode, 
                        "Text"=>$errorText,
                        "Details"=>""
                    ),
                    "Success"=>array(
                        "Code"=>$successCode, 
                        "Text"=>$successText,
                        "Details"=>""
                    )
                );
                break;

            default:

                # code...

                break;

        }





    }



    echo json_encode($out);

    exit();

?>