<?php defined('DIR') OR exit; ?>
<!-- Message Modal start -->
<div id="g-pickplace-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title w-100 text-center"><?=l("pickup")?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                        <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="?" method="post" id="pickupplaceform">
                    <div class="form-group">
                        <input type="text" class="form-control" id="pick1" name="placeform" value="" />
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="pick2" name="placeform" value="" />
                    </div>
                    
                </form>
            </div>

            <div class="modal-footer  flex-column">
                <div id="g-pickplace-modal-footer">
                    <button type="button" class="button button--small button--yellow w-100 text-uppercase"><?=l("save")?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Message Modal end -->

<div id="cart-message-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="?" class="change-password-form">
                <div class="modal-header flex-column align-items-center">
                    <img src="_website/images/logo.svg" width="100" height="50" alt="" class="change-password-form__icon">
                    <!-- <h4 class="change-password-form__title"><?=l("message")?></h4> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22px" height="22px" viewBox="0 0 20.17 20.17">
                        <path fill="#4d4d4f" d="M19.74,17.68l-7.63-7.63,7.56-7.57A1.46,1.46,0,0,0,17.61.43L10.05,8,2.49.43A1.46,1.46,0,0,0,.43,2.49L8,10.05.43,17.62a1.46,1.46,0,0,0,2.07,2.06l7.56-7.57,7.62,7.62a1.46,1.46,0,0,0,2.07-2.06Z"></path>
                    </svg>
                </button>
                </div>
                <div class="modal-body">
                    <p style="font-size: 18px;"><?=l("checkyouremail")?></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
$select = db_fetch("SELECT `content` FROM `pages` WHERE `id`=131 AND `language`='".l()."'");
?>
<div id="purchase-terms-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 350px; overflow: auto;">
                <div class="text-holder" style="font-size: 12px;color: #BABABA;">
                    <?=strip_tags($select['content'], '<p><br>')?>
                </div>
            </div>
            <div class="modal-footer justify-content-center pt-0" style="margin-top: 20px;">
                <a href="#" class="button button--yellow button--small text-uppercase" data-dismiss="modal" aria-label="Close"><?=l("close")?></a>
            </div>
        </div>
    </div>
</div>

<?php 
if(isset($_GET["result"]) && ($_GET["result"]=="success" || $_GET["result"]=="fail")):
if($_GET["result"]=="success"){
    $select = db_fetch("SELECT `content` FROM `pages` WHERE `id`=178 AND `language`='".l()."'");
}else if($_GET["result"]=="fail"){
    $select = db_fetch("SELECT `content` FROM `pages` WHERE `id`=177 AND `language`='".l()."'");
}else{
    $select['content'] = "";
}
?>
<div id="purchase-status" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 350px; overflow: auto;">
                <div class="text-holder" style="font-size: 12px;color: #BABABA;">
                    <?=strip_tags($select['content'], '<p><br>')?>
                </div>
            </div>
            <div class="modal-footer justify-content-center pt-0" style="margin-top: 20px;">
                <a href="/" class="button button--yellow button--small text-uppercase"><?=l("close")?></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#purchase-status").modal("show");
</script>
<?php endif; ?>

<main class="site__content">
    <div class="content">
        <div class="page-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="page-title text-center text-lg-left"><?php echo $title ?></h2>
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
        <div class="page-content pt-0">
            <div class="container">
                <?php 
                $order_id='';
                $g_cart = g_cart();
                if(count($g_cart)){                 
                ?>
                <div class="table-responsive">
                    
                    <table class="cart-table w-100">
                        <thead>
                            <tr>
                                <th></th>
                                <th><?=l("tours")?></th>
                                
                                <th><?=l("pickup")?></th>
                                <th>&nbsp;</th>
                                <th><?=l("totalpricefinal")?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            
                            $totalPriceOut = 0;
                            $x=0;
                            foreach($g_cart as $item):
                            $x++;
                            $doubleWay = "";
                            $guests = "";
                            $totalPriceOut += $item['totalprice'];
                            if(!empty($item['tourplaces'])){
                                $sql = "SELECT `title` FROM `catalogs` WHERE `id` IN(".$item['tourplaces'].") AND `menuid`=36 AND `deleted`=0 AND `language`='".l()."'"; 
                                $fetch = db_fetch_all($sql);
                                $places = array();
                                foreach ($fetch as $v) {
                                    $places[] = $v['title'];
                                }

                                $item['title'] = implode("<br />", $places);
                                $item['image1'] = "/img/plan.png";
                            }

                            // $image1 = $item['image1'];
                            $title = $item['title'];
                            if($item["type"]=="transport"){

                                // $image1 = "/img/transport.png";
                                // echo $item['startPlaceName2'];
                                
                                if($item['startPlaceName2'] && $item['endPlaceName2']){
                                    $title .= $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                    $guests = "<br />".l("passenger").": ".($item["guests2"]+$item["children2"]+$item["childrenunder2"])."<br />";
                                    // $guests .= $item["transport_name1"]."<br />";
                                    $guests .= $item["roud1_price"]." <span class=\"lari-symbol\">l</span><br />";
                                    $guests .= $item["startPlaceName2"] . " - " . $item["endPlaceName2"];
                                    $guests .= "<br />".l("passenger").": ".$item["guests2"];
                                    // $guests .= "<br />".$item["transport_name2"];
                                    $guests .= "<br />".$item["roud2_price"]." <span class=\"lari-symbol\">l</span><br />";
                                    
                                }else{
                                    $title .= $item["startPlaceName"] . " - " . $item["endPlaceName"];
                                    $guests = "<br />".l("passenger").": ".($item["guests"]+$item["children"]+$item["childrenunder"]);
                                    // $guests .= "<br />".$item["transport_name1"];
                                    // $guests .= "<br />".$item["roud1_price"]."<br />";
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

                                if(isset($item["transport_name2"]) && $item["transport_name2"] == "Sedan"){
                                    $logoImage2 = "/_website/images/transport-1-yellow.svg";
                                }else if(isset($item["transport_name2"]) && $item["transport_name2"] == "Minivan"){
                                    $logoImage2 = "/_website/images/transport-2-yellow.svg";
                                }else if(isset($item["transport_name2"]) && $item["transport_name2"] == "Bus"){
                                    $logoImage2 = "/_website/images/bus-yellow.svg";
                                }
                                
                            }
                            ?>
                            <tr 
                                class="cart-items" 
                                id="r<?=$item['id']?>" 
                                data-title="<?=htmlentities($title)?>" 
                                data-title2="<?=htmlentities($item["startPlaceName2"] . " - " . $item["endPlaceName2"])?>" 
                                data-cid="<?=$item['id']?>" 
                                data-date1="<?=$item['startdate']?>" 
                                data-date2="<?=$item['startdate2']?>" 
                                data-transportname1="<?=$item["transport_name1"]?>"  data-transportname2="<?=$item["transport_name2"]?>" data-numberofpessingers1="<?=($item["guests"]+$item["children"]+$item["childrenunder"])?>" 
                                data-numberofpessingers2="<?=($item["guests2"]+$item["children2"]+$item["childrenunder2"])?>" 
                                data-price="<?=(float)$item['totalprice']?>" 
                                data-price1="<?=(float)$item['roud1_price']?>" 
                                data-price2="<?=(float)$item['roud2_price']?>">
                                <td>
                                    <div style="background-image: url('<?=$logoImage?>'); width: 100px; height: 100px; background-repeat: no-repeat; background-position: center; background-size: 50px;"></div>
                                    <?php if($item['startPlaceName2'] && $item['endPlaceName2']){ ?>
                                    <div style="background-image: url('<?=$logoImage2?>'); width: 100px; height: 100px; background-repeat: no-repeat; background-position: center; background-size: 50px;"></div>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span><?=$title?></span><?=$doubleWay.$guests?>
                                </td>
                                <td>
                                    <p><?=$item['startdate']?> <?=$item['timetrans']?></p>
                                    <?php if($item['startPlaceName2'] && $item['endPlaceName2']): ?>
                                    <p><?=$item['startdate2']?> <?=$item['timetrans2']?></p>
                                    <?php endif; ?>
                                </td>                                
                                
                                <td>
                                    
                                    <p class="pickupPlaceHtml pph<?=$item['id']?>"><?=$item["wherepickup"]?></p>
                                    

                                
                                    <p class="pickupPlaceHtml pph2<?=$item['id']?>"><?=$item["wherepickup2"]?></p>
                                        
                                    <button 
                                        type="button" 
                                        class="button button--yellow button--form-submit g-pickup-button NotoSansGeorgian" 
                                        data-modaltitle="<?=l("pickupmodaltitle")?>" 
                                        data-pick1="<?=l("pickupaddress1")?>" 
                                        data-pick2="<?=l("pickupaddress2")?>" 
                                        data-cartid="<?=$item['id']?>" 
                                        data-doubleway="<?=($item['startPlaceName2'] && $item['endPlaceName2']) ? "true" : "false"?>" 
                                        data-pickplacevalue1="<?=$item["wherepickup"]?>" 
                                        data-pickplacevalue2="<?=$item["wherepickup2"]?>" 
                                        style="min-width: 100px; margin-top: 0px; font-size: 13px; height: 25px; padding: 0 15px; line-height: 100%;"><i class="fa fa-map-marker" aria-hidden="true"></i> <?=l("pickupmodaltitle")?>
                                    </button>
                                </td>

                                <td>
                                    <?php 
                                    $currency_123 = "gel";
                                    if(isset($_SESSION["currency_123"])){
                                        $currency_123 = $_SESSION["currency_123"];
                                    }

                                    switch ($currency_123) {
                                        case 'usd':
                                            $totalPrice = round(((int)$item['roud1_price'] + (int)$item['roud2_price']) / (float)s("currencyusd"));
                                            break;
                                        case 'eur':
                                            $totalPrice = round((int)((int)$item['roud1_price'] + (int)$item['roud2_price']) / (float)s("courseeur"));
                                            break;
                                        default:
                                            $totalPrice = (int)$item['roud1_price'] + (int)$item['roud2_price'];
                                            break;
                                    }

                                     ?>
                                    <span class="tdprice"><?=(int)$totalPrice?></span>
                                    <?=currencySign()?>
                                </td>
                                <td class="text-right">
                                    <div class="custom-checkbox-1 d-inline-block">
                                        <input type="checkbox" class="cart-item-select-control custom-checkbox-1__input g-cart-item" id="cart-item-select-control-<?=$item['id']?>" data-id="<?=$item['id']?>" <?=($x==1) ? 'checked="checked"' : ''?>>
                                        <label for="cart-item-select-control-<?=$item['id']?>" class="custom-checkbox-1__label"></label>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                            $order_id=$item['uniq'];
                            
                            endforeach; 
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="siterules">
                    <!-- <label><input type="checkbox" name="siterules"> <?=l("siterule")?></label> -->

                    <div class="custom-checkbox-1 d-inline-block">
                        <input type="checkbox" class="custom-checkbox-1__input" name="siterules" id="siterules" <?=(isset($_SESSION["siterules"]) && $_SESSION["siterules"]=="checked") ? 'checked="checked"' : ''?>>
                        <label for="siterules" class="custom-checkbox-1__label"><a href="#" data-toggle="modal" data-target="#purchase-terms-modal"><?=l("siterule")?></a></label>
                    </div>
                    <script type="text/javascript">
                        <?php if(isset($_SESSION["siterules"]) && $_SESSION["siterules"]=="checked"): ?>
                        $(document).ready(function(){
                            $(".button-group--cart-action-button").removeAttr("disabled");
                        });
                        <?php endif; ?>
                    </script>

                </div>
                <div class="button-group button-group--cart-action-buttons text-lg-right g-buttons-show-hide">
                    
                    <button type="button" class="button button--gray button-group--cart-action-button button-delete text-uppercase g-cart-delete-button" disabled="disabled"><?=l("delete")?></button>

                    <?php if(isset($_SESSION["beetrip_user"])){ ?>
                    <button type="button" class="button button--yellow button-group--cart-action-button button--buy text-uppercase" disabled="disabled"><?=l("buy")?></button>
                    <?php }else{ ?>
                    <button type="button" class="button button--yellow text-uppercase button-group--cart-action-button" data-toggle="modal" data-target="#auth-modal" disabled="disabled"><?=l("buy")?></button>
                    <?php } ?>
                    
                </div>
                <?php 
                }else{
                    echo "<h5>".l("nodata")."</h5>";
                }
                ?>
            </div>
            <div class="container payment-block payment-block--hidden">
                <div class="select-payment-method-title text-center text-lg-left text-uppercase">
                    <?=l("selectpaymentmethod")?>
                </div>
                <div class="payment-tabs">
                    <ul class="nav nav-tabs align-items-center justify-content-center justify-content-lg-start" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-center" id="pay-method-2-tab" data-toggle="tab" href="#pay-method-2" role="tab" aria-controls="pay-method-2" aria-selected="false">
                                <span class="payment-method-icon payment-method-icon--2 d-inline-block"></span>
                                <span class="d-block"><?=l("invoicepayment")?></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <!-- <a class="nav-link text-center" id="pay-method-1-tab" data-toggle="tab" href="#pay-method-1" role="tab" aria-controls="pay-method-1" aria-selected="true">
                                <span class="payment-method-icon payment-method-icon--1 d-inline-block"></span>
                                <span class="d-block">Pay With Card</span>
                            </a> -->
                            
                            <?php 
                            $order_id = "fb657d65d12373dbf6983"; 
                            if($order_id!=""){?>
                            <a class="nav-link text-center g-pay-with-creditcard" href="javascript:void(0)" data-href="https://3dacq.georgiancard.ge/payment/start.wsm?lang=KA&merch_id=D6640FE47F9AE706A041C0D913DCF654&back_url_s=<?=urlencode('https://beetrip.ge/en/cart?result=success')?>&back_url_f=<?=urlencode('https://beetrip.ge/en/cart?result=fail')?>&preauth=N&o.order_id=<?=$order_id?>&o.userid=<?=(isset($_SESSION["beetrip_user"])) ? $_SESSION["beetrip_user"] : ''?>&o.lang=<?=l()?>">
                                <span class="payment-method-icon payment-method-icon--1 d-inline-block"></span>
                                <span class="d-block"><?=l("paywithcard")?></span>
                            </a>
                            <?php 
                            }
                            ?>
                        </li>
                    </ul>
                    <!-- method payment -->
                    <div class="tab-content" style="display: none;">
                        <div class="tab-pane fade show active" id="pay-method-2" role="tabpanel" aria-labelledby="pay-method-2-tab">
                            <form action="?">
                                <input type="hidden" id="itemstobuy" value="" />
                                <div class="payment-method-header">
                                    <div class="payment-method-header__title text-uppercase"><?=l("invoicepayment")?></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text form-label-text--gray d-inline-block"><?=l("company")?></span>
                                                <input type="text" class="form-control g-pay-company" value="" />
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text form-label-text--gray d-inline-block"><?=l("address")?></span>
                                                <input type="text" class="form-control g-pay-address" value="">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text form-label-text--gray d-inline-block"><?=l("idnumber")?></span>
                                                <input type="text" class="form-control g-pay-id" value="">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="w-100 form-label">
                                                <span class="form-label-text form-label-text--gray d-inline-block"><?=l("vatid")?></span>
                                                <input type="text" class="form-control g-pay-vat" value="">
                                            </label>
                                        </div>
                                        <button type="button" class="button button--yellow button--payment-submit w-100 text-uppercase"><?=l("order")?></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="table-responsive">
                                            <table class="table payment-table payment-table--1">
                                                <!-- result here -->
                                            </table>
                                        </div>
                                        <div class="sum-price-block d-flex justify-content-end">
                                            <div class="sum-price-block__additional-info">+<?=l("freeinsurance")?></div>
                                            <div class="sum-price-block__price">
                                                <div class="sum-price-block__price-key">
                                                    <?=l("totalprice")?>
                                                </div>
                                                <div class="sum-price-block__price-val">
                                                    <span class="theTotalPrice">0</span> <?=currencySign()?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-lg-none">
                                        <!--<button type="submit" class="button button--yellow button--payment-submit w-100 text-uppercase">order yys</button> for mobile -->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 




                </div>
            </div>
        </div>
    </div>
</main>
<!-- content -->

<script src="_website/minJs/default.min.js"></script>
<script type="text/javascript" src="_website/js/cart.js"></script>