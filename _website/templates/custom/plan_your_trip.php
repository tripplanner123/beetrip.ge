<?php defined('DIR') OR exit; ?>
<?php
$startingplace = g_places(false, true);
$regions = g_regions();
$g_places = g_places();
?>

<div class="InsidePagesHeader Big">
	<div class="Title"><span class="BigSpan"><?php echo $title ?></span></div>
	<div class="Item" style="background:url('_website/img/trip_1.jpg');"></div>
	<div class="Item" style="background:url('_website/img/trip_2.jpg');"></div>
	<div class="Item" style="background:url('_website/img/trip_3.jpg');"></div>
	<div class="Item" style="background:url('_website/img/trip_4.jpg');"></div>
</div>



<div class="TripListPageDiv TripListPageDiv22">
	<div class="TripListInsidePage"> 
		<div class="container"> 
		 	<div class="row row0">
		 		<div class="col s12">
		 			<div class="Breadcrumb"> 
				 		<?php echo location();?> 
					</div>
		 		</div>
		 	</div>

		 	<div class="FiltersDiv">
		 		<div class="row row8"> 
		 			<div class="col-sm-9 ColSm9_2 padding_0 ">
		 				<form action="?" method="position">
		 					<input type="hidden" name="input_regions" class="input_regions" value="[]" />
		 					<input type="hidden" name="input_start_place" class="input_start_place" value="[]" />
		 					<input type="hidden" name="input_date_start" class="input_date_start" value="[]" />
		 					<input type="hidden" name="input_date_end" class="input_date_end" value="[]" />
		 					<input type="hidden" name="input_guest" class="input_guest" value="[]" />
		 				</form>
						
						
						<div class="col-sm-4 ShowForMobile">
							<div class="HtmlMultiSelect">
								<div class="TItle"></div>
								<select id="mobile-place">
									<option selected disabled><?=l("choosestartingplace")?></option>
									<?php 
							    	foreach ($startingplace as $item):
							    		$selected = ($item["id"]==856) ? 'selected="selected"' : '';
							    	?>
							    	<option value="<?=$item["id"]?>" <?=$selected?>><?=$item["title"]?></option>
							    	<?php endforeach; ?>									
								</select>
							</div>
							<div class="HtmlMultiSelect">
								<div class="TItle"></div>
								<select multiple id="mobile-regions">
									<option selected disabled><?=l("searchbyregions")?></option>
									<?php 
										foreach ($regions as $item):
									?>
									<option value="<?=$item["id"]?>">
										<?=$item["title"]?> (<?=$item["placeCouned"]?>)
									</option>
									<?php endforeach; ?>
								</select>
							</div>
							
							
							
							<div class="MobileDateAndGuests">
								<div class="row">
									<div class="col-sm-777">
										<div class="HtmlMultiSelect HtmlMultiSelect222">
											<div class="Title"><?=l("startdate")?> &amp; <?=l("enddate")?> </div>
											<div class="MobileInputs">
												<div class="input-group PositionRelative">
													<span class="DateControl1">
														 <input type="date" id="mobile-startdate" class="form-control" value="<?=date("Y-m-d")?>">
													</span>
													<span class="input-group-addon TimeAddons">-</span>
													<span class="DateControl2">
														 <input type="date" id="mobile-enddate" class="form-control" value="<?=date("Y-m-d")?>">
													</span>
													<span class="input-group-addon addon2"><i class="fa fa-calendar"></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-555">
										<div class="HtmlMultiSelect FixedHeight">
											<div class="Title"><?=l("guest")?></div>
											<select id="mobile-guest"> 
												<?php for($x=1; $x<=30; $x++):?>
												<option value="<?=$x?>"><?=$x?></option>			
												<?php endfor; ?>						
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
		 				<div class="col-sm-4 HideForMobile">
				 			<div class="btn-group SearchFilterItem"> 
							    <div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
							    	<span class="Name1"><?=l("searchbyregions")?></span>
							    	<label class="Name2 LocationName InpueValue1"></label>
							    </div>
							    <div class="dropdown-menu LocationDropDown LocationDropDown1"> 
						        	<?php 
							    	foreach ($regions as $item):
							    	?>
						        	<div class="Item">
						        		<input class="TripCheckbox" type="checkbox" id="List<?=$item["id"]?>" value="<?=htmlentities($item["title"])?>" data-id="<?=$item["id"]?>">
										<label class="pull-left Text" for="List<?=$item["id"]?>">
											<?=$item["title"]?> <span><?=$item["placeCouned"]?></span>
										</label> 
						        	</div> 
						        	<?php endforeach; ?>
						        	<script> $("label[for='List145']").click(); </script>
							    </div>
							</div>
				 		</div>
				 		<div class="col-sm-4 HideForMobile">
				 			<div class="btn-group SearchFilterItem"> 
				 				<div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
							    	<span class="Name1"><?=l("choosestartingplace")?></span>
							    	<label class="Name2 LocationName InpueValue2">
							    		<?php if(isset($startingplace[2]['title'])) :?>
							    			<text><?=$startingplace[2]['title']?></text>
							    		<?php endif; ?>
							    	</label>
							    </div>
							    <div class="dropdown-menu LocationDropDown LocationDropDown2"> 
							    	<?php 
							    	foreach ($startingplace as $item):
							    		$checked = ($item["id"]==856) ? 'checked' : '';
							    	?>
						        	<div class="Item">
						        		<input class="TripCheckbox" type="checkbox" <?=$checked?> id="List<?=$item["id"]?>" value="<?=htmlentities($item["title"])?>">
										<label class="pull-left Text" for="List<?=$item["id"]?>">
											<?=$item["title"]?>
										</label> 
						        	</div> 
						        	<?php endforeach; ?>
							    </div>
							</div>
				 		</div>
				 		<div class="col-sm-4 PaddingRight0 HideForMobile">
				 			<div class="btn-group SearchFilterItem"> 
							    <div class="TripTogglebutton">
							    	<span>
							    		<div class="row">
							    			<div class="col-sm-6"><?=l("startdate")?></div>
							    			<div class="col-sm-6" style="position:relative;left:-19px;"><?=l("enddate")?></div>
							    		</div>
							    	</span>
							    	<div class="input-group PositionRelative">
							    	  <input type="hidden" id="daysbetween" value="0" />
									  <input type="text" class="form-control startDatePicker" value="<?=date('Y-m-d')?>" />
									  <span class="input-group-addon TimeAddons">-</span>
									  <input type="text" class="form-control endDatePicker" value="<?=date('Y-m-d')?>" />
									  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div>

									<script type="text/javascript">
										$('.startDatePicker').datepicker({
											format: 'yyyy-mm-dd',
											ignoreReadonly: true,
											autoclose:true
									    });

									    $('.endDatePicker').datepicker({
											format: 'yyyy-mm-dd',
											ignoreReadonly: true,
											autoclose:true
									    });
									</script>
							    </div> 
							</div>
				 		</div>
		 			</div>
			 		<div class="col-sm-1-5 HideForMobile">
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
								          <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100">
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
		 		</div>
		 	</div>



		 	<div class="row">
		 		<div class="col-sm-9 ColSm9">
					<div class="PlannerCategories">
				        		<div class="row">
				        			<div class="col-sm-3">
					        			<div class="Item catbox active" data-id="108">
					        				<div class="MuseumIcon"></div>
					        				<div class="Title"><?=menu_title(108)?></div> 
					        				<div class="CheckedItem"></div>
						        		</div>
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="Item catbox active" data-id="107">
					        				<div class="NaturalIcon"></div>
					        				<div class="Title"><?=menu_title(107)?></div> 
					        				<div class="CheckedItem"></div>
						        		</div>
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="Item catbox active" data-id="105">
					        				<div class="CulturalIcon"></div>
					        				<div class="Title"><?=menu_title(105)?></div> 
					        				<div class="CheckedItem"></div>
						        		</div>
					        		</div>
					        		<div class="col-sm-3">
					        			<div class="Item catbox active" data-id="106">
					        				<div class="WineToursIcon"></div>
					        				<div class="Title"><?=menu_title(106)?></div> 
					        				<div class="CheckedItem"></div>
						        		</div>
					        		</div>
				        		</div>
				        	</div>
			 		<div class="ToursPlannerDiv">
						<div  class="DivScroll"> 
							
							<div class="CheckboxListsForMobile ShowForMobile mobile-placesbox">
								<?php foreach ($g_places as $item): ?>
								<div class="Item"> 
									<input class="TripCheckbox" type="checkbox" data-map="<?=$item['map_coordinates']?>" data-categories="<?=$item['categories']?>" data-title="<?=htmlentities($item['title'])?>" id="Chek<?=$item['id']?>" />
									<label class="pull-left Text FontNormal" for="Chek<?=$item['id']?>">
										<img src="<?=$item['image1']?>"/>
										<div class="Info">
											<div class="Title"><?=$item['title']?></div>
											<div class="Text"><?=g_cut($item['description'],120)?></div>
										</div>
									</label> 		
								</div>	
								<?php endforeach; ?>							
							</div>
							

							
					  		<div class="CheckboxLists">
					  			<?php 					  			
					  			foreach($g_places as $item):
					  			?>					  			
					  			<div class="CheckBoxItem col-sm-3"> 
									<input class="TripCheckbox" type="checkbox" name="layout" id="<?=$item["id"]?>" value="<?=$item["id"]?>" data-map="<?=str_replace(":",",", $item["map_coordinates"])?>" data-title="<?=htmlentities($item["title"])?>" data-categories="<?=$item["categories"]?>" onclick="ColorDistance()" />
									<label class="pull-left Text FontNormal" for="<?=$item["id"]?>">
										<?=$item["title"]?>
										<div class="PositionRelative"> 
											<div class="ShowWindow1">
												<div class="Title"><?=$item["title"]?></div>
												<?php 
												$imagePath = explode("https://tripplanner.ge", $item["image1"]);
													if(!empty($item["image1"]) && $item["image1"]!="" && file_exists($imagePath[0])): ?>
													<div class="Image LoadImage" data-image="<?=$item["image1"]?>"></div>
												<?php endif; ?>
												<div class="Text">
													<?=strip_tags($item["description"], "<p><a><strong>")?>
												</div>
											</div>
										</div>
									</label> 		
								</div>
								<?php endforeach; ?>						
								
								
					  		</div>
						</div>
						
						<div style="clear:both"></div>
					</div>	

					<div class="PlannerBottom FiltersDiv">
							<div class="col-sm-6 ColSm6">
								<div class="PlanItem">
					        		<div class="FirstCheckDiv">
					        			<div class="CheckBox">
					        				<input class="TripCheckbox" type="checkbox" id="Hotels" value="Imereti">
											<label class="pull-left Text" for="Hotels">
												<div class="Icon"><img src="_website/img/hotel_icon.png"/></div>
												<div class="Title">Hotels</div>
											</label> 
					        			</div>
					        		</div>
									
									
					        		<div class="SecondCheckDiv">
					        			<?php 
					        			$Hotels = g_listselect(37, array(
					        				"`id`",
					        				"`title`",
					        				"`image1`",
					        				"`meta_desc`"
					        			));
					        			?>
										
										<div class="col-sm-4 ShowForMobile">
											<div class="HtmlMultiSelect">
												<div class="TItle"></div>
												<select>
													<option selected disabled>Choise Hotel</option>
													<option>Hotel 1</option>									
													<option>Hotel 2</option>									
													<option>Hotel 3</option>									
												</select>
											</div>
										</div>
										
					        			<div class="btn-group SearchFilterItem HideForMobile"> 
										    <div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
										    	<span class="Name1">Hotels</span>
										    	<label class="Name2 LocationName hostelValue"></label>
										    </div>
										    <div class="dropdown-menu HotelsDropDown"> 		        	
									        	<?php 
									        	foreach ($Hotels as $value):
									        	?>
									        	<div class="Item">
									        		<input class="TripCheckbox" type="checkbox" id="Hotels<?=$value['id']?>" data-hotelid="<?=(int)$value['id']?>" value="<?=htmlentities($value['title'])?>" />
													<label class="pull-left Text" for="Hotels<?=$value['id']?>" style="width:100%">
														<div class="Title2"><?=$value['title']?></div>
														<div class="TextDiv"><?=$value['meta_desc']?></div>
														<div class="Image" style="float:right"><img src="<?=$value['image1']?>" alt="" /></div>
													</label> 
									        	</div> 	
									        	<?php 
									        	endforeach; 
									        	?>

										    </div>
										</div>
					        		</div>	
					        	</div>
							</div>
							<div class="col-sm-6 ColSm6">
								<div class="PlanItem">
					        		<div class="FirstCheckDiv">
					        			<div class="CheckBox">
					        				<input class="TripCheckbox" type="checkbox" id="Cuisine" value="Imereti">
											<label class="pull-left Text" for="Cuisine">
												<div class="Icon"><img src="_website/img/cuisine_1.png"/></div>
												<div class="Title">Cuisine</div>
											</label> 
					        			</div>
					        		</div>
					        		<div class="SecondCheckDiv">
										<div class="col-sm-4 ShowForMobile">
											<div class="HtmlMultiSelect">
												<div class="TItle"></div>
												<select>
													<option selected disabled>Choose Cuisine</option>
													<option>georgian</option>									
													<option>georgian</option>									
													<option>georgian</option>									
												</select>
											</div>
										</div>	
					        			<div class="btn-group SearchFilterItem HideForMobile"> 
										    <div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
										    	<span class="Name1">Cuisune</span>
										    	<label class="Name2 LocationName CuisineValue"></label>
										    </div>
										    <div class="dropdown-menu OneListDropDown CuisineDropDown"> 
									        	<?php 
							        			$Cuisune = g_listselect(38, array(
							        				"`id`",
							        				"`title`"
							        			));
							        			?>
							        			<?php 
							        			foreach ($Cuisune as $value):
							        			?>
									        	<div class="Item">
									        		<input class="TripCheckbox" type="checkbox" id="Cuisine<?=$value['id']?>" value="<?=htmlentities($value['title'])?>">
													<label class="pull-left Text" for="Cuisine<?=$value['id']?>" />
														<?=$value['title']?>
													</label> 
									        	</div>
									        	<?php endforeach; ?>									        	
										    </div>
										</div>
					        		</div>	
					        	</div>
							</div>
							<div style="clear:both"></div>
							<div class="col-sm-6 ColSm6">
								<div class="PlanItem">
					        		<div class="FirstCheckDiv">
					        			<div class="CheckBox">
					        				<input class="TripCheckbox" type="checkbox" id="Lang11" value="Imereti">
											<label class="pull-left Text" for="Lang11">
												<div class="Icon"><img src="_website/img/lang_icon.png"/></div>
												<div class="Title">Guide</div>
											</label> 
					        			</div>
					        		</div>
					        		<div class="SecondCheckDiv">
										<div class="col-sm-4 ShowForMobile">
											<div class="HtmlMultiSelect">
												<div class="TItle"></div>
												<select>
													<option selected disabled>Choise Language</option>
													<option>geo</option>									
													<option>rus</option>									
													<option>batumi</option>									
												</select>
											</div>
										</div>	
					        			<div class="btn-group SearchFilterItem HideForMobile"> 
										    <div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
										    	<span class="Name1">Language</span>
										    	<label class="Name2 LangValue"></label>
										    </div>
										    <div class="dropdown-menu OneListDropDown LanguageDropDown"> 
									        	<?php 
							        			$Language = g_listselect(39, array(
							        				"`id`",
							        				"`title`"
							        			));
							        			foreach ($Language as $value):
							        			?>
									        	<div class="Item">
									        		<input class="TripCheckbox" type="checkbox" id="Language<?=$value['id']?>" value="<?=htmlentities($value['title'])?>">
													<label class="pull-left Text" for="Language<?=$value['id']?>">
														<?=$value['title']?>
													</label> 
									        	</div>	
									        	<?php endforeach; ?>							        	
										    </div>
										</div>
					        		</div>	
					        	</div>
							</div>
							<div class="col-sm-6 ColSm6">
								<div class="PlanItem">
					        		<div class="FirstCheckDiv">
					        			<div class="CheckBox">
					        				<input class="TripCheckbox" type="checkbox" id="Transport11" value="Imereti">
											<label class="pull-left Text" for="Transport11">
												<div class="Icon"><img src="_website/img/transport_1.png"/></div>
												<div class="Title">Transports</div>
											</label> 
					        			</div>
					        		</div>
					        		<div class="SecondCheckDiv">
										<div class="col-sm-4 ShowForMobile">
											<div class="HtmlMultiSelect">
												<div class="TItle"></div>
												<select>
													<option selected disabled>Choise Transports</option>
													<option>geo</option>									
													<option>rus</option>									
													<option>batumi</option>									
												</select>
											</div>
										</div>
					        			<div class="btn-group SearchFilterItem HideForMobile"> 
										    <div class="dropdown-toggle TripTogglebutton" data-toggle="dropdown">
										    	<span class="Name1">Transport</span>
										    	<label class="Name2 LocationName TransportValue"></label>
										    </div>
										    <div class="dropdown-menu OneListDropDown TransporDropDown"> 
									        	<?php 
							        			$Transport = g_listselect(40, array(
							        				"`id`",
							        				"`title`",
							        				"`meta_desc`"
							        			));
							        			foreach ($Transport as $value):
							        			?>
							        			<div class="Item">
									        		<input class="TripCheckbox" type="checkbox" id="tra<?=$value['id']?>" value="<?=htmlentities($value['title'])?>">
													<label class="pull-left Text" for="tra<?=$value['id']?>">
														<?=$value['title']?>
														<div class="IconSmall"><i class="<?=htmlentities($value['meta_desc'])?>"></i></div>
													</label> 
									        	</div>
							        			<?php endforeach; ?>						        	
										    </div>
										</div>
					        		</div>	
					        	</div>
							</div>
							<div style="clear:both"></div>
						</div>
					
			 	</div>
			 	<div class="col-sm-3 ColSm3">
			 		<div class="TripSidebar">
			 			<form action="" method="post" id="plantripform">			 				
			 			</form>
						<div class="GreenSidebarDiv RightBackground">
							<div class="SidebarTitle"><?=l("yourdironmap")?></div>
							<div class="SidebarSmallMap text-center" id="SidebarSmallMap">
								MAP DIV
							</div>
							<div class="response"></div>
							<div class="SidebarDaysList">
							</div>
							<div class="TotalPriceDiv">
				        		<div class="col-sm-6"><div class="Title"><?=l("totalprice")?></div></div>
				        		<div class="col-sm-6 text-right padding_0"><div class="SumCount"><span>0</span></div></div>
				        		<div class="col-sm-8"><div class="FreeIncurance">+ <?=l("freeinsurance")?></div></div>
				        		<div class="col-sm-12 pull-right text-center padding_0">
				        			<div class="col-sm-12 padding_0"><a href="javascript:void(0)" class="GreenCircleButton_4"><?=l("buy")?></a></div>
				        			<div class="col-sm-12 padding_0"><a href="javascript:void(0)" class="GreenCircleButton_4 addPlanTripToCart" data-title="<?=l("message")?>"  data-successText="<?=l("welldone")?>"><?=l("addtocart")?></a></div>
				        		</div>
				        	</div>
						</div>
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
        zoom: 6,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer();
   

    $(document).on("change", ".CheckBoxItem input[type='checkbox']", function(){
    	$(".SidebarDaysList").html("");
    	$(".SumCount span").html("0");
    	var val = $(this).val();
    	var dier = $(this).attr("data-map");
    	var cate = $(this).attr("data-categories");
    	var title = $(this).attr("data-title");
    	if($(this).prop("checked") && dier != ""){
    		var input = "<input type=\"hidden\" name=\"plantrip_direction[]\" id=\"plantrip_direction"+val+"\" data-map=\""+dier+"\" data-categories=\""+cate+"\" data-title=\""+title+"\" value=\""+val+"\" />";
    		$("#plantripform").append(input);
    	}else{
    		$("#plantrip_direction"+val).remove();
    	}
    	directionsDisplay.setMap(map);
    	directionsDisplay.setOptions( { polylineOptions: {
				strokeColor: "#12693b"
			}, suppressMarkers: true } );
    	setTimeout(function(){
    		updateDirections(google, directionsService, directionsDisplay);
    	}, 500);
    }); 

    $(document).on("change", ".mobile-placesbox .Item input[type='checkbox'] ", function(){
    	$(".SidebarDaysList").html("");
    	$(".SumCount span").html("0");
    	var val = $(this).val();
    	var dier = $(this).attr("data-map");
    	var cate = $(this).attr("data-categories");
    	var title = $(this).attr("data-title");

    	if($(this).prop("checked") && dier != ""){
    		var input = "<input type=\"hidden\" name=\"plantrip_direction[]\" id=\"plantrip_direction"+val+"\" data-map=\""+dier+"\" data-categories=\""+cate+"\" data-title=\""+title+"\" value=\""+val+"\" />";
    		$("#plantripform").append(input);
    	}else{
    		$("#plantrip_direction"+val).remove();
    	}
    	directionsDisplay.setMap(map);
    	directionsDisplay.setOptions( { polylineOptions: {
				strokeColor: "#12693b"
			}, suppressMarkers: true } );
    	setTimeout(function(){
    		updateDirections(google, directionsService, directionsDisplay);
    	}, 500);
    });

    $(document).on("click", ".btn-number", function(){
    	directionsDisplay.setMap(map);
    	directionsDisplay.setOptions( { polylineOptions: {
				strokeColor: "#12693b"
			}, suppressMarkers: true } );
    	setTimeout(function(){
    		updateDirections(google, directionsService, directionsDisplay);
    	}, 500);
    });

    $('.LocationDropDown2 input').change(function() {
       	directionsDisplay.setMap(map);
    	directionsDisplay.setOptions( { polylineOptions: {
				strokeColor: "#12693b"
			}, suppressMarkers: true } );
    	setTimeout(function(){
    		updateDirections(google, directionsService, directionsDisplay);
    	}, 500);
    });
} 


function updateDirections(google, directionsService, directionsDisplay)
{
	var rates_js = new Array();
	var rates_preffix_js = new Array();
	var rates_suffix_js = new Array();
	rates_js["GEL"] = 1; 
	rates_preffix_js["GEL"] = ''; 
	rates_suffix_js["GEL"] = '<i>A</i>'; 
	rates_js["USD"] = 2.4452; 
	rates_preffix_js["USD"] = '$'; 
	rates_suffix_js["USD"] = ''; 
	rates_js["EUR"] = 2.6266; 
	rates_preffix_js["EUR"] = '	&euro;'; 
	rates_suffix_js["EUR"] = ''; 

	var waypts = [];
	var checked_places = [];
	$("#plantripform input").each(function(){
		var m = $(this).attr("data-map").split(",");
		var c = $(this).attr("data-cates");
		var t = $(this).attr("data-title");
		waypts.push({
	        location: new google.maps.LatLng(m[0],m[1]),
	        stopover: true
	    });
	    checked_places.push({
	    	typeID:c,
	    	title:t
	    });
	});

	var start = $(".InpueValue2 text").text();	
    var end = waypts[waypts.length-1].location;
    waypts.pop();

    var request = {
		origin: start, 
		destination: end,
        travelMode: 'DRIVING',
        waypoints: waypts,
	    optimizeWaypoints: true
    };
	
	directionsService.route(request, function(response, status) {
		
		if (status == google.maps.DirectionsStatus.OK) {
			// console.log(response.routes[0].legs);
			directionsDisplay.setDirections(response);

			var km = 0;
			var hours = 0;
			var TotalPrice = 0;
			var Day = 1;
			var lastDay = 0;
			var price_sum_converted = 0;
			var totalkm = 0;
			var kmprice = 1;
			$(".SidebarDaysList").html('');
			$(".SumCount span").text(TotalPrice);
			var tours_full_amount = $(".input-number").val();

			for(var counter = 0; counter <= (response.routes[0].legs.length-1); counter++){
				totalkm += (response.routes[0].legs[counter].distance.value)*2;
			}
			
			if(totalkm > 200){
				kmprice = 0.8;
			}
			var toursArray = new Array();
			for(var counter = 0; counter <= (response.routes[0].legs.length-1); counter++){
				km += (response.routes[0].legs[counter].distance.value)*2;
				hours += (((response.routes[0].legs[counter].duration.value/60)/60)*2)+1;
				km = km/1000;

				var price = (km*kmprice)+30;

				var car = tours_full_amount%7;
				var car_add = Math.floor(tours_full_amount/7);
				var price_percent = (car*10)+40;

				var price_add = price*car_add;
				price = (price*price_percent)/100;
			
				price = Math.round(price_add+price);
				if(checked_places[counter].typeID == '106'){//wine tours
					price = price+30;
				}

				TotalPrice += price;

				if(Math.ceil(hours/14) <= 1){
                	Day = 1;
            	}else{
                	Day = Math.ceil(hours/14);
            	}

            	// if(Day > 1){
             //    	var daystr = 'Days';
            	// }else{
             //    	var daystr = 'Day';
            	// }

				// if(Day != lastDay) {
				// document.getElementById('tours_places').innerHTML += '<hr><h6 class="color-red">'+Day+' '+daystr+' </h6>';
				// }

				// if(Day <= 1){
    //             	$('#hotel').prop('disabled', true);
    //         	}else{
    //             	$('#hotel').prop('disabled', false);
    //         	}

    			price_sum_converted = TotalPrice/rates_js["GEL"];
				price_sum_converted = Math.round(price_sum_converted);
				$(".SumCount span").html(rates_preffix_js["GEL"]+" "+price_sum_converted+" "+rates_suffix_js["GEL"]);
				
				var dayName = "day"+Day;
				
				var TourList = {};
				TourList[dayName] = {
					title:checked_places[counter].title,
					price:price,
					day:Day
				};				
				toursArray.push(TourList);
			}

			var d = "";
			console.log(parseInt(Day));
			for(var i = 0; i<parseInt(Day); i++){
				var active = (i==0) ? " active" : "";
				d += "<div class=\"Item"+active+"\">";
				d += "<div class=\"Day\"><span>"+(i+1)+"</span>Day</div>";

				for(var i2 = 0; i2<=toursArray.length; i2++){
					if(typeof toursArray[i2] !== "undefined" && typeof toursArray[i2]["day"+(i+1)] !== "undefined"){
						var datax = toursArray[i2]["day"+(i+1)];
						d += "<li><label>"+datax.title+"</label> <span>"+datax.price+rates_suffix_js["GEL"]+"</span></li>";
					}
					
				}

				d += "</div>";
			}
			$(".SidebarDaysList").html(d);
		}else{
			//console.log(status);
		}
		
	});
}



</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClQO6lM_r5Rt67fRIOVlawrfTKjAMzhis&amp;callback=initMap"></script>

<script type="text/javascript">
	/*
	mobile change start
	*/
	$("#mobile-regions").change(function(){
		updateDataMobile();
	});

	$("#mobile-place").change(function(){
		var id = $(this).val();
		$(".LocationDropDown2 .Item #List"+id).trigger("click");
	})
	/*
	mobile change end
	*/

	$('.LocationDropDown1 input').change(function() {
		if (this.checked) {
			$li = $(' <text> </text> ');
			$li.text(this.value);
			$('.InpueValue1').append($li);
		}
		else {
			$('text:contains('+this.value+')', '.InpueValue1').remove();
		}

		updateData();
	});

    $('.LocationDropDown2 input').change(function() {
        $(".InpueValue2 text").remove();
        $(".LocationDropDown2 input").prop('checked', false);
        this.checked = true;
      if (this.checked) {
        $li = $(' <text> </text> ');
        $li.text(this.value);
        $('.InpueValue2').append($li);
      }
      else {
        $('text:contains('+this.value+')', '.InpueValue2').remove();
      }
    });


    $('.HotelsDropDown input').change(function() {
      if (this.checked) {
        $li = $(' <text> </text> ');
        $li.text(this.value);
        $('.hostelValue').append($li);
      }
      else {
        $('text:contains('+this.value+')', '.hostelValue').remove();
      }
    });


    $('.LanguageDropDown input').change(function() {
      if (this.checked) {
        $li = $(' <text> </text> ');
        $li.text(this.value);
        $('.LangValue').append($li);
      }
      else {
        $('text:contains('+this.value+')', '.LangValue').remove();
      }
    });


    $('.CuisineDropDown input').change(function() {
      if (this.checked) {
        $li = $(' <text> </text> ');
        $li.text(this.value);
        $('.CuisineValue').append($li);
      }
      else {
        $('text:contains('+this.value+')', '.CuisineValue').remove();
      }
    });



    $('.TransporDropDown input').change(function() {
      if (this.checked) {
        $li = $(' <text> </text> ');
        $li.text(this.value);
        $('.TransportValue').append($li);
      }
      else {
        $('text:contains('+this.value+')', '.TransportValue').remove();
      }
    });

$(document).ready(function(){// check price
	<?php 
	$triger = (isset($_GET['triger'])) ? $_GET['triger'] : '';
	$triger = explode(",", $triger);
	if(count($triger)){
		foreach ($triger as $v) {
			if($v!=""){
				echo '$("#'.$v.'").trigger("click");';
			}
		}
	}
	?>
});

</script>