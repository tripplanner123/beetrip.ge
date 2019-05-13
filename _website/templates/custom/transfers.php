<?php defined('DIR') OR exit; ?>
<div id="transfer-notification-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="?">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                            <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="notification-icon notification-icon--mb ml-auto mr-auto g-modal-icon"></div>
                    <div class="text-holder">
                        <h6 style="text-align: center;font-size: 21px !important;font-weight: 400;"><?=l("message")?></h6>
                        <br>
                        <p style="text-align: center;font-size: 14px !important;color: #2C2C2C;" class="g-modal-text"></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modals -->


<main class="site__content">
    <div class="content">
        <div class="page-content page-content--transfer">
            
            <div class="container">
                <div class="transfer-header text-center">
                    <span class="transfer-icon d-inline-block"></span>
                    <div class="clear"></div>
                    <h2 class="transfer-heading d-inline-block position-relative"><?=menu_title(62)?></h2>
                </div>
                <div class="transfer-content bg-white">
                	<?php 
					$g_getlist = g_transfer_start_places(); 
					$g_transports = g_transports();
					?>

                    <form action="?" class="transfer-form">
                    	<input type="hidden" name="km" id="km" class="km" value="0" />
                    	<input type="hidden" name="km2" id="km2" class="km2" value="0" />
                    	<?php foreach ($g_transports as $tra): ?>
                    	<input type="hidden" name="kilo-price" id="kilo-price-<?=$tra['id']?>" value="<?=htmlentities($tra['menutitle'])?>" data-price_50="<?=$tra['menutitle']?>" data-price_100="<?=$tra['menutitle2']?>" data-price_200="<?=$tra['menutitle3']?>" data-price_200_plus="<?=$tra['menutitle4']?>" />
                    	<?php endforeach; ?>
                        <div class="row transfer-form__controls">
                            <div class="col-lg-5">
                                <div class="form-group form-group--lg">
                                    <label class="form-control-1-label">
                                        <select class="form-control-1 custom-select g-startingplace" style="padding: 0 15px;">
                                        	<option value=""><?=l("choosestartingplace")?></option>
                                        	<?php 
                                                foreach ($g_getlist as $item): 
                                                    $map_coordinates = str_replace(":",",",$item['map_coordinates']);
                                            ?>
                                            <option value="<?=$item['id']?>" data-map="<?=$map_coordinates?>" data-plus="<?=$item['price_plus']?>"><?=$item['title']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("choosestartingplace")?></span> -->
                                    </label>
                                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                                </div>
                                <div class="form-group form-group--lg mb-lg-0">
                                    <label class="form-control-1-label">
                                        <select class="form-control-1 custom-select g-endingplace" style="padding: 0 15px;">
                                            <option value=""><?=l("chooseendplace")?></option>
                                            <?php foreach ($g_getlist as $item): 
                                                $map_coordinates = str_replace(":",",",$item['map_coordinates']);
                                            ?>
											<option value="<?=$item['id']?>" data-map="<?=$map_coordinates?>" data-plus="<?=$item['price_plus']?>"><?=$item['title']?></option>	
											<?php endforeach; ?>
                                        </select>
                                        <!-- <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("chooseendplace")?></span> -->
                                    </label>
                                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-group--lg">
                                    <label class="form-control-1-label">
                                        <input type="text" class="form-control-1 form-control-1--icon form-control-1--icon-position-right form-control-1--icon-calendar datepicker g-datepicker" placeholder="<?=l("startdate")?>" value="" />
                                        <span class="form-control-1-label__text"><?=l("startdate")?></span>
                                    </label>
                                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                                </div>
                                <div class="form-group form-group--lg mb-lg-0">
                                    <input type="hidden" name="g-timepicker"  id="g-timepicker" class="g-timepicker" value="<?=date("H:i")?>" />
                                    <div class="g-new-timepicker">
                                        <div class="g-new-show-box" id="g-new-show-box" data-opened="false">
                                            <div class="g-new-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                                            <div class="g-new-time" id="g-new-time">
                                                <?=date("H : i")?>
                                            </div>
                                        </div>

                                        <div class="g-new-timepickbox" id="g-new-timepickbox">
                                            <table border="0" cellspacing="0" cellpadding="10" style="width: 100%;">
                                                <tr>
                                                    <td><span><?=l("hour")?></span></td>
                                                    <td>&nbsp;</td>
                                                    <td><span><?=l("minute")?></span></td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0)" class="g-uphour" data-attach="g-new-hour1" id="g-uphour">
                                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="g-upminute" data-attach="g-new-minute1" id="g-upminute">
                                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <input type="text" name="g-new-hour g-new-hour1" class="g-new-hour" id="g-new-hour" value="<?=date("H")?>" />
                                                    </td>
                                                    <td>:</td>
                                                    <td>
                                                        <input type="text" name="g-new-minute g-new-minute1" id="g-new-minute" class="g-new-minute" value="<?=date("i")?>" />
                                                    </td>
                                                </tr>


                                                <tr>
                                                    <td>
                                                        <a href="javascript:void(0)" class="g-downhour" data-attach="g-new-hour1" id="g-downhour">
                                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="g-downminute" data-attach="g-new-minute1" id="g-downminute">
                                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group form-group--lg">
                                    <label class="form-control-1-label">
                                        <span class="quantity d-block clearfix">
                                            <input type="number" class="form-control-1 g-numberofpeople" min="1" step="1" value="1" placeholder="<?=l("adults")?>">
                                        </span>
                                        <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("adults")?></span>
                                    </label>
                                </div>

                                <div class="row" style="padding-top: 28px;">
                                    <div class="col-lg-6">
                                        <div class="form-group form-group--lg">
                                            <label class="form-control-1-label">
                                                <span class="quantity d-block clearfix">
                                                    <input type="number" class="form-control-1 g-under-child" min="0" step="1" value="0" placeholder="">
                                                </span>
                                                <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("underchildrenages")?></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group form-group--lg">
                                            <label class="form-control-1-label">
                                                <span class="quantity d-block clearfix">
                                                    <input type="number" class="form-control-1 g-child" min="0" step="1" value="0" placeholder="">
                                                </span>
                                                <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("childrenages")?></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group--lg mb-0">
                                    <div class="transport">
                                        <div class="transport__label-text"><?=l("vehicletype")?></div>
                                        <ul class="transport__list">
                                            <li class="transport__list-item">
                                                <label class="transport__radio-label text-center">
                                                    <input type="radio" class="transport__radio d-none g-transporDropDownId g-sedan" name="transport" checked="checked" data-id="125" />
                                                    <span class="transport__icon transport__icon--1 d-block"></span>
                                                    <span class="transport__price d-block text-uppercase g-sedan-price">0 <?=currencySign()?></span>
                                                    <span class="transport__type d-block"><?=l("sedan")?></span>
                                                </label>
                                            </li>
                                            
                                            <li class="transport__list-item">
                                                <label class="transport__radio-label text-center">
                                                    <input type="radio" class="transport__radio d-none g-transporDropDownId g-minivan" data-id="126" name="transport">
                                                    <span class="transport__icon transport__icon--2 d-block"></span>
                                                    <span class="transport__price d-block text-uppercase g-minivan-price">0 <?=currencySign()?></span>
                                                    <span class="transport__type d-block"><?=l("minivan")?></span>
                                                </label>                                            <li class="transport__list-item">

                                            </li>
                                            
                                            <li class="transport__list-item">
                                                <label class="transport__radio-label text-center">
                                                    <input type="radio" class="transport__radio d-none g-transporDropDownId g-minibus" data-id="127" name="transport">
                                                    <span class="transport__icon trans-icon-3 d-block"></span>
                                                    <span class="transport__price d-block text-uppercase g-minibus-price">0 <?=currencySign()?></span>
                                                    <span class="transport__type d-block"><?=l("minibus")?></span>
                                                </label>
                                            </li>

                                            <li class="transport__list-item">
                                                <label class="transport__radio-label text-center">
                                                    <input type="radio" class="transport__radio d-none g-transporDropDownId g-bus" data-id="220" name="transport">
                                                    <span class="transport__icon trans-icon-3 d-block"></span>
                                                    <span class="transport__price d-block text-uppercase g-bus-price">0 <?=currencySign()?></span>
                                                    <span class="transport__type d-block"><?=l("bus")?></span>
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="transfer-form__buttons-1">                            
                            <button type="button" class="button button--gray transfer-form__button button--way-toggle text-uppercase" data-text-double-way="<?=l("return")?>" data-text-single-way="<?=l("return")?>"><?=l("return")?></button>

                            

                            <button type="button" class="button button--yellow transfer-form__button button--form-submit text-uppercase ml-lg-auto button--order g-order-button" data-type="order" style="float:right;"><?=l("order")?></button>

                            <button type="button" class="button button--gray transfer-form__button button--form-submit text-uppercase ml-lg-auto button--order g-order-button" data-type="cart" data-messageheader="<?=l('thankyouorder')?>" style="float:right;"><?=l("addtocart")?></button>
                        </div>
                        <div class="transfer-form__buttons-2 transfer-form__buttons-2--hidden"></div>
                        <div style="clear: both"></div>
                    </form>
                </div>
            </div>


            <div style="clear: both;"></div>


            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col-lg-12 g-firstmap">
                        <div id="SidebarSmallMap" style="height: 360px;"></div>
                    </div>
                    <div class="col-lg-6 g-secondmap" style="display: none;">
                        <div id="SidebarSmallMap2" style="height: 360px;"></div>
                    </div>
                </div>
            </div>



        </div>
    </div>
        </main>
        <!-- content -->


		<div class="row transfer-form__controls transfer-form__controls--double-way transfer-form__controls--hidden">
            <div class="col-lg-5">
                <div class="form-group form-group--lg">
                    <label class="form-control-1-label">
                        <select class="form-control-1 custom-select g-startingplace2" style="padding: 0 15px;">
                        	<option value=""><?=l("choosestartingplace")?></option>
                        	<?php foreach ($g_getlist as $item): ?>
                            <option value="<?=$item['id']?>" data-map="<?=str_replace(":",",",$item['map_coordinates'])?>" data-plus="<?=$item['price_plus']?>"><?=$item['title']?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("choosestartingplace")?></span> -->
                    </label>
                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                </div>
                <div class="form-group form-group--lg mb-lg-0">
                    <label class="form-control-1-label">
                        <select class="form-control-1 custom-select g-endingplace2" style="padding: 0 15px;">
                            <option value=""><?=l("chooseendplace")?></option>
                            <?php foreach ($g_getlist as $item): ?>
							<option value="<?=$item['id']?>" data-map="<?=str_replace(":",",",$item['map_coordinates'])?>" data-plus="<?=$item['price_plus']?>"><?=$item['title']?></option>	
							<?php endforeach; ?>
                        </select>
                        <span class="form-control-1-label__text"><?=l("chooseendplace")?></span>
                    </label>
                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group form-group--lg">
                    <label class="form-control-1-label">
                        <input type="text" class="form-control-1 form-control-1--icon form-control-1--icon-position-right form-control-1--icon-calendar datepicker g-datepicker2" placeholder="<?=l("startdate")?>" value="">
                        <span class="form-control-1-label__text"><?=l("startdate")?></span>
                    </label>
                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                </div>
                <div class="form-group form-group--lg mb-lg-0">


                    

                    <div class="g-new-timepicker">
                        <input type="hidden" name="g-timepicker2"  id="g-timepicker2" class="g-timepicker2" value="<?=date("H:i")?>" />

                        <div class="g-new-show-box" id="g-new-show-box2" data-opened="false">
                            <div class="g-new-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                            <div class="g-new-time" id="g-new-time2">
                                <?=date("H : i")?>
                            </div>
                        </div>

                        <div class="g-new-timepickbox" id="g-new-timepickbox2">
                            <table border="0" cellspacing="0" cellpadding="10" style="width: 100%;">
                                <tr>
                                    <td><span><?=l("hour")?></span></td>
                                    <td>&nbsp;</td>
                                    <td><span><?=l("minute")?></span></td>
                                </tr>

                                <tr>
                                    <td>
                                        <a href="javascript:void(0)" class="g-uphour" data-attach="g-new-hour1" id="g-uphour2">
                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <a href="javascript:void(0)" class="g-upminute" data-attach="g-new-minute1" id="g-upminute2">
                                            <i class="fa fa-caret-up" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="text" name="g-new-hour g-new-hour1" class="g-new-hour" id="g-new-hour2" value="<?=date("H")?>" />
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" name="g-new-minute g-new-minute1" id="g-new-minute2" class="g-new-minute" value="<?=date("i")?>" />
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <a href="javascript:void(0)" class="g-downhour" data-attach="g-new-hour1" id="g-downhour2">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <a href="javascript:void(0)" class="g-downminute" data-attach="g-new-minute1" id="g-downminute2">
                                            <i class="fa fa-caret-down" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        
                    </div>





                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group form-group--lg">
                    <label class="form-control-1-label">
                        <span class="quantity2 d-block clearfix">
                            <input type="number" class="form-control-1 g-numberofpeople2" min="1" step="1" value="1" placeholder="<?=l("adults")?>">
                        </span>
                        <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("adults")?></span>
                    </label>
                    <div class="form-control-helper-text form-control-helper-text--form-control-1">&nbsp;</div>
                </div>

                <div class="row" style="padding-top: 0;">
                    <div class="col-lg-6">
                        <div class="form-group form-group--lg">
                            <label class="form-control-1-label">
                                <span class="quantity2 d-block clearfix">
                                    <input type="number" class="form-control-1 g-under-child2" min="0" step="1" value="0" placeholder="">
                                </span>
                                <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("underchildrenages")?></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group form-group--lg">
                            <label class="form-control-1-label">
                                <span class="quantity2 d-block clearfix">
                                    <input type="number" class="form-control-1 g-child2" min="0" step="1" value="0" placeholder="">
                                </span>
                                <span class="form-control-1-label__text form-control-1-label__text--active"><?=l("childrenages")?></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group--lg mb-0">
                    <div class="transport">
                        <div class="transport__label-text"><?=l("vehicletype")?></div>
                        <ul class="transport__list">
                            <li class="transport__list-item">
                                <label class="transport__radio-label text-center">
                                    <input type="radio" class="transport__radio d-none g-transporDropDownId2 g-sedan2" name="transport-1" checked="checked" data-id="125">
                                    <span class="transport__icon transport__icon--1 d-block"></span>
                                    <span class="transport__price d-block text-uppercase g-sedan-price2">0 <?=currencySign()?></span>
                                    <span class="transport__type d-block"><?=l("sedan")?></span>
                                </label>
                            </li>
                            <li class="transport__list-item">
                                <label class="transport__radio-label text-center">
                                    <input type="radio" class="transport__radio d-none g-transporDropDownId2 g-minivan2" name="transport-1" data-id="126">
                                    <span class="transport__icon transport__icon--2 d-block"></span>
                                    <span class="transport__price d-block text-uppercase g-minivan-price2">0 <?=currencySign()?></span>
                                    <span class="transport__type d-block"><?=l("minivan")?></span>
                                </label>
                            </li>
                            <li class="transport__list-item">
                                <label class="transport__radio-label text-center">
                                    <input type="radio" class="transport__radio d-none g-transporDropDownId2 g-minibus2" name="transport-1" data-id="127">
                                    <span class="transport__icon trans-icon-3 d-block"></span>
                                    <span class="transport__price d-block text-uppercase g-minibus-price2">0 <?=currencySign()?></span>
                                    <span class="transport__type d-block"><?=l("minibus")?></span>
                                </label>
                            </li>

                            <li class="transport__list-item">
                                <label class="transport__radio-label text-center">
                                    <input type="radio" class="transport__radio d-none g-transporDropDownId2 g-bus2" name="transport-1" data-id="220">
                                    <span class="transport__icon trans-icon-3 d-block"></span>
                                    <span class="transport__price d-block text-uppercase g-bus-price2">0 <?=currencySign()?></span>
                                    <span class="transport__type d-block"><?=l("bus")?></span>
                                </label>
                            </li>

                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- hidden double way form controls -->

<!--transfer Scripts-->
<script src="_website/minJs/default.min.js"></script>
<script src="_website/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="_website/plugins/jquery-ui-1.12.1.custom/addons/timepicker/js/jquery-ui-timepicker-addon.js"></script>
<script src="_website/minJs/datepicker.min.js?time=<?=time()?>"></script>
<script src="_website/minJs/timepicker.min.js"></script>
<script type="text/javascript">
$.timepicker.regional['<?=l()?>'] = {
    timeOnlyTitle: '<?=l("choosetime")?>',
    timeText: '<?=l("time")?>',
    hourText: '<?=l("hour")?>',
    minuteText: '<?=l("minute")?>',
    currentText: '<?=l("now")?>',
    closeText: '<?=l("close")?>',
    ampm: false
};
$.timepicker.setDefaults($.timepicker.regional['<?=l()?>']);

<?php 
$g_transports = g_transports();
$tra = array();
foreach ($g_transports as $v) {
    if($v["id"]==125){
        $tra["sedan"]["t_0_50"] = (float)$v["menutitle"];  
        $tra["sedan"]["t_50_100"] = (float)$v["menutitle2"];
        $tra["sedan"]["t_100_150"] = (float)$v["menutitle3"];
        $tra["sedan"]["t_150_200"] = (float)$v["menutitle4"];
        $tra["sedan"]["t_200_250"] = (float)$v["menutitle5"];
        $tra["sedan"]["t_250_300"] = (float)$v["menutitle6"];
        $tra["sedan"]["t_300_350"] = (float)$v["menutitle7"];
        $tra["sedan"]["t_350_400"] = (float)$v["menutitle8"];
        $tra["sedan"]["t_400_plus"] = (float)$v["menutitle9"];
        $tra["sedan"]["t_max_passanger"] = (int)$v["menutitle10"];
        $tra["sedan"]["t_income_procent"] = (int)$v["menutitle11"];
        $tra["sedan"]["samewaydiscount2"] = (int)$v["samewaydiscount2"];
    }else if($v["id"]==126){
        $tra["minivan"]["t_0_50"] = (float)$v["menutitle"];  
        $tra["minivan"]["t_50_100"] = (float)$v["menutitle2"];
        $tra["minivan"]["t_100_150"] = (float)$v["menutitle3"];
        $tra["minivan"]["t_150_200"] = (float)$v["menutitle4"];
        $tra["minivan"]["t_200_250"] = (float)$v["menutitle5"];
        $tra["minivan"]["t_250_300"] = (float)$v["menutitle6"];
        $tra["minivan"]["t_300_350"] = (float)$v["menutitle7"];
        $tra["minivan"]["t_350_400"] = (float)$v["menutitle8"];
        $tra["minivan"]["t_400_plus"] = (float)$v["menutitle9"];
        $tra["minivan"]["t_max_passanger"] = (int)$v["menutitle10"];
        $tra["minivan"]["t_income_procent"] = (int)$v["menutitle11"];
        $tra["minivan"]["samewaydiscount2"] = (int)$v["samewaydiscount2"];
    }else if($v["id"]==127){
        $tra["minibus"]["t_0_50"] = (float)$v["menutitle"];  
        $tra["minibus"]["t_50_100"] = (float)$v["menutitle2"];
        $tra["minibus"]["t_100_150"] = (float)$v["menutitle3"];
        $tra["minibus"]["t_150_200"] = (float)$v["menutitle4"];
        $tra["minibus"]["t_200_250"] = (float)$v["menutitle5"];
        $tra["minibus"]["t_250_300"] = (float)$v["menutitle6"];
        $tra["minibus"]["t_300_350"] = (float)$v["menutitle7"];
        $tra["minibus"]["t_350_400"] = (float)$v["menutitle8"];
        $tra["minibus"]["t_400_plus"] = (float)$v["menutitle9"];
        $tra["minibus"]["t_max_passanger"] = (int)$v["menutitle10"];
        $tra["minibus"]["t_income_procent"] = (int)$v["menutitle11"];
        $tra["minibus"]["samewaydiscount2"] = (int)$v["samewaydiscount2"];
    }else if($v["id"]==220){
        $tra["bus"]["t_0_50"] = (float)$v["menutitle"];  
        $tra["bus"]["t_50_100"] = (float)$v["menutitle2"];
        $tra["bus"]["t_100_150"] = (float)$v["menutitle3"];
        $tra["bus"]["t_150_200"] = (float)$v["menutitle4"];
        $tra["bus"]["t_200_250"] = (float)$v["menutitle5"];
        $tra["bus"]["t_250_300"] = (float)$v["menutitle6"];
        $tra["bus"]["t_300_350"] = (float)$v["menutitle7"];
        $tra["bus"]["t_350_400"] = (float)$v["menutitle8"];
        $tra["bus"]["t_400_plus"] = (float)$v["menutitle9"];
        $tra["bus"]["t_max_passanger"] = (int)$v["menutitle10"];
        $tra["bus"]["t_income_procent"] = (int)$v["menutitle11"];
        $tra["bus"]["samewaydiscount2"] = (int)$v["samewaydiscount2"];
    }
}
?>
var transferPrices = {
    sedan:{
        t_0_50:parseFloat("<?=$tra["sedan"]["t_0_50"]?>"),
        t_50_100:parseFloat("<?=$tra["sedan"]["t_50_100"]?>"),
        t_100_150:parseFloat("<?=$tra["sedan"]["t_100_150"]?>"),
        t_150_200:parseFloat("<?=$tra["sedan"]["t_150_200"]?>"),
        t_200_250:parseFloat("<?=$tra["sedan"]["t_200_250"]?>"),
        t_250_300:parseFloat("<?=$tra["sedan"]["t_250_300"]?>"),
        t_300_350:parseFloat("<?=$tra["sedan"]["t_300_350"]?>"),
        t_350_400:parseFloat("<?=$tra["sedan"]["t_350_400"]?>"),
        t_400_plus:parseFloat("<?=$tra["sedan"]["t_400_plus"]?>"),
        t_max_passanger:parseFloat("<?=$tra["sedan"]["t_max_passanger"]?>"),
        t_income_procent:parseFloat("<?=$tra["sedan"]["t_income_procent"]?>"),
        samewaydiscount2:parseFloat("<?=$tra["sedan"]["samewaydiscount2"]?>")
    },
    minivan:{
        t_0_50:parseFloat("<?=$tra["minivan"]["t_0_50"]?>"),
        t_50_100:parseFloat("<?=$tra["minivan"]["t_50_100"]?>"),
        t_100_150:parseFloat("<?=$tra["minivan"]["t_100_150"]?>"),
        t_150_200:parseFloat("<?=$tra["minivan"]["t_150_200"]?>"),
        t_200_250:parseFloat("<?=$tra["minivan"]["t_200_250"]?>"),
        t_250_300:parseFloat("<?=$tra["minivan"]["t_250_300"]?>"),
        t_300_350:parseFloat("<?=$tra["minivan"]["t_300_350"]?>"),
        t_350_400:parseFloat("<?=$tra["minivan"]["t_350_400"]?>"),
        t_400_plus:parseFloat("<?=$tra["minivan"]["t_400_plus"]?>"),
        t_max_passanger:parseFloat("<?=$tra["minivan"]["t_max_passanger"]?>"),
        t_income_procent:parseFloat("<?=$tra["minivan"]["t_income_procent"]?>"),
        samewaydiscount2:parseFloat("<?=$tra["minivan"]["samewaydiscount2"]?>")
    },
    minibus:{
        t_0_50:parseFloat("<?=$tra["minibus"]["t_0_50"]?>"),
        t_50_100:parseFloat("<?=$tra["minibus"]["t_50_100"]?>"),
        t_100_150:parseFloat("<?=$tra["minibus"]["t_100_150"]?>"),
        t_150_200:parseFloat("<?=$tra["minibus"]["t_150_200"]?>"),
        t_200_250:parseFloat("<?=$tra["minibus"]["t_200_250"]?>"),
        t_250_300:parseFloat("<?=$tra["minibus"]["t_250_300"]?>"),
        t_300_350:parseFloat("<?=$tra["minibus"]["t_300_350"]?>"),
        t_350_400:parseFloat("<?=$tra["minibus"]["t_350_400"]?>"),
        t_400_plus:parseFloat("<?=$tra["minibus"]["t_400_plus"]?>"),
        t_max_passanger:parseFloat("<?=$tra["minibus"]["t_max_passanger"]?>"),
        t_income_procent:parseFloat("<?=$tra["minibus"]["t_income_procent"]?>"),
        samewaydiscount2:parseFloat("<?=$tra["minibus"]["samewaydiscount2"]?>")
    },
    bus:{
        t_0_50:parseFloat("<?=$tra["bus"]["t_0_50"]?>"),
        t_50_100:parseFloat("<?=$tra["bus"]["t_50_100"]?>"),
        t_100_150:parseFloat("<?=$tra["bus"]["t_100_150"]?>"),
        t_150_200:parseFloat("<?=$tra["bus"]["t_150_200"]?>"),
        t_200_250:parseFloat("<?=$tra["bus"]["t_200_250"]?>"),
        t_250_300:parseFloat("<?=$tra["bus"]["t_250_300"]?>"),
        t_300_350:parseFloat("<?=$tra["bus"]["t_300_350"]?>"),
        t_350_400:parseFloat("<?=$tra["bus"]["t_350_400"]?>"),
        t_400_plus:parseFloat("<?=$tra["bus"]["t_400_plus"]?>"),
        t_max_passanger:parseFloat("<?=$tra["bus"]["t_max_passanger"]?>"),
        t_income_procent:parseFloat("<?=$tra["bus"]["t_income_procent"]?>"),
        samewaydiscount2:parseFloat("<?=$tra["bus"]["samewaydiscount2"]?>")
    }
};
</script>
<script src="_website/js/transfer.js?time=<?=time()?>"></script>
<script src="_website/js/quantity.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQO6lM_r5Rt67fRIOVlawrfTKjAMzhis&amp;callback=initMap"></script>

<script type="text/javascript">
// add active to menu link
var link = document.getElementsByClassName("g-transfer");
link[0].className += " active";
</script>

<script type="text/javascript">
    var gt = {
        upHour: $("#g-uphour"),
        upMinute: $("#g-upminute"),
        downHour: $("#g-downhour"),
        downMinute: $("#g-downminute"),
        inputHour: $("#g-new-hour"),
        inputMinute: $("#g-new-minute"),
        fullTimeBox: $("#g-new-time"),
        hiddenFullTimeBox: $("#g-timepicker")
    };

    gTimePicker(gt);
</script>