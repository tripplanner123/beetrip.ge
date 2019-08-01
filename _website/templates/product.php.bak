<?php defined('DIR') OR exit;?>
<div class="InsidePagesHeader">
  <div class="Item" style="background:url('<?=WEBSITE?>/img/trip_1.jpg');"></div>
  <div class="Item" style="background:url('<?=WEBSITE?>/img/trip_2.jpg');"></div>
  <div class="Item" style="background:url('<?=WEBSITE?>/img/trip_3.jpg');"></div>
  <div class="Item" style="background:url('<?=WEBSITE?>/img/trip_4.jpg');"></div>
  
  
</div>



<div class="TripListPageDiv">
  <div class="TripListInsidePage"> 
    <div class="container"> 
      
      <div class="row row0">
        <div class="col s12">
          <div class="Breadcrumb"> 
            <a href="#" class="Nolink"><?=menu_title(1)?></a>
              <span>></span>
            <a href="#"><?=menu_title(61)?></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="ToursSliderDiv">
            <div class="BigImageSlide">
              <?php 
              for($i=1; $i<=10; $i++):
                $img = "image$i";
                if(!empty($$img)): 
              ?>
                  <div class="Image" style="background:url('<?=$$img?>');"></div>
              <?php 
                endif; 
              endfor;
              ?>
            </div>
            <div class="SmallImageSlide">
              <?php 
              for($i=1; $i<=10; $i++):
                $img = "image$i";
                if(!empty($$img)):
              ?>
                <div class="Image" style="background:url('<?=$$img?>');"></div>
              <?php 
                endif; 
              endfor;
              ?>
            </div>
          </div>
        </div>
        
        <div class="col-sm-9 ColSm9">
          <div class="TripSinglePage">
            <div class="TripTitle"><?=$title?></div>
            <div class="TripBottomDiv">
              <div class="TabsMenu">
                <ul> 
                  <li class="active">
                    <a href="#Overview" aria-controls="home" role="tab" data-toggle="tab"><?=l("overview")?></a>
                  </li>
                  <li>
                    <a href="#TourDescription" aria-controls="profile" role="tab" data-toggle="tab"><?=l("tourdescription")?></a>
                  </li>
                  <li>
                    <a href="#TourIncludes" aria-controls="messages" role="tab" data-toggle="tab"><?=l("tourincludes")?></a>
                  </li>
                  <li>
                    <a href="#Mapid" aria-controls="settings" role="tab" data-toggle="tab"><?=l("map")?></a>
                  </li>
                </ul>
              </div>
              
              <div class="TabsContent tab-content">
                <div class="tab-pane active" id="Overview"> 
                  <?php 
                  $cat = explode(",", $categories);
                  $cat = (isset($cat[0])) ? (int)$cat[0] : 0;
                  $sql = "SELECT `title`,`image1` FROM `pages` WHERE `id`={$cat} AND `visibility`=1 AND `deleted`=0 AND `language`='".l()."'";
                  $catimage = db_fetch($sql);
                  $image1 = (isset($catimage["image1"])) ? $catimage["image1"] : '';
                  $title = (isset($catimage["title"])) ? $catimage["title"] : '';
                  

                  $reg = explode(",", $regions);
                  $reg = (isset($reg[0])) ? (int)$reg[0] : 0;
                  $sql = "SELECT `title` FROM `pages` WHERE `id`={$reg} AND `visibility`=1 AND `deleted`=0 AND `language`='".l()."'";
                  $regtitle = db_fetch($sql);
                  $titlereg = (isset($regtitle["title"])) ? $regtitle["title"] : '';
                 // echo "regions: {$regions}<br />";
                  ?>
                  
                  <div class="PlannerCategories">
                    <div class="row"> 
                      <div class="Item active">
                        <div class="MuseumIcon" style="background-image: url('<?=$image1?>');     background-position: top center; width: 70px;"></div>
                        <div class="Title"><?=$title?></div>  
                      </div> 
                    </div>
                  </div> 
                  
                  <div class="FiltItemsDiv">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="Item"><?=$titlereg?></div>
                        <div class="Item"><?=$postdate?></div>
                      </div> 
                    </div>  
                  </div>
                  
                  <!-- <div class="PeoPleCount">
                    <div class="Icon"></div>
                    <div class="Count"><?=$tourists?></div>
                    <div class="Text">People</div>
                  </div> -->

                  <?=$overview?>
                  
                  <!-- <div class="ListDivCircre">
                    <div class="Title">Places To visit</div>
                    <li>Ananuri fortress</li>
                    <li>Gudauri panoramic viewpoint</li>
                    <li>"Travertines"</li>
                    <li>juta</li>
                    <li>Chaukhebi</li>
                  </div>
                  <div class="OverviewText">
                    The ensemble of the Ananuri Fortress, the Gudauri panoramas, breathtaking flickering travertines, a beautiful village Juta will leave indelible impressions on tourists.
                  </div> -->  
                </div>
                <div class="tab-pane" id="TourDescription"><?=$description?></div>
                <div class="tab-pane" id="TourIncludes"><?=$includes?></div>
                <div class="tab-pane" id="Mapid">
                  <div class="SidebarSmallMap text-center" id="SidebarSmallMap">
                  MAP DIV
                  </div>
                </div>

              </div>
            </div>
          </div>      
        </div>
        
        <div class="col-sm-3 ColSm3">
          <div class="TripSidebar">
            <div class="GreenSidebarDiv RightBackground ToursInsideSidebar">
              <div class="SidebarTitle"><?=l("orderdetails")?></div>
              <div class="FiltersDiv">
                <div class="col-sm-12 PaddingRight0">
                  <div class="btn-group SearchFilterItem"> 
                      <div class="TripTogglebutton">
                        <span>
                          <div class="row">
                            <div class="col-sm-6"><?=l("startdate")?></div>
                            <div class="col-sm-6" style="position:relative;left:-19px;"><?=l("enddate")?></div>
                          </div>
                        </span>
                        <div class="input-group PositionRelative">
                        <input type="text" class="form-control DatePicker" placeholder="2018-02-07">
                        <span class="input-group-addon TimeAddons">-</span>
                        <input type="text" class="form-control DatePicker" placeholder="2018-02-07">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      </div>
                      </div> 
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="btn-group SearchFilterItem"> 
                      <div class="TripTogglebutton">
                        <span class="Name1"><?=l("guest")?></span>
                        <div class="input-group PositionRelative"> 
                        <span class="Quantity Quantity2">
                          <div class="input-group">
                                <span class="input-group-btn">
                                    <button type="button" class="btn QuantityButton btn-number"  data-type="minus" data-field="quant[2]">
                                      <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" name="quant[2]" class="form-control tour-guest-number" value="1" min="1" max="100">
                                <span class="input-group-btn">
                                    <button type="button" class="btn QuantityButton btn-number" data-type="plus" data-field="quant[2]">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </span> 
                      </div>
                      </div> 
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="btn-group PackageInfoDiv"> 
                    <div class="">
                      <label><?=l("packageprice")?></label>
                      <span id="packageprice"><?=$price?> <i>A</i></span>
                    </div>
                  </div>
                </div>


              </div>


              <div class="TotalPriceDiv">
                    <div class="col-sm-6"><div class="Title"><?=l("totalprice")?></div></div>
                    <div class="col-sm-6 text-right"><div class="SumCount"><span><?=$price?> <i>A</i></span></div></div>
                    <div class="col-sm-8"><div class="FreeIncurance">+ <?=l("freeinsurance")?></div></div>
                    <div class="col-sm-12 pull-right text-center productPageCartBox">
                      <a href="#" class="GreenCircleButton_4"><?=l("buy")?></a>
                      <a href="javascript:void(0)" class="GreenCircleButton_4 addCart <?=(!empty($cartId)) ? 'active' : ''?>" data-id="<?=$id?>" data-title="<?=l("message")?>" data-errortext="<?=l("error")?>"><span class="CartIcon"></span> <?=l("addtocart")?></a> 
                    </div>
                  </div>
            </div>
          </div>
        </div>

      </div>

      <div class="MoreBlogList">
        <div class="Title"><?=l("viewalso")?></div>        
        <div class="ToursList">
          <div class="row">               
            <?php 
            foreach (g_inside_tours_rand() as $item):
              $link = href(63,array(), l(), $item['id']);
            ?>
            <div class="col-sm-3">
              <div class="Item">
                <div class="TopInfo" onclick="location.href='<?=str_replace(array('"',"'"," "),"",$link)?>'">
                  <div class="Background" style="background:url('<?=$item['image1']?>');"></div>
                </div>
                <div class="BottomInfo" onclick="location.href='<?=str_replace(array('"',"'"," "),"",$link)?>'">
                  <div class="Title"><?=g_cut($item['title'], 40)?></div>
                  <div class="Day"><?=$item['day_count']?> day</div>
                </div>
                <div class="Buttons">
                  <a href="javascript:void(0)" class="addCart<?=(!empty($item['cartId'])) ? ' active' : ''?>" data-id="<?=$item['id']?>" data-title="<?=l("wrongmessage")?>" data-errortext="<?=l("error")?>"><span class="CartIcon"></span> Add To Cart</a>
                  <a href="<?=str_replace(array('"',"'"," "),"",$link)?>"><span class="WishListIcon"></span> More</a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>


          </div>
        </div> 
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
  var map = "";
  function initMap() {
    var myLatLng = {lat: 41.63514628349129, lng: 41.62310082006843};    
    map = new google.maps.Map(document.getElementById('SidebarSmallMap'), {
      zoom: 12,
      center: myLatLng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();

    directionsDisplay.setMap(map);
    directionsDisplay.setOptions({ 
      polylineOptions: {
        strokeColor: "#12693b"
      }, 
      suppressMarkers: true 
    });

    var waypts = [];
    <?php 
    $mapsCoordinates = g_get_place_map_coordinates($places);
    foreach($mapsCoordinates as $v):
      //echo $v['map_coordinates']."<br>";
      if(empty($v['map_coordinates']) || $v['map_coordinates']==""){ continue; }
      $coords = explode(",", $v['map_coordinates']);
      if(!isset($coords[0]) || !isset($coords[1])){ continue; }
    ?>
    waypts.push({
          location: new google.maps.LatLng(<?=trim($coords[0])?>, <?=trim($coords[1])?>),
          stopover: true
    });
    <?php endforeach; ?>

    if(typeof waypts[0] !== "undefined"){
      var start = waypts[0].location;  
      var end = waypts[waypts.length-1].location;

      var request = {
        origin: start, 
        destination: end,
        travelMode: 'DRIVING',
        waypoints: waypts,
        optimizeWaypoints: true
      };

      directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            console.log("Everything is OK!");
            directionsDisplay.setDirections(response);
          }else{
            console.log("Fail!");
          }
      });
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      //var target = $(e.target).attr("href") 
      console.log("zoom change try");
      map.setZoom(7);
    });
  }

  $('.tour-guest-number').focusin(function(){
    var val = parseInt($(this).val());
    var price = parseFloat($("#packageprice").html().replace("<i>A</i>", ""));
    var total = price * val;
    $(".SumCount span").html(parseFloat(total).toFixed(2)+" <i>A</i>");
  });

  $(document).on("change", ".tour-guest-number", function(){
    var val = parseInt($(this).val());
    var price = parseFloat($("#packageprice").html().replace("<i>A</i>", ""));
    var total = price * val;
    $(".SumCount span").html(parseFloat(total).toFixed(2)+" <i>A</i>");
  });



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeSTjMJTVIuJaIiFgxLQgvCRl8HJqo0qo&amp;callback=initMap"></script>