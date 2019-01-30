<?php 
defined('DIR') OR exit; 
if(isset($_SESSION["beetrip_user"])){
	unset($_SESSION["beetrip_user"]);
}
if(isset($_SESSION["beetrip_user_info"])){
	unset($_SESSION["beetrip_user_info"]);
}
?>
<div id="terms-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-holder" style="font-size: 12px;color: #BABABA;">
                            <p>Terms and conditions of using the registered personal data The tourist takes responsibility to fill in the information Terms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the information
                            </p>
                            <br>
                            <p>Terms and conditions of using the registered personal data The tourist takes responsibility to fill in the information Terms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the informationTerms and conditions of using the registered personal data The tourist takes responsibility to fill in the information
                            </p>
                            <br>
                            <p>Terms and conditions of using the registered personal data The tourist takes responsibility to fill in the information
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center pt-0">
                        <a href="#" class="button button--yellow button--small text-uppercase" data-dismiss="modal" aria-label="Close">OK</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- modals -->


<main class="site__content">
    <div class="content">
        <div class="page-header bg-white">
            <div class="container">
                <h2 class="page-title text-center text-uppercase"><?=menu_title(69)?></h2>
            </div>
        </div>
        <div class="page-content pt-0">
            <div class="container">
                <div class="row">
                    <div class="offset-lg-2 col-lg-8">
                        <form action="?" method="post" id="g-registration-form" autocomplete="off">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-warning g-message-registration-page" style="background-color:#f7f7f7; display: none;"></div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("entername")?></span>
                                            <input type="text" class="form-control first-name" name="first-name" value="" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("lastname")?></span>
                                            <input type="text" class="form-control last-name" name="last-name" value="" />
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("idnumber")?></span>
                                            <input type="text" class="form-control id-number" name="id-number" value="" />
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("mobile")?></span>
                                            <input type="text" class="form-control mobile-number" name="mobile-number" value="+995" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("email")?></span>
                                            <input type="email" class="form-control email-address" name="email-address" value="" />
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label" style="font-size: 17px;"><?=l("birthdaydate")?></label>
                                        <label class="form-control-1-label">
                                            <?php 
                                            $date = date("Y-m-d");
                                            $date = strtotime($date.' -18 year');
                                            $date = date("Y-m-d", $date);
                                            ?>
                                            <input type="text" class="form-control form-control-1--icon form-control-1--icon-position-right form-control-1--icon-calendar datepicker g-birthdate" placeholder="<?=l("birthdaydate")?>" value="<?=$date?>" />
                                        </label>
                                        <div class="form-control-helper-text form-control-helper-text--form-control-1"> </div>
                                    </div>
                                </div> <!-- -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="font-size: 17px;"><?=l("country")?></label>
                                        <label class="form-control-1-label">
                                            <select class="form-control custom-select g-country" style="height: 50px;">
                                                <?php foreach(g_countries() as $val): ?>
                                                <option value="<?=$val['id']?>"><?=$val['title']?></option>
                                                <?php endforeach; ?>                                             
                                            </select>
                                        </label>
                                    </div>
                                </div> <!-- -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="font-size: 17px;"><?=l("city")?></label>
                                        <input type="text" class="form-control g-city" value="" />
                                    </div>
                                </div> <!-- -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("password")?></span>
                                            <input type="password" class="form-control form-control--icon form-control--icon-position-left form-control--icon-lock user-password" name="user-password" value="" />
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="w-100 form-label">
                                            <span class="form-label-text d-inline-block"><?=l("passwordconfirm")?></span>
                                            <input type="password" class="form-control form-control--icon form-control--icon-position-left form-control--icon-lock password-confirm" name="password-confirm" value="" />
                                        </label>
                                    </div>
                                </div>

                                                                  
                                <div class="form-group col-sm-6"> 
                                    <label class="w-100 form-label">
                                        <span class="form-label-text d-inline-block"><?=l("captchacode")?></span>
                                        <input type="text" class="form-control captcha-code" name="captcha-code" value="" />
                                    </label>                
                                </div> 

                                <div class="form-group col-sm-6" style="padding-top: 28px;">
                                    <?php 
                                    echo '<img src="_modules/captcha/captchaImage.php" id="captcha" alt="CAPTCHA" />';
                                    ?>              
                                </div> 

                                <div class="col-lg-12">
                                    <div class="form-group mb-0">
                                        <div class="custom-checkbox-1">
                                            <input type="checkbox" class="agree-conditions-control custom-checkbox-1__input terms-conditions" id="agree-conditions-control-1" checked="checked" name="terms-conditions" />
                                            <label for="agree-conditions-control-1" class="custom-checkbox-1__label">
                                                <a href="#" class="text-yellow emphasized-link" data-toggle="modal" data-target="#terms-modal"><?=l("termcondition")?></a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        <button type="button" class="button button--yellow button--form-submit button--register RegistrationButton"><?=l("registration")?></button>
                                        <div class="have-an-account"><?=l("haveaccount")?> 
                                            <a href="#" class="text-yellow" data-toggle="modal" data-target="#auth-modal"><?=l("login")?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="_website/minJs/default.min.js"></script>
<script type="text/javascript" src="/_website/js/jquery.inputmask.bundle.min.js"></script>

<script src="_website/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="_website/plugins/jquery-ui-1.12.1.custom/addons/timepicker/js/jquery-ui-timepicker-addon.js"></script>
<!-- content -->
<script type="text/javascript">
    $(function () {
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
    });


	// add active to menu link
	var link = document.getElementsByClassName("g-registration");
    if(typeof link[0] !== "undefined"){
	   link[0].className += " active";
    }

    $(".datepicker").inputmask({"mask": "9999-99-99"}); 
    $(".id-number").inputmask({"mask": "99999999999"});
    $(".mobile-number").inputmask({"mask": "+(999) 999 99-99-99"});
</script>