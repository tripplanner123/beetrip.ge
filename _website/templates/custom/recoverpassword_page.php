<?php defined('DIR') OR exit();
    if (empty($storage->product)) {
        $section = $storage->section;
    } else {
        $section = $storage->product;
    }
    $section['pid'] = $storage->product['id'];
    $section['id'] = $storage->section['id'];
    empty($section["meta_keys"]) AND $section["meta_keys"] = s('keywords');
    empty($section["meta_desc"]) AND $section["meta_desc"] = s('description');
?>
<?php
    $url="";
    $urlparts=array();
    foreach($_GET as $k=>$v) {
        if($k!='product')
          $urlparts[]=$k."=".$v;
    }
    if(count($urlparts)>0)
        $url='?'.implode("&",$urlparts);
    $product=NULL;
    if(isset($_GET["product"])) 
        $product=$_GET["product"];

    $photo = "";
    $desc = "";
    $producttitle = "";
    $prod = 0;
    if(isset($_GET["product"])) {
        $prod = $_GET["product"];
        $cat = db_fetch("select * from catalogs where id = '".$_GET["product"]."' and language = '".l()."'");
        $photo = $cat["photo1"];
        $producttitle = $cat["title"];
        $desc = $cat["description"];
        if($desc=="") $desc = $producttitle;
    }
    if($photo=="") $photo = href().WEBSITE."/images/logo.png";
    $pageid = href($storage->section['id']).(($prod>0) ? "?product=".$_GET["product"]:"");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <base href="<?php echo href(); ?>" />
    <title><?php echo 'Beetrip - '.l("recover"); ?></title>
    <meta name="keywords" content="<?php echo s('keywords').', '.$section["meta_keys"] ?>" />
    <meta name="description" content="<?php echo s('description').', '.$section["meta_desc"] ?>" />
    <meta name="robots" content="index, follow" />
    
    <meta property="og:title" content="<?php echo strip_tags($section["title"]).' - Beetrip';?>" />
    <meta property="og:image" content="<?php echo (!empty($section["image1"])) ? $section["image1"] : href().WEBSITE."/_website/img/logo.png";?>" />
    <meta property="og:description" content="<?php echo $section["meta_desc"] ?>"/>
    <meta property="og:url" content="<?php echo href($storage->section['id'], array(), '', $section["pid"]);?>" />
    <meta property="og:site_name" content="Beetrip" />
    <meta property="og:type" content="Website" />

    <link rel="icon" href="_website/images/fav.png" type="image/png" sizes="16x16">

    <!--Plugins-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />
    <link href="_website/plugins/animatecss/animate.css" rel="stylesheet" />
    <link href="_website/plugins/swiper-4.1.6/css/swiper.min.css" rel="stylesheet" />
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet" />
    <link href="_website/styles/css/bootstrap-datepicker.min.css" rel="stylesheet" />
    <!--Transfer Css-->  
    <link href="_website/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet">
    <link href="_website/plugins/jquery-ui-1.12.1.custom/addons/timepicker/css/jquery-ui-timepicker-addon.css" rel="stylesheet">  
    <!--Custom Css-->    
    <link href="_website/styles/css/style-en.css" rel="stylesheet" />

<?php if(l()=='ge'){ ?>

<?php } else if(l()=='ru') { ?>

<?php } ?>

    <!--Plugins-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="_website/plugins/swiper-4.1.6/js/swiper.min.js"></script>
    <script src="_website/js/bootstrap-datepicker.min.js"></script>
    <script src="_website/js/g-script.js"></script>
</head>
    <body class="site bg-gray justify-content-lg-center">

        <div class="reset-password">
            <div class="text-holder text-holder--reset-password-info">
                <p style="color: #4E5665;"><?=l("recover")?></p>
                <br>
                <p style="color: #4E5665;"><?=l("youhavereqnewpass")?></p>
                <br>
               <!-- <p style="color: #4E5665;">K*****@g****.com</p>  -->
            </div>
            <form action="?">
                <input type="hidden" id="input_lang" name="input_lang" value="<?=l()?>" />
                <input type="hidden" id="code" name="code" value="<?=isset($_GET['r']) ? $_GET['r'] : 1?>" />
                <div class="alert alert-warning g-message-recover-page-password" style="background-color:#f7f7f7; display: none;"></div>
                <div class="form-group">
                    <input type="password" class="form-control form-control--reset-password g-recover-page-password" placeholder="<?=l('newpassword')?>"> 
                    <!-- has-error -->
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control--reset-password g-recover-page-password-confirm" placeholder="<?=l('passwordconfirm')?>">
                </div>
                
                <!--<div class="error-title">
                    <svg class="error-title__icon align-middle" xmlns="http://www.w3.org/2000/svg" width="16px" height="20px" viewBox="-1733.5 196.5 12 16">
                        <path fill="#FFCB24" d="M6,16A15.594,15.594,0,0,1,.406,14.97.652.652,0,0,1,0,14.391V8.251a.648.648,0,0,1,.408-.579c.19-.07.4-.143.67-.229a.128.128,0,0,0,.07-.092V4.679A4.773,4.773,0,0,1,6,0a4.773,4.773,0,0,1,4.852,4.679V7.351a.127.127,0,0,0,.069.092c.248.079.461.152.67.229A.648.648,0,0,1,12,8.251v6.14a.652.652,0,0,1-.405.579A15.594,15.594,0,0,1,6,16ZM6,8.847a1.3,1.3,0,0,0-1.322,1.274A1.249,1.249,0,0,0,5.339,11.2v2.107a.661.661,0,0,0,1.322,0V11.2a1.246,1.246,0,0,0,.661-1.079A1.3,1.3,0,0,0,6,8.847ZM6,6.658a15.681,15.681,0,0,1,3.183.327V4.679A3.132,3.132,0,0,0,6,1.609a3.132,3.132,0,0,0-3.184,3.07V6.985A15.715,15.715,0,0,1,6,6.658Z" transform="translate(-1733.5 196.5)"/>
                    </svg>
                    <span class="align-middle"><?=l('yourpasswordneeds')?>:</span>
                </div>
                <ul class="error-list">
                     <li class="error-list__item"><?=l("eightcharacter")?></li>
                    <li class="error-list__item"><?=l("oneuppercaseletter")?></li>
                    <li class="error-list__item"><?=l("passandusermustdiffer")?></li> 
                </ul> -->

                <button type="button" class="button button--yellow button--reset-password g-recover-pass-final-button"><?=l('recover')?></button>
            </form>
        </div>
    </body>
</html>
