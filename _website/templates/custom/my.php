<?php 
defined('DIR') OR exit; 
if(!isset($_SESSION["beetrip_user"]) || empty($_SESSION["beetrip_user"])){
	$relpath = sprintf("/%s/registration", l());
	echo '<meta http-equiv="refresh" content="0; url='.$relpath.'" />';
	exit();
}

if(isset($_FILES["profile-photo"])){
    g_changeprofilephoto();
}
?>

<div id="cart-orders-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="?" class="change-password-form">
                <div class="modal-header flex-column align-items-center">
                    <img src="_website/images/logo.svg" width="100" height="50" alt="" class="change-password-form__icon">
                    <h4 class="change-password-form__title"><?=l("orders")?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                            <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    test
                </div>
            </form>
        </div>
    </div>
</div>

<div id="change-password-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="?" class="change-password-form">
                <div class="modal-header flex-column align-items-center">
                    <img src="_website/images/logo.svg" width="100" height="50" alt="" class="change-password-form__icon">
                    <h4 class="change-password-form__title"><?=l("updatepassword")?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                            <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                     <div class="alert alert-warning g-message-updateprofilepass" style="background-color:#f7f7f7; display: none;"></div>
                    <div class="form-group g-visiablePassUpdate">
                        <input type="password" class="form-control change-password-form__control g-profile-password-update" placeholder="<?=l('currentpasswordprofile')?>">
                    </div>
                    <div class="form-group g-visiablePassUpdate">
                        <input type="password" class="form-control change-password-form__control g-profile-newpassword-update" placeholder="<?=l('newpassword')?>">
                    </div>
                    <div class="form-group g-visiablePassUpdate">
                        <input type="password" class="form-control change-password-form__control g-profile-passwordconfirm-update" placeholder="<?=l('passwordconfirm')?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-center pt-0 g-visiablePassUpdate">
                    <button type="button" class="button button--yellow button--small text-uppercase g-profile-button-update"><?=l("update")?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modals -->

<main class="site__content">
            <div class="content">
                <div class="page-header bg-white">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                <h2 class="page-title d-flex align-items-center justify-content-center justify-content-lg-start">
                                    <?=l("profile")?>
                                    <a href="/<?=l()?>/profile?edit" class="profile-edit d-inline-block"></a>
                                </h2>
                                <h2 class="page-title d-flex align-items-center justify-content-center justify-content-lg-start" style="font-size: 16px; margin-top: 15px;">
                                    <a href="/<?=l()?>/home?logout" class="d-inline-block"><?=l("logout")?></a>
                                </h2>
                            </div>
                            <!-- <div class="col-lg-4">
                                <div class="row align-items-center quick-links quick-links--profile">
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="https://tripplanner.ge/<?=l()?>/ongoing-tours/?page=1&pri=0&cat=&reg=" class="quick-links__item d-inline-block" target="_blank">
                                            <span class="quick-links__icon quick-links__icon--1 d-inline-block"></span>
                                            <h2 class="quick-links__title"><?=menu_title(63)?></h2>
                                        </a>
                                    </div>
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="/<?=l()?>/transfers" class="quick-links__item d-inline-block">
                                            <span class="quick-links__icon quick-links__icon--2 d-inline-block"></span>
                                            <h2 class="quick-links__title"><?=menu_title(62)?></h2>
                                        </a>
                                    </div>
                                    <div class="col-4 quick-links__col text-center">
                                        <a href="https://tripplanner.ge/<?=l()?>/plan-your-trip" class="quick-links__item d-inline-block" target="_blank">
                                            <span class="quick-links__icon quick-links__icon--3 d-inline-block"></span>
                                            <h2 class="quick-links__title"><?=l('tripplanner')?></h2>
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="page-content">
                    <div class="container">
                        <div class="profile-header">
                            <div class="row align-items-lg-center">
                                <div class="offset-lg-4 col-lg-4">
                                    <?php 
                                    $profile_pic = "_website/uploads/images/profile-photo-1.png";
                                    if(
                                        isset($_SESSION['beetrip_user_info']["picture"]) && 
                                        !empty($_SESSION['beetrip_user_info']["picture"]) 
                                    ){
                                        $profile_pic = $_SESSION['beetrip_user_info']["picture"];
                                    }
                                    ?>

                                    <div class="profile-photo profile-image-tag" style="background-image: url('<?=$profile_pic?>'); background-size: cover; width: 150px; height: 140px; background-repeat: no-repeat; background-position: center center; position: relative;">
                                        
                                    </div>

                                    <form action="/<?=l()?>/profile" method="post" enctype="multipart/form-data" style="position: absolute; visibility: hidden;">
                                            <input type="file" name="profile-photo" id="profile-image" value="" />
                                            <input type="submit" name="submit" id="profileimageform" value="" />
                                    </form>
                                </div>
                                <div class="col-lg-4 text-center text-lg-left">
                                    <a href="#" class="change-password d-inline-block" data-toggle="modal" data-target="#change-password-modal">
                                        <span class="d-inline-block align-middle"><?=l("updatepassword")?></span>
                                        <span class="change-password__icon d-inline-block align-middle"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET["edit"])): ?>
                            <form action="javascript:void(0)" method="post">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-warning g-message-updateprofileinfo" style="background-color:#f7f7f7; display: none;"></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("entername")?></span>
                                                <input type="text" class="form-control g-profile-firstname-update" value="<?=$_SESSION['beetrip_user_info']["firstname"]?>" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("lastname")?></span>
                                                <input type="text" class="form-control g-profile-lastname-update" value="<?=$_SESSION['beetrip_user_info']["lastname"]?>" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("idnumber")?></span>
                                                <input type="text" class="form-control g-profile-idnumber-update" value="<?=$_SESSION['beetrip_user_info']["pn"]?>" />                        
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php 
                                        $dob = (!empty($_SESSION['beetrip_user_info']["birthdate"]) && $_SESSION['beetrip_user_info']["birthdate"]!="0000-00-00") ? $_SESSION['beetrip_user_info']["birthdate"] : date("Y-m-d", strtotime("-18 years"));
                                        
                                        ?>
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("dob")?></span>
                                                <input type="text" class="form-control datepicker g-profile-birthdaydate-update" value="<?=$dob?>" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("mobile")?></span>
                                                <input type="text" class="form-control g-profile-mobile-update" value="<?=$_SESSION['beetrip_user_info']["mobile"]?>" />
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("email")?></span>
                                                <input type="text" class="form-control g-profile-email-update" readonly="readonly" value="<?=$_SESSION['beetrip_user_info']["email"]?>" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("country")?></span>
                                                <label class="form-control-1-label">
                                                    <select class="form-control-1 custom-select g-profile-country-update">
                                                        <?php foreach(g_countries() as $val): ?>
                                                        <option value="<?=$val['id']?>" <?=($_SESSION['beetrip_user_info']["country"]==$val['id']) ? 'selected="selected"' : ''?>><?=$val['title']?></option>
                                                        <?php endforeach; ?>                                             
                                                    </select>
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group mb-lg-0">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text d-inline-block"><?=l("city")?></span>
                                                <input type="text" class="form-control g-profile-city-update" value="<?=$_SESSION['beetrip_user_info']["city"]?>" />
                                            </label>                        
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button type="button" class="button button--yellow button--form-submit g-profileedit-button-update"><?=l("update")?></button>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
                        <?php if(!isset($_GET["edit"])): ?>
                        <div class="row justify-content-center">
                            <div class="offset-lg-2 col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("entername")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["firstname"]?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("lastname")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["lastname"]?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("idnumber")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["pn"]?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("birthdaydate")?></div>
                                            <div class="profile-info__val profile-info__val--date"><?=$_SESSION['beetrip_user_info']["birthdate"]?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("mobile")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["mobile"]?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("email")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["email"]?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("country")?></div>
                                            <div class="profile-info__val"><?=g_countries_name($_SESSION['beetrip_user_info']["country"])?></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="profile-info text-center text-lg-left">
                                            <div class="profile-info__key"><?=l("city")?></div>
                                            <div class="profile-info__val"><?=$_SESSION['beetrip_user_info']["city"]?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="orders">
                            <h3 class="orders__title text-center"><?=l("orders")?> </h3>
                            <?php 
                            $g_cart = g_cart(array("payed", "invoiced"));

                            if(count($g_cart)):
                            ?>
                            <div class="section section--order-details">
                                <div class="container">
                                    <div class="row order-details-headers text-center">
                                        <div class="col-1">&nbsp;</div>
                                        <div class="col-2"><?=l("tours")?></div>
                                        <div class="col-2"><?=l("passenger")?></div>
                                        <div class="col-1"><?=l("price")?></div>
                                        <div class="col-2"><?=l("pickup")?></div>
                                        <div class="col-2"><?=l("orderdate")?></div>
                                        <div class="col-2"><?=l("invoice")?></div>
                                    </div>
                                    <?php 
                                    $doubleWay = "";
                                    $guests = "";
                                    foreach($g_cart as $item): 
                                        $title = $item['title'];
                                        if($item["type"]=="transport"){
                                            $image1 = "http://odisisoftware.com/images/transport.png";
                                            
                                            
                                            if($item['startPlaceName2'] && $item['endPlaceName2']){
                                                $title = $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                                
                                                $guests = l("adults").": ".$item["guests"];
                                                $guests .= "<br />";

                                                if($item["childrenunder"]>0){
                                                    $guests .= l("underchildrenages").": ".$item["childrenunder"];
                                                }

                                                if($item["children"]>0){
                                                    $guests .= l("childrenages").": ".$item["children"];
                                                } 

                                                $guests .= "<hr />";

                                                $guests .= l("adults")." ".$item["guests2"];
                                                $guests .= "<br />";
                                                
                                                if($item["childrenunder2"]>0){
                                                    $guests .= l("underchildrenages").": ".$item["childrenunder2"];
                                                    $guests .= "<br />";
                                                }

                                                if($item["children2"]>0){
                                                    $guests .= l("childrenages").": ".$item["children2"];
                                                }                                    
                                            }else{
                                                $title = $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                                $guests = l("adults").": ".$item["guests"];
                                                $guests .= "<br />";
                                                if($item["childrenunder"]>0){
                                                    $guests .= l("underchildrenages").": ".$item["childrenunder"];
                                                    $guests .= "<br />";
                                                }

                                                if($item["children"]>0){
                                                    $guests .= l("childrenages").": ".$item["children"];
                                                }
                                            }
                                            
                                        }


                                        $logoImage = "/_website/images/transport-1-yellow.svg";
                                        $logoImage2 = "/_website/images/transport-1-yellow.svg";
                                        
                                        if(isset($item["transport_name1"]) && $item["transport_name1"] == "Sedan"){
                                            $logoImage = "/_website/images/transport-1-yellow.svg";
                                        }else if(isset($item["transport_name1"]) && $item["transport_name1"] == "Minivan"){
                                            $logoImage = "/_website/images/transport-2-yellow.svg";
                                        }else if(isset($item["transport_name1"]) && $item["transport_name1"] == "Bus"){
                                            $logoImage = "/_website/images/bus-yellow.svg";
                                        }
                                    ?>
                                    <div class="order-details text-center">
                                        <div class="row align-items-center">
                                            <div class="col-1">
                                                <div style="background-image: url('<?=$logoImage?>'); height: 100px; background-repeat: no-repeat; background-position: center; background-size: 50px;"></div>
                                                <?php if($item['startPlaceName2'] && $item['endPlaceName2']){ ?>
                                                <div style="background-image: url('<?=$logoImage2?>'); height: 100px; background-repeat: no-repeat; background-position: center; background-size: 50px;"></div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-2"><?=$title?><?=$doubleWay?></div>
                                            <div class="col-2"><?=$guests?></div>
                                            <div class="col-1">
                                                <span class="tdprice"><?=$item['roud1_price']?></span>
                                                <span class="lari-symbol">l</span>
                                                <br />
                                                <?php if($item['roud2_price']>0): ?>
                                                <span class="tdprice"><?=$item['roud2_price']?></span>
                                                <span class="lari-symbol">l</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-2">
                                                <p><?=$item['startdate']?></p>
                                                <p><?=$item['timetrans']?></p>
                                                <?php if($item['roud2_price']>0): ?>
                                                <p><?=$item['startdate2']?></p>
                                                <p><?=$item['timetrans2']?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-2">
                                                <?=date("d-m-Y", $item['date'])?>
                                            </div>
                                            <div class="col-2">
                                                <?php
                                                if(!empty($item['attachment'])){
                                                $attachment = explode("/public_html/", $item['attachment']);
                                                $url = "https://tripplanner.ge/".$attachment[1];
                                                ?>
                                                <a href="<?=$url?>" target="_blank"><?=l("invoice")?></a>
                                                <?php } ?>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
        <!-- content -->

<!--Custom Scripts-->

<script type="text/javascript" src="/_website/js/jquery.inputmask.bundle.min.js"></script>
<script src="_website/minJs/profile.min.js"></script>

<script src="_website/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="_website/plugins/jquery-ui-1.12.1.custom/addons/timepicker/js/jquery-ui-timepicker-addon.js"></script>
<script>
$(".datepicker").datepicker({
    changeYear: true,
    yearRange: '-100:-10',
    dateFormat: "yy-mm-dd",
    beforeShow: function(input, inst) {
        $("#ui-datepicker-div").addClass("ui-datepicker--calendar");

        setTimeout(function(){
            $('.ui-datepicker').css('z-index', '20000 !important');
        }, 0);
    },
    onClose: function(input, inst) {
        $("#ui-datepicker-div").css("display", "none");
        $("#ui-datepicker-div").removeClass("ui-datepicker--calendar");
    }
});
</script>
<script type="text/javascript">
	// add grey style to body
	var site = document.getElementsByClassName("site");
	site[0].className += " bg-gray";
	// add active to menu link
	var link = document.getElementsByClassName("g-profile");
	link[0].className += " active";

    $(".g-profile-idnumber-update").inputmask({"mask": "99999999999"});
    $(".g-profile-mobile-update").inputmask({"mask": "+(999) 999 99-99-99"});
</script>

