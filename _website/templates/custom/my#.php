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

<div id="change-profile-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="?" class="change-password-form">
                <div class="modal-header flex-column align-items-center">
                    <img src="_website/images/logo.svg" width="100" height="50" alt="" class="change-password-form__icon">
                    <h4 class="change-password-form__title"><?=l("profile")?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                        <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                    </svg>
                </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning g-message-updateprofileinfo" style="background-color:#f7f7f7; display: none;"></div>
                    <div class="form-group">
                        <label><?=l("entername")?></label>
                        <input type="text" class="form-control g-profile-firstname-update" value="<?=$_SESSION['beetrip_user_info']["firstname"]?>" />
                    </div>
                    <div class="form-group">
                        <label><?=l("lastname")?></label>
                        <input type="text" class="form-control g-profile-lastname-update" value="<?=$_SESSION['beetrip_user_info']["lastname"]?>" />
                    </div>
                    <div class="form-group">
                        <label><?=l("idnumber")?></label>
                        <input type="text" class="form-control g-profile-idnumber-update" value="<?=$_SESSION['beetrip_user_info']["pn"]?>" />
                    </div>

                    <div class="form-group">
                        <label><?=l("dob")?></label>
                        <input type="text" class="form-control datepicker g-profile-birthdaydate-update" value="<?=$_SESSION['beetrip_user_info']["birthdate"]?>" />
                    </div>
                    
                    <div class="form-group">
                        <label><?=l("mobile")?></label>
                        <input type="text" class="form-control g-profile-mobile-update" value="<?=$_SESSION['beetrip_user_info']["mobile"]?>" />
                    </div>


                    <div class="form-group">
                        <label><?=l("country")?></label>
                        <label class="form-control-1-label">
                            <select class="form-control-1 custom-select g-profile-country-update">
                                <?php foreach(g_countries() as $val): ?>
                                <option value="<?=$val['id']?>" <?=($_SESSION['beetrip_user_info']["country"]==$val['id']) ? 'selected="selected"' : ''?>><?=$val['title']?></option>
                                <?php endforeach; ?>                                             
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label><?=l("city")?></label>
                        <input type="text" class="form-control g-profile-city-update" value="<?=$_SESSION['beetrip_user_info']["city"]?>" />
                    </div>

                </div>
                <div class="modal-footer justify-content-center pt-0">
                    <button type="button" class="button button--yellow button--small text-uppercase g-profileedit-button-update"><?=l("update")?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<main class="site__content">
            <div class="content">
                <div class="page-header bg-white">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <h2 class="page-title d-flex align-items-center justify-content-center justify-content-lg-start">
                                    <?=l("profile")?>
                                    <a href="#" data-toggle="modal" data-target="#change-profile-modal" class="profile-edit d-inline-block"></a>
                                </h2>
                            </div>
                            <div class="col-lg-4">
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
                            </div>
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
                            $g_payed = g_payed();
                            echo "Count: ".count($g_payed);
                            ?>
                            <div class="swiper-container orders-carousel">
                                <div class="swiper-wrapper">
                                    <?php foreach($g_payed as $v): ?>
                                    <div class="swiper-slide active">
                                        <a href="javascript:void(0)" class="g-myorder">
                                            <!-- <img src="_website/uploads/images/place-6.png" width="180" height="180" alt="" class="img-fluid"> -->
                                            <p><?=$v['startPlaceName']?> - <?=$v['endPlaceName']?></p>
                                            <?php if(isset($v['startPlaceName2'], $v['endPlaceName2'])): ?>
                                            <p><?=$v['startPlaceName2']?> - <?=$v['endPlaceName2']?></p>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination swiper-pagination--orders-carousel"></div>
                            </div>
                        </div>
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
$('#change-profile-modal').on('shown.bs.modal', function() {
    $(function () {
        $(".datepicker").datepicker({
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
    });
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

