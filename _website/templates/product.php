<?php defined('DIR') OR exit;?>
<?php 
//print_r($variables); 
?>
<main class="site__content" style="margin-bottom: 40px;">
  <div class="content">
      <div class="page-content pt-0 pb-0">
          <div class="section pb-0">
              <div class="container-fluid-from-before-xl">
                  <div class="d-lg-flex align-items-lg-center position-relative">
                      <div class="swiper-container tour-slider">
                          <div class="swiper-wrapper">
                              <?php 
                              for($x=1; $x<=10; $x++): 
                              if($variables["image".$x]==""){ continue; }
                              ?>
                              <div class="swiper-slide" style="background-image: url('<?=$variables["image".$x]?>');"></div>
                              <?php endfor; ?>
                          </div>
                          <!-- Add Pagination -->
                          <div class="swiper-pagination swiper-pagination--tour-slider"></div>
                      </div>
                      <div class="tour-details text-center text-lg-left">
                          <div class="tour-details__content">
                              <h2 class="tour-title"><?=$variables["title"]?></h2>
                              <div class="text-holder text-holder--tour-details">
                                 <?=$variables["description"]?>
                              </div>
                          </div>
                          <div class="tour-details__footer d-lg-flex align-items-lg-center">
                              
                              <div class="tour-price text-yellow gelprice" data-gelprice="0">0</div>
                              
                              <div class="button-group ml-lg-auto">
                                  <?php $_SESSION["CSRF_token"] = md5(sha1(time())); ?>
                                  <input type="hidden" name="CSRF_token" id="CSRF_token" value="<?=$_SESSION["CSRF_token"]?>" />
                                  <a href="#" class="button button--green button--icon button--icon-position-left button--icon-cart button--add-to-cart g-addCart" data-inside="true" data-redirect="false" data-id="<?=$variables["id"]?>" data-title="<?=l("message")?>" data-errortext="<?=l("error")?>"><?=l("addtocart")?></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="container">
                  <div class="tour-info-controls form-row align-items-center">
                      <input type="hidden" id="g-cur__" value="<?=(isset($_SESSION["currency_123"])) ? $_SESSION["currency_123"] : 'gel'?>">
                      <input type="hidden" id="g-cur-exchange-usd" value="<?=(float)s("currencyusd")?>">
                      <input type="hidden" id="g-cur-exchange-eur" value="<?=(float)s("courseeur")?>">
                      <div class="col-lg-3 tour-info-controls__col">
                          <div class="datepicker-container posiion-relative">
                              <label for=""><?=l("startdate")?></label>
                              <input type="text" class="form-control form-control--icon form-control--icon-position-right form-control--icon-calendar datepicker g-datepicker form-control--small border-radius-0 DatePicker2" placeholder="Start Date">
                          </div>
                      </div>
                      <div class="col-lg-3 tour-info-controls__col">
                          <div class="datepicker-container posiion-relative">
                              <label for=""><?=l("enddate")?></label>
                              <?php 
                              $newdates = time() + ((int)$variables["total_dayes"] * 86400) + 172800;
                              ?>
                              <input type="text" class="form-control form-control--icon form-control--icon-position-right form-control--icon-calendar g-datepicker form-control--small border-radius-0 DatePicker3" disabled="disabled" value="<?=date("d-m-Y", $newdates)?>">
                          </div>
                      </div>
                      <div class="col-lg-2 tour-info-controls__col">
                          <label for=""><?=l("adults")?></label>
                          <input type="number" min="1" value="1" id="gg-adults" class="form-control form-control--small border-radius-0">
                      </div>
                      <div class="col-lg-2 tour-info-controls__col">
                          <label for=""><?=l("underchildrenages")?></label>
                          <input type="number" min="0" value="0" id="gg_children_05" class="form-control form-control--small border-radius-0 tour-child-number-under">
                      </div>
                      <div class="col-lg-2 tour-info-controls__col">
                          <label for=""><?=l("childrenages")?></label>
                          <input type="number" min="0" value="0" id="gg_children_612" class="form-control form-control--small border-radius-0">
                      </div>
                      <div class="col-lg-12 tour-info-controls__col text-center text-lg-left">
                          <label style="width:100%">&nbsp;</label>
                          <span class="tour-info-controls__additional-info-label text-yellow text-uppercase">+ <?=l("freeinsurance")?></span>
                      </div>
                  </div>
                  <div class="tour-days">
                      <div class="row">
                          <div class="col-lg-12">
                              <?=$variables["overview"]?>
                              <hr><br>
                              <?=$variables["includes"]?>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          
          
          <div class="section section--other-tours">
            <div class="container">
                <div class="other-tours">
                    <h3 class="other-tours__title text-center"><?=l("moretours")?></h3>
                    <div class="position-relative other-tours-carousel-container">
                        <div class="swiper-container other-tours-carousel">
                            <?php 
                            $items = g_homepage_tours(false, false, 10);
                            ?>
                            <div class="swiper-wrapper">
                                <?php foreach($items as $item): 
                                  $link = str_replace("https://tripplanner.ge","https://beetrip.ge",href(63,array(), l(), $item['id']));
                                ?>
                                <div class="swiper-slide other-tour text-center">
                                    <a href="<?=$link?>" class="other-tour__img-container d-block position-relative" style="width: 100%; height: 220px; background-size: cover; background-image: url('<?=$item["image1"]?>'); display: block;">
                                        <!-- <img src="" width="460" height="460" alt="" class="img-fluid"> -->
                                    </a>
                                    <h4 class="other-tour__title"><a href="#"><?=$item["title"]?></a></h4>
                                    <div class="button-group">
                                        <a href="<?=$link?>" class="button button--green button--icon-position-left" style="padding: 5px 25px;"><?=l("read.more")?></a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination swiper-pagination--other-tours-carousel"></div>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
      </div>
  </div>
  </main>

  <?php 

?>


  <script>
  <?php 
  $Transport = g_listselect(40, false);
  $productPrices = [];
  foreach($Transport as $tra){
    if($tra["id"]==125){ //sedani
      $productPrices["sedan"]["p_ongoing_max_crowd"] = $tra["menutitle10"];
    }else if($tra["id"]==126){ //minivan
      $productPrices["minivan"]["p_ongoing_max_crowd"] = $tra["menutitle10"];
    }else if($tra["id"]==127){ //minibus
      $productPrices["minibus"]["p_ongoing_max_crowd"] = $tra["menutitle10"];
    }else if($tra["id"]==220){ //bus
      $productPrices["bus"]["p_ongoing_max_crowd"] = $tra["menutitle10"];
    }
  }

  $cur = "<span class='lari-symbol'>l</span>";
  $cur_exchange = 1;
  $cur_exchange_usd = (float)s("currencyusd");
  $cur_exchange_eur = (float)s("courseeur");
  if(isset($_SESSION["currency_123"])){
      if($_SESSION["currency_123"]=="usd"){
          $cur = "$";
          $cur_exchange = (float)s("currencyusd");                        
      }

      if($_SESSION["currency_123"]=="eur"){
          $cur = "&euro;";
          $cur_exchange = (float)s("courseeur");                      
      }
  }
  ?>
  
  (function(){
    var productPrices = {
      sedan:{
        p_ongoing_max_crowd:parseFloat("<?=(float)$productPrices['sedan']['p_ongoing_max_crowd']?>")
      },
      minivan:{
        p_ongoing_max_crowd:parseFloat("<?=(float)$productPrices['minivan']['p_ongoing_max_crowd']?>")
      },
      minibus:{
        p_ongoing_max_crowd:parseFloat("<?=(float)$productPrices['minibus']['p_ongoing_max_crowd']?>")
      },
      bus:{
       p_ongoing_max_crowd:parseFloat("<?=(float)$productPrices['bus']['p_ongoing_max_crowd']?>")
      }
    };

    var countData = {
      g_cur:"<?=$cur?>",
      g_curexchange:"<?=$cur_exchange?>",
      g_curexchangeusd:"<?=$cur_exchange_usd?>",
      g_curexchangeeur:"<?=$cur_exchange_eur?>",
      price_sedan: parseInt("<?=$variables["price_sedan2"]?>"),
      guest_sedan: parseInt("<?=$variables["guest_sedan2"]?>"),
      price_minivan: parseInt("<?=$variables["price_minivan2"]?>"),
      price_minibus: parseInt("<?=$variables["price_minibus2"]?>"),
      price_bus: parseInt("<?=$variables["price_bus2"]?>"),
      tour_margin: parseInt("<?=$variables["tour_margin2"]?>"),
      tour_income_margin: parseInt("<?=(int)$variables["tour_income_margin2"]?>"),
      tour_total_days: parseInt("<?=(int)$variables["total_dayes2"]?>"),
      cuisune: parseInt("<?=(int)$variables["cuisune_price1person2"]?>"),
      ticket: parseInt("<?=(int)$variables["ticketsandother_price1person2"]?>"),
      hotel: parseInt("<?=(int)$variables["hotelpricefortour2"]?>"),
      guide: parseInt("<?=(int)$variables["guidepricefortour2"]?>")
    };

    let crew = parseInt($("#gg-adults").val()); 
    g_countOngoingTour(
      crew, 
      countData.price_sedan, 
      countData.guest_sedan, 
      countData.price_minivan, 
      countData.price_minibus, 
      countData.price_bus, 
      countData.tour_margin, 
      new Array(), 
      countData.cuisune, 
      countData.ticket, 
      countData.hotel, 
      countData.guide, 
      countData.tour_income_margin,
      productPrices
    );

    $("#gg-adults").change(function(){
      let crew = parseInt($("#gg-adults").val()); 
      g_countOngoingTour(
        crew, 
        countData.price_sedan, 
        countData.guest_sedan, 
        countData.price_minivan, 
        countData.price_minibus, 
        countData.price_bus, 
        countData.tour_margin, 
        new Array(), 
        countData.cuisune, 
        countData.ticket, 
        countData.hotel, 
        countData.guide, 
        countData.tour_income_margin,
        productPrices
      );
    });

    $("#gg_children_05").change(function(){
      let crew = parseInt($("#gg-adults").val()); 
      g_countOngoingTour(
        crew, 
        countData.price_sedan, 
        countData.guest_sedan, 
        countData.price_minivan, 
        countData.price_minibus, 
        countData.price_bus, 
        countData.tour_margin, 
        new Array(), 
        countData.cuisune, 
        countData.ticket, 
        countData.hotel, 
        countData.guide, 
        countData.tour_income_margin,
        productPrices
      );
    });

    $("#gg_children_612").change(function(){
      let crew = parseInt($("#gg-adults").val()); 
      g_countOngoingTour(
        crew, 
        countData.price_sedan, 
        countData.guest_sedan, 
        countData.price_minivan, 
        countData.price_minibus, 
        countData.price_bus, 
        countData.tour_margin, 
        new Array(), 
        countData.cuisune, 
        countData.ticket, 
        countData.hotel, 
        countData.guide, 
        countData.tour_income_margin,
        productPrices
      );
    });


    $(document).on("change", ".DatePicker2", function(){
      var dd = $(this).val().split("-");

      let startDate = new Date(dd[2]+"-"+dd[1]+"-"+dd[0]);


      let tour_dayes_times = parseInt(countData.tour_total_days) * 86400000;
      let tour_finish = startDate.getTime() + tour_dayes_times;
      
      var setTodate = new Date(new Date().setTime(tour_finish));


      $(".DatePicker3").val(setTodate.yyyymmdd());
      return false;
    });

  })();

  $(function(){new Swiper(".tour-slider",{slidesPerView:1,autoplay:{delay:5e3},pagination:{el:".swiper-pagination--tour-slider",clickable:!0}}),new Swiper(".other-tours-carousel",{spaceBetween:12,slidesPerView:3,breakpoints:{1199:{slidesPerView:2},424:{slidesPerView:1}},loop:!0,loopFillGroupWithBlank:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination--other-tours-carousel",clickable:!0}})});
</script>
<script src="_website/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="_website/minJs/datepicker.min.js?time=1563971520"></script>