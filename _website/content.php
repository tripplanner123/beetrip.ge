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

    if(isset($_GET['logout'])){
        unset($_SESSION["beetrip_user"]);
        header("Location: /".l());
        exit();
    }

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    
    <base href="<?php echo href(); ?>" />
    <title><?php echo 'Beetrip - '.$section["title"]; ?></title>
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
    <link href="_website/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
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
    <link href="_website/styles/css/style-en.css?time=<?=time()?>" rel="stylesheet" />

<?php if(l()=='ge'){ ?>
    <link href="_website/styles/css/style-ge.css?time=<?=time()?>" rel="stylesheet" />
<?php } else if(l()=='ru') { ?>
    <link href="_website/styles/css/style-ru.css" rel="stylesheet" />
<?php } ?>

    <!--Plugins-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="_website/plugins/swiper-4.1.6/js/swiper.min.js"></script>
    <script src="_website/js/bootstrap-datepicker.min.js"></script>
    <script src="_website/js/g-script.js?time=<?=time()?>"></script>
</head>
<body class="site">
	<div class="side-bar-overlay"></div>
    <div class="side-bar">
        <a href="#" class="side-bar__close">
            <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" viewBox="0 0 20.17 20.17">
                <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"/>
            </svg>
        </a>
    </div>
    <!-- side-bar -->

<!-- Message Modal start -->
<div id="g-message-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center"><?=l("message")?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                        <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <p><?=l("beetripdeletecartitem")?></p>
            </div>

            <div class="modal-footer  flex-column">
                <div id="g-message-modal-footer">
                    <button type="button" class="button button--small button--yellow w-100 text-uppercase gremoveButton"><?=l("delete")?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Message Modal end -->


    	<?php 
    	if(!isset($_SESSION["beetrip_user"])){ 
    		require_once('_plugins/php-graph-sdk-5.x/src/Facebook/autoload.php'); 
			$fb = new Facebook\Facebook([
				'app_id' => '202840937188596', // Replace {app-id} with your app id
				'app_secret' => 'd4823824542c5b7ef24896eb5a39c354',
				'default_graph_version' => 'v2.2',
			]);

			$helper = $fb->getRedirectLoginHelper();

			$permissions = ['email']; // Optional permissions
			$loginUrl = $helper->getLoginUrl(WEBSITE_BASE.l().'/?ajax=true&fb-callback=true', $permissions);
    	?>
	        

            <div id="auth-modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center"><?=l("singin")?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                                    <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 0 30px;">
                            <div class="facebookLogin g-facebook-login" data-url="<?=$loginUrl?>">
                                <span><?=l("continuewithfacebook")?></span> 
                            </div>

                            <div class="alert alert-warning g-message-top-login" style="background-color:#f7f7f7; display: none;"></div>

                            <div class="form-group">
                                <label class="w-100 form-label">
                                    <span class="form-label-text form-label-text--gray d-inline-block" style="color:#000000"><?=l("login")?></span>
                                    <input 
                                        type="email" 
                                            class="form-control top-login-email" 
                                                value=""
                                                    name="top-login-email" />
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="w-100 form-label">
                                    <span class="form-label-text form-label-text--gray d-inline-block" style="color:#000000"><?=l("password")?></span>
                                    <a href="javascript:void(0)" onclick="$('#auth-modal').modal('hide'); $('#password-recover-modal').modal('show')" style="float:right; color:#b9b9b9; text-decoration: underline;" class="form-label-text form-label-text--gray d-inline-block"><?=l("forgetyourpassword")?></a>
                                    <input 
                                        type="password" 
                                            class="form-control top-login-password" 
                                                value=""
                                                    name="top-login-password" />
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer" style="display: block;">
                            <div class="form-group" style="width: 100%;">
                                <button type="submit" class="button button--small button--yellow w-100 text-uppercase toploginButtonTri new-v-button-sign-in"><?=l("singin")?></button>
                            </div>
                            <div style="clear:both;"></div>
                            <div class="form-group" style="width: 100%; text-align: center;">
                                <label class="w-100 form-label">
                                    <span class="form-label-text form-label-text--gray d-inline-block"><?=l("newtobeetrip")?></span>
                                </label>

                                <button type="button" onclick="location.href='/<?=l()?>/registration'" class="button button--small button--yellow w-100 text-uppercase new-v-button-registration"><?=l("registration")?></button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="password-recover-modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="?">
                        <div class="modal-header">
                            <h5 class="modal-title w-100 text-center"><?=menu_title(70)?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                                    <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"/>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning g-message-top-recover-password" style="background-color:#f7f7f7; display: none;"></div>
                            <label class="w-100 form-label">
                                <span class="form-label-text form-label-text--gray d-inline-block"><?=l("enteremailtosearchyour")?></span>
                                <input type="email" class="form-control form-control--icon g-recover-email" value="" />
                            </label>
                        </div>
                        <div class="modal-footer flex-column align-items-start pt-0">
                            <button type="button" class="button button--small button--yellow text-uppercase g-recover-password-button new-v-button-recover" data-gErrorMessageHeader="<?=l('checkyouremail')?>"><?=l("recoverpasswordx")?></button>
                            
                            <a href="javascript:void(0)" onclick="$('#password-recover-modal').modal('hide'); $('#auth-modal').modal('show');" class="return-to-sign-in text-yellow emphasized-link"><?=l("returnsignin")?></a>

                        </div>
                    </form>
                </div>
            </div>
            </div>
        <!-- modals -->
        <?php } ?>
        <!-- modals -->

        <header class="site__header">
            <div class="header header--transparent">
                <div class="container-fluid">
                    <div class="row header__content d-flex align-items-center">
                        <div class="col-4 d-lg-none">
                            <a href="#" class="side-bar-toggle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="16px" viewBox="273 52 22 16">
                                    <rect width="22" height="2" rx="1" transform="translate(273 52)"></rect>
                                    <rect width="22" height="2" rx="1" transform="translate(273 59)"></rect>
                                    <rect width="22" height="2" rx="1" transform="translate(273 66)"></rect>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="col-4 col-lg-8 d-flex align-items-center justify-content-center justify-content-lg-start">
                            <h1 class="logo">
                                <a href="<?=href(1)?>" title="<?=menu_title(1)?>">
                                    <img src="_website/images/logo.svg" width="80" height="30" alt="">
                                    <span class="d-none">beetrip</span>
                                </a>
                            </h1>
                            <nav class="menu menu--header">
                                <ul class="menu__list">
                                    <li class="menu__list-item">
                                        <a href="<?=href(62)?>" class="menu__link g-transfer"><?=menu_title(62)?></a>
                                    </li>

                                    <li class="menu__list-item">
                                        <a href="https://beetrip.ge/<?=l()?>/ongoing-tours"  class="menu__link g-ongoing-tourx"><?=menu_title(63)?></a>
                                    </li>
                                    <li class="menu__list-item">
                                        <a href="https://tripplanner.ge/<?=l()?>/plan-your-trip" target="_blank" class="menu__link" target="_blank"><?=menu_title(61)?></a>
                                    </li>
                                </ul>
                                <ul class="menu__list showonmobile">
                                    <?php if(!isset($_SESSION["beetrip_user"])): ?>
                                    <li class="menu__list-item">
                                        <a href="#" class="menu__link" data-toggle="modal" data-target="#auth-modal" style="min-width: 95px;"><?=l("profile")?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(isset($_SESSION["beetrip_user"])): ?>
                                    <li class="menu__list-item">
                                        <a href="<?=href(68)?>" class="menu__link g-profile"><?=g_cut($_SESSION["beetrip_user_info"]["firstname"],10)?></a>
                                    </li>
                                    <li class="menu__list-item">
                                        <a href="?logout" class="menu__link" style="height: 63px"><?=l("logout")?></a>
                                    </li>
                                    <?php endif; ?>

                                    <li class="menu__list-item">
                                        <a href="<?=href(65)?>" class="menu__link g-cart"><?=menu_title(65)?> <span id="g-top-cart-count"> (<?=(int)count(g_cart())?>)</span></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <div class="col-4 col-lg-4 d-flex justify-content-end">
                            <nav class="memu menu--header">
                                <ul class="menu__list">
                                    <?php if(!isset($_SESSION["beetrip_user"])): ?>
                                    <li class="menu__list-item">
                                        <a href="#" class="menu__link" data-toggle="modal" data-target="#auth-modal" style="min-width: 95px;"><?=l("login")?></a>
                                    </li>
                                    <?php endif; ?>

                                    <?php if(isset($_SESSION["beetrip_user"])): ?>
                                    <li class="menu__list-item">
                                        <a href="<?=href(68)?>" class="menu__link g-profile"><?=g_cut($_SESSION["beetrip_user_info"]["firstname"],10)?></a>
                                    </li>
                                    <?php endif; ?>

                                    <li class="menu__list-item">
                                        <a href="<?=href(65)?>" class="menu__link g-cart"><?=menu_title(65)?> <span id="g-top-cart-count"> (<?=(int)count(g_cart())?>)</span></a>
                                    </li>
                                </ul>
                            </nav>

                            <ul class="dropdown-list lang">
                                    <li class="dropdown-list__item">
                                        <a href="javascript:void(0)" class="dropdown-list__link" style="margin-top: 17px; padding-left: 10px; padding-right: 10px;">
                                            <?=l()?>
                                            <i class="fa fa-angle-down dropdown-list__icon"></i>
                                        </a>
                                        <ul class="dropdown-list__sub">
                                            <input type="hidden" name="input_lang" id="input_lang" value="<?=l()?>" />
    										<?php 
                                                if(l()=='en'){
                                                    $u1 = href($storage->section['id'], array(), 'ge', $product).$url;
                                                    $u2 = href($storage->section['id'], array(), 'ru', $product).$url;
                                            ?>            
    										<li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u1);?>" class="dropdown-list__link">ge</a>
                                            </li>
                                            <li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u2);?>" class="dropdown-list__link">ru</a>
                                            </li>
    										<?php } else if(l()=='ru'){
                                                $u1 = href($storage->section['id'], array(), 'ge', $product).$url;
                                                $u2 = href($storage->section['id'], array(), 'en', $product).$url;
                                            ?> 
    										<li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u1);?>" class="dropdown-list__link">ge</a>
                                            </li>
                                            <li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u2);?>" class="dropdown-list__link">en</a>
                                            </li>
    										<?php } else {
                                                $u1 = href($storage->section['id'], array(), 'en', $product).$url;
                                                $u2 = href($storage->section['id'], array(), 'ru', $product).$url;
                                            ?> 
    										<li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u1);?>" class="dropdown-list__link">en</a>
                                            </li>
                                            <li class="dropdown-list__item">
                                                <a href="<?php echo htmlentities($u2);?>" class="dropdown-list__link">ru</a> 
                                            </li>                             
    										<?php } ?>	
                                        </ul>
                                    </li>
                            </ul>
                            <?=currency()?>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header -->

<?php echo html_decode($storage->content); ?>


		<footer class="site__footer">
            <div class="footer">
                <div class="container">
                    <div class="row flex-column flex-lg-row">
                        <div class="col-lg-4 footer__col d-flex justify-content-center">
                            <ul class="footer__list">
                                <li class="footer__list-title footer__list-items-toggle">
                                    <?=l("company")?>
                                </li>

                                <li class="footer__list-item">
                                    <a href="/<?=l()?>/about" class="footer__list-link"><?=menu_title(158)?></a>
                                </li>

                                <li class="footer__list-item">
                                    <a href="/<?=l()?>/favourite-asked-questions" class="footer__list-link"><?=menu_title(130)?></a>
                                </li>
                                <li class="footer__list-item">
                                    <a href="/<?=l()?>/terms-conditions2" class="footer__list-link"><?=menu_title(131)?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 footer__col d-flex justify-content-center">
                            <ul class="footer__list">
                                <li class="footer__list-title footer__list-items-toggle">
                                    <?=l("discover")?>
                                </li>

                                <li class="footer__list-item">
                                    <a href="https://tripplanner.ge/<?=l()?>/plan-your-trip" target="_blank" class="footer__list-link" target="_blank"><?=l("tripplanner")?></a>
                                </li>

                                <li class="footer__list-item">
                                    <a href="/<?=l()?>/transfers" target="_blank" class="footer__list-link" target="_blank"><?=menu_title(62)?></a>
                                </li>

                                <li class="footer__list-item">
                                    <a href="https://beetrip.ge/<?=l()?>/ongoing-tours" class="footer__list-link"><?=menu_title(63)?></a>
                                </li>
                                
                                
                            </ul>
                        </div>
                        <div class="col-lg-4 footer__col d-flex justify-content-center">
                            <ul class="footer__list">
                                <li class="footer__list-title footer__list-items-toggle footer__list-items-toggle--active">
                                    <?=menu_title(129)?>
                                </li>
                                <li class="footer__list-item footer__list-item--show-before-lg">
                                    <a href="/<?=l()?>/feedback" class="footer__list-link">
                                        <span class="align-middle">
                                            <?=menu_title(129)?>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="copyright text-center">© <?=s("beetripcopyright")?></div>
                </div>
            </div>
        </footer>
        <!-- footer -->

    

    </body>
</html>