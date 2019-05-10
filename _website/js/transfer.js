var Config = {
    website: "https://beetrip.ge/"
};

var map2 = "";
function doublemap(){
    var myLatLng = {lat: 41.705171, lng: 44.876335}; 
    map2 = new google.maps.Map(document.getElementById('SidebarSmallMap2'), {
        zoom: 6,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();

    directionsDisplay.setMap(map2);
    directionsDisplay.setOptions({ 
        polylineOptions: {
            strokeColor: "#020303"
        }, 
        suppressMarkers: true 
    });

    $('.g-startingplace2').change(function() {
        changeStartOrEndPlace2(directionsService, google, directionsDisplay);
    });

    $('.g-endingplace2').change(function() {
        changeStartOrEndPlace2(directionsService, google, directionsDisplay);
    });
}

var map = "";
function initMap() {
    var myLatLng = {lat: 41.705171, lng: 44.876335};    
    map = new google.maps.Map(document.getElementById('SidebarSmallMap'), {
        zoom: 6,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();

    directionsDisplay.setMap(map);
    directionsDisplay.setOptions({ 
        polylineOptions: {
            strokeColor: "#020303"
        }, 
        suppressMarkers: true 
    });

    $('.g-startingplace').change(function() {
        changeStartOrEndPlace(directionsService, google, directionsDisplay);
    });

    $('.g-endingplace').change(function() {
        changeStartOrEndPlace(directionsService, google, directionsDisplay);
    });    
}

function g_change_transport(){
    var numberofpeople = parseInt($(".g-numberofpeople").val());
    numberofpeople += parseInt($(".g-under-child").val());
    numberofpeople += parseInt($(".g-child").val());
    //remove checked
    $(".g-sedan").prop("checked", false);
    $(".g-minivan").prop("checked", false);
    $(".g-bus").prop("checked", false);

    if(numberofpeople<=3){
        $(".g-sedan").prop("checked", true);
    }else if(numberofpeople>=4 && numberofpeople<=6){
        $(".g-minivan").prop("checked", true);
    }else if(numberofpeople>=7 && numberofpeople<=15){
        $(".g-minibus").prop("checked", true);
    }else if(numberofpeople>=16){
        $(".g-bus").prop("checked", true);
    }

    countPriceTransport();
}

function g_change_transport2(){
    var numberofpeople = parseInt($(".g-numberofpeople2").val());
    numberofpeople += parseInt($(".g-under-child2").val());
    numberofpeople += parseInt($(".g-child2").val());
    //remove checked
    $(".g-sedan2").prop("checked", false);
    $(".g-minivan2").prop("checked", false);
    $(".g-bus2").prop("checked", false);

    if(numberofpeople<=3){
        $(".g-sedan2").prop("checked", true);
    }else if(numberofpeople>=4 && numberofpeople<=6){
        $(".g-minivan2").prop("checked", true);
    }else if(numberofpeople>=7 && numberofpeople<=15){
        $(".g-minibus2").prop("checked", true);
    }else if(numberofpeople>=16){
        $(".g-bus2").prop("checked", true);
    }

    countPriceTransport2();
}

function changeStartOrEndPlace(directionsService, google, directionsDisplay){
    var startingplace = $('.g-startingplace').val();
    var endingplace = $('.g-endingplace').val();
    if(startingplace!="" && endingplace!=""){
        var start = $('.g-startingplace option:selected').attr("data-map").split(",");
        var end = $('.g-endingplace option:selected').attr("data-map").split(",");

        var waypts = [];
        waypts.push({
            location: new google.maps.LatLng(start[0], start[1]),
            stopover: true
        });

        waypts.push({
            location: new google.maps.LatLng(end[0], end[1]),
            stopover: true
        });

        updateMapDir(waypts, directionsService, google, directionsDisplay);
    }
}

function changeStartOrEndPlace2(directionsService, google, directionsDisplay){
    var startingplace = $('.g-startingplace2').val();
    var endingplace = $('.g-endingplace2').val();
    if(startingplace!="" && endingplace!=""){
        var start = $('.g-startingplace2 option:selected').attr("data-map").split(",");
        var end = $('.g-endingplace2 option:selected').attr("data-map").split(",");

        var waypts = [];
        waypts.push({
            location: new google.maps.LatLng(start[0], start[1]),
            stopover: true
        });

        waypts.push({
            location: new google.maps.LatLng(end[0], end[1]),
            stopover: true
        });

        updateMapDir2(waypts, directionsService, google, directionsDisplay);
    }
}

function countPriceTransport(){
    var km = parseFloat($("#km").val());

    var guest = parseInt($(".g-numberofpeople").val());
    var numberofchildren612 = parseInt($(".g-child").val());
    var numberofchildren05 = parseInt($(".g-under-child").val());
    var totalCrew = guest + numberofchildren612 + numberofchildren05;

    var sedanMaxPass = transferPrices.sedan.t_max_passanger;
    var minivanMaxPass = transferPrices.minivan.t_max_passanger;
    var minibusMaxPass = transferPrices.minibus.t_max_passanger;
    var busMaxPass = transferPrices.bus.t_max_passanger;

    var transport_price_per_km_sedan = 0;
    var transport_price_per_km_minivan = 0;
    var transport_price_per_km_minibus = 0;
    var transport_price_per_km_bus = 0;

    var howManySedan = Math.ceil(totalCrew / sedanMaxPass);
    var howManyMinivan = Math.ceil(totalCrew / minivanMaxPass);
    var howManyMinibus = Math.ceil(totalCrew / minibusMaxPass);
    var howManyBus = Math.ceil(totalCrew / busMaxPass);

    if(km<=49){
        transport_price_per_km_sedan = transferPrices.sedan.t_0_50;
        transport_price_per_km_minivan = transferPrices.minivan.t_0_50;
        transport_price_per_km_minibus = transferPrices.minibus.t_0_50;
        transport_price_per_km_bus = transferPrices.bus.t_0_50;
    }else if(km<=99){
        transport_price_per_km_sedan = transferPrices.sedan.t_50_100;
        transport_price_per_km_minivan = transferPrices.minivan.t_50_100;
        transport_price_per_km_minibus = transferPrices.minibus.t_50_100;
        transport_price_per_km_bus = transferPrices.bus.t_50_100;
    }else if(km<=149){
        transport_price_per_km_sedan = transferPrices.sedan.t_100_150;
        transport_price_per_km_minivan = transferPrices.minivan.t_100_150;
        transport_price_per_km_minibus = transferPrices.minibus.t_100_150;
        transport_price_per_km_bus = transferPrices.bus.t_100_150;
    }else if(km<=199){
        transport_price_per_km_sedan = transferPrices.sedan.t_150_200;
        transport_price_per_km_minivan = transferPrices.minivan.t_150_200;
        transport_price_per_km_minibus = transferPrices.minibus.t_150_200;
        transport_price_per_km_bus = transferPrices.bus.t_150_200;
    }else if(km<=249){
        transport_price_per_km_sedan = transferPrices.sedan.t_200_250;
        transport_price_per_km_minivan = transferPrices.minivan.t_200_250;
        transport_price_per_km_minibus = transferPrices.minibus.t_200_250;
        transport_price_per_km_bus = transferPrices.bus.t_200_250;
    }else if(km<=299){
        transport_price_per_km_sedan = transferPrices.sedan.t_250_300;
        transport_price_per_km_minivan = transferPrices.minivan.t_250_300;
        transport_price_per_km_minibus = transferPrices.minibus.t_250_300;
        transport_price_per_km_bus = transferPrices.bus.t_250_300;
    }else if(km<=349){
        transport_price_per_km_sedan = transferPrices.sedan.t_300_350;
        transport_price_per_km_minivan = transferPrices.minivan.t_300_350;
        transport_price_per_km_minibus = transferPrices.minibus.t_300_350;
        transport_price_per_km_bus = transferPrices.bus.t_300_350;
    }else if(km<=399){
        transport_price_per_km_sedan = transferPrices.sedan.t_350_400;
        transport_price_per_km_minivan = transferPrices.minivan.t_350_400;
        transport_price_per_km_minibus = transferPrices.minibus.t_350_400;
        transport_price_per_km_bus = transferPrices.bus.t_350_400;
    }else if(km>=400){
        transport_price_per_km_sedan = transferPrices.sedan.t_400_plus;
        transport_price_per_km_minivan = transferPrices.minivan.t_400_plus;
        transport_price_per_km_minibus = transferPrices.minibus.t_400_plus;
        transport_price_per_km_bus = transferPrices.bus.t_400_plus;
    }

    var ten = 0;
    ten += parseInt($(".g-startingplace option:selected").attr("data-plus"));
    ten += parseInt($(".g-endingplace option:selected").attr("data-plus"));
    ten = ten*10;

    var totalprice_sedan = ((km * transport_price_per_km_sedan) * howManySedan) + ten;
    totalprice_sedan = (isNaN(totalprice_sedan)) ? 0 : totalprice_sedan;
    
    var totalprice_minivan = ((km * transport_price_per_km_minivan) * howManyMinivan) + ten;
    totalprice_minivan = (isNaN(totalprice_minivan)) ? 0 : totalprice_minivan;

    var totalprice_minibus = ((km * transport_price_per_km_minibus) * howManyMinibus) + ten;
    totalprice_minibus = (isNaN(totalprice_minibus)) ? 0 : totalprice_minibus;
    
    var totalprice_bus = ((km * transport_price_per_km_bus) * howManyBus) + ten;
    totalprice_bus = (isNaN(totalprice_bus)) ? 0 : totalprice_bus;

    
    var curActive = parseFloat($(".currencyChangeActive").attr("data-cur"));

    $(".g-sedan-price").html(parseInt(Math.round(totalprice_sedan / curActive)) + " "+currencySign());
    $(".g-minivan-price").html(parseInt(Math.round(totalprice_minivan / curActive) ) + " "+currencySign());
    $(".g-minibus-price").html(parseInt(Math.round(totalprice_minibus / curActive) ) + " "+currencySign());
    $(".g-bus-price").html(parseInt(Math.round(totalprice_bus / curActive)) + " "+currencySign());
}

function countPriceTransport2(){
    var km = parseFloat($("#km2").val());

    var guest = parseInt($(".g-numberofpeople2").val());
    var numberofchildren612 = parseInt($(".g-child2").val());
    var numberofchildren05 = parseInt($(".g-under-child2").val());
    var totalCrew = guest + numberofchildren612 + numberofchildren05;

    var sedanMaxPass = transferPrices.sedan.t_max_passanger;
    var minivanMaxPass = transferPrices.minivan.t_max_passanger;
    var minibusMaxPass = transferPrices.minibus.t_max_passanger;
    var busMaxPass = transferPrices.bus.t_max_passanger;

    var transport_price_per_km_sedan = 0;
    var transport_price_per_km_minivan = 0;
    var transport_price_per_km_minibus = 0;
    var transport_price_per_km_bus = 0;

    var howManySedan = Math.ceil(totalCrew / sedanMaxPass);
    var howManyMinivan = Math.ceil(totalCrew / minivanMaxPass);
    var howManyMinibus = Math.ceil(totalCrew / minibusMaxPass);
    var howManyBus = Math.ceil(totalCrew / busMaxPass);

    if(km<=49){
        transport_price_per_km_sedan = transferPrices.sedan.t_0_50;
        transport_price_per_km_minivan = transferPrices.minivan.t_0_50;
        transport_price_per_km_minibus = transferPrices.minibus.t_0_50;
        transport_price_per_km_bus = transferPrices.bus.t_0_50;
    }else if(km<=99){
        transport_price_per_km_sedan = transferPrices.sedan.t_50_100;
        transport_price_per_km_minivan = transferPrices.minivan.t_50_100;
        transport_price_per_km_minibus = transferPrices.minibus.t_50_100;
        transport_price_per_km_bus = transferPrices.bus.t_50_100;
    }else if(km<=149){
        transport_price_per_km_sedan = transferPrices.sedan.t_100_150;
        transport_price_per_km_minivan = transferPrices.minivan.t_100_150;
        transport_price_per_km_minibus = transferPrices.minibus.t_100_150;
        transport_price_per_km_bus = transferPrices.bus.t_100_150;
    }else if(km<=199){
        transport_price_per_km_sedan = transferPrices.sedan.t_150_200;
        transport_price_per_km_minivan = transferPrices.minivan.t_150_200;
        transport_price_per_km_minibus = transferPrices.minibus.t_150_200;
        transport_price_per_km_bus = transferPrices.bus.t_150_200;
    }else if(km<=249){
        transport_price_per_km_sedan = transferPrices.sedan.t_200_250;
        transport_price_per_km_minivan = transferPrices.minivan.t_200_250;
        transport_price_per_km_minibus = transferPrices.minibus.t_200_250;
        transport_price_per_km_bus = transferPrices.bus.t_200_250;
    }else if(km<=299){
        transport_price_per_km_sedan = transferPrices.sedan.t_250_300;
        transport_price_per_km_minivan = transferPrices.minivan.t_250_300;
        transport_price_per_km_minibus = transferPrices.minibus.t_250_300;
        transport_price_per_km_bus = transferPrices.bus.t_250_300;
    }else if(km<=349){
        transport_price_per_km_sedan = transferPrices.sedan.t_300_350;
        transport_price_per_km_minivan = transferPrices.minivan.t_300_350;
        transport_price_per_km_minibus = transferPrices.minibus.t_300_350;
        transport_price_per_km_bus = transferPrices.bus.t_300_350;
    }else if(km<=399){
        transport_price_per_km_sedan = transferPrices.sedan.t_350_400;
        transport_price_per_km_minivan = transferPrices.minivan.t_350_400;
        transport_price_per_km_minibus = transferPrices.minibus.t_350_400;
        transport_price_per_km_bus = transferPrices.bus.t_350_400;
    }else if(km>=400){
        transport_price_per_km_sedan = transferPrices.sedan.t_400_plus;
        transport_price_per_km_minivan = transferPrices.minivan.t_400_plus;
        transport_price_per_km_minibus = transferPrices.minibus.t_400_plus;
        transport_price_per_km_bus = transferPrices.bus.t_400_plus;
    }

    var ten = 0;
    ten += parseInt($(".g-startingplace2 option:selected").attr("data-plus"));
    ten += parseInt($(".g-endingplace2 option:selected").attr("data-plus"));
    ten = ten*10;

    var totalprice_sedan = ((km * transport_price_per_km_sedan) * howManySedan) + ten;
    totalprice_sedan = (isNaN(totalprice_sedan)) ? 0 : totalprice_sedan;

    var totalprice_minivan = ((km * transport_price_per_km_minivan) * howManyMinivan) + ten;
    totalprice_minivan = (isNaN(totalprice_minivan)) ? 0 : totalprice_minivan;

    var totalprice_minibus = ((km * transport_price_per_km_minibus) * howManyMinibus) + ten;
    totalprice_minibus = (isNaN(totalprice_minibus)) ? 0 : totalprice_minibus;

    var totalprice_bus = ((km * transport_price_per_km_bus) * howManyBus) + ten;
    totalprice_bus = (isNaN(totalprice_bus)) ? 0 : totalprice_bus;

    var curActive = parseFloat($(".currencyChangeActive").attr("data-cur"));

    //g-datepicker
    //g-datepicker2
    var firstFromPlace = parseInt($(".g-startingplace").val());
    var secondFromPlace = parseInt($(".g-endingplace").val());
    var thirdFromPlace = parseInt($(".g-startingplace2").val());
    var fourFromPlace = parseInt($(".g-endingplace2").val());

    var ex1 = $(".g-datepicker").val().split("-");
    var ex2 = $(".g-datepicker2").val().split("-");

    var year = ex1[2];
    var month = (ex1[1].length<=1) ? "0"+ex1[1] : ex1[1];
    var day = (ex1[0].length<=1) ? "0"+ex1[0] : ex1[0];

    var year2 = ex2[2];
    var month2 = (ex2[1].length<=1) ? "0"+ex2[1] : ex2[1];
    var day2 = (ex2[0].length<=1) ? "0"+ex2[0] : ex2[0];

    var firstFullDate = year + "-" + month + "-" + day;
    var secondFullDate = year2 + "-" + month2 + "-" + day2;

    //same way back discount
    if(firstFromPlace==fourFromPlace && secondFromPlace==thirdFromPlace && firstFullDate==secondFullDate){
        totalprice_sedan = totalprice_sedan - ((totalprice_sedan*transferPrices.sedan.samewaydiscount2) / 100);
        totalprice_minivan = totalprice_minivan - ((totalprice_minivan*transferPrices.minivan.samewaydiscount2) / 100);
        totalprice_minibus = totalprice_minibus - ((totalprice_minibus*transferPrices.minibus.samewaydiscount2) / 100);
        totalprice_bus = totalprice_bus - ((totalprice_bus*transferPrices.bus.samewaydiscount2) / 100);
    }

    $(".g-sedan-price2").html(parseInt(Math.round(totalprice_sedan / curActive)) + " "+currencySign());
    $(".g-minivan-price2").html(parseInt(Math.round(totalprice_minivan / curActive) ) + " "+currencySign());
    $(".g-minibus-price2").html(parseInt(Math.round(totalprice_minibus / curActive) ) + " "+currencySign());
    $(".g-bus-price2").html(parseInt(Math.round(totalprice_bus / curActive)) + " "+currencySign());
}

function updateMapDir(waypts, directionsService, google, directionsDisplay){
    var start = waypts[0];  
    var end = waypts[1];

    var request = {
        origin: start.location, 
        destination: end.location,
        travelMode: 'DRIVING',
        waypoints: waypts,
        optimizeWaypoints: true
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var km = 0;
            for(var i=0; i<response.routes[0].legs.length; i++){
                km += parseFloat(response.routes[0].legs[i].distance.value) / 1000;
            }
            $("#km").val(parseFloat(km));
            countPriceTransport();
        }
    });
}

function updateMapDir2(waypts, directionsService, google, directionsDisplay){
    var start = waypts[0];  
    var end = waypts[1];

    var request = {
        origin: start.location, 
        destination: end.location,
        travelMode: 'DRIVING',
        waypoints: waypts,
        optimizeWaypoints: true
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var km = 0;
            for(var i=0; i<response.routes[0].legs.length; i++){
                km += parseFloat(response.routes[0].legs[i].distance.value) / 1000;
            }
            $("#km2").val(parseFloat(km));
            countPriceTransport2();
        }
    });
}


$(function () {
    var transferForm = $(".transfer-form");
    var transferFormButtons1 = $(".transfer-form__buttons-1");
    var transferFormButtons2 = $(".transfer-form__buttons-2");
    var buttonWayToggle = $(".button--way-toggle");
    var buttonWayToggleText;
    var buttonOrder = $(".button--order");
    var transferFormControlsDoubleWay = $(".transfer-form__controls--hidden");

    buttonWayToggle.click(function () {

        setTimeout(function(){
            var gt2 = {
                upHour: $("#g-uphour2"),
                upMinute: $("#g-upminute2"),
                downHour: $("#g-downhour2"),
                downMinute: $("#g-downminute2"),
                inputHour: $("#g-new-hour2"),
                inputMinute: $("#g-new-minute2"),
                fullTimeBox: $("#g-new-time2"),
                hiddenFullTimeBox: $("#g-timepicker2")
            };
            gTimePicker(gt2);
        }, 1500);

        if(! transferForm.hasClass("transfer-form--double-way")) {
            transferForm.addClass("transfer-form--double-way");
            transferFormControlsDoubleWay.clone().removeClass("transfer-form__controls--hidden").insertBefore(".transfer-form__buttons-2");
            transferFormButtons2.removeClass("transfer-form__buttons--hidden");
            transferFormButtons2.append(buttonOrder);
            buttonWayToggleText = $(this).data("text-single-way");
            $(this).html(buttonWayToggleText)

            fixDatePicker();
            fixTimePicker();
            fixQuantity();

            $(".g-firstmap").removeClass("col-lg-12").addClass("col-lg-6");
            $(".g-secondmap").show();
            doublemap();

            setTimeout(function(){
                var firstV = $(".g-startingplace").val();
                var secondV = $(".g-endingplace").val();

                $(".g-startingplace2").val(secondV).trigger("change");
                $(".g-endingplace2").val(firstV).trigger("change");
            }, 1000);

        } else {

            transferForm.removeClass("transfer-form--double-way");
            transferForm.find(".transfer-form__controls--double-way").remove();
            transferFormButtons1.append(buttonOrder);
            transferFormButtons2.addClass("transfer-form__buttons--hidden");
            buttonWayToggleText = $(this).data("text-double-way");
            $(this).html(buttonWayToggleText); 

            $(".g-firstmap").removeClass("col-lg-6").addClass("col-lg-12");
            $(".g-secondmap").hide();
        }
    });

    function fixDatePicker() {

        $(".hasDatepicker").removeClass("hasDatepicker");
        var dateToday = new Date();
        dateToday.setDate(dateToday.getDate()+2);

        var date2 = $('.g-datepicker').datepicker('getDate'); 
        // date2.setDate(date2.getDate()+1); 
         
        var nextDay = date2.getDate()+"-"+(date2.getMonth()+1)+"-"+date2.getFullYear();
        $(".g-datepicker2").val(nextDay);
        $(".g-datepicker2").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: dateToday, 
            beforeShow: function(input, inst) {
                $("#ui-datepicker-div").addClass("ui-datepicker--calendar");
            },
            onClose: function(input, inst) {
                $("#ui-datepicker-div").css("display", "none");
                $("#ui-datepicker-div").removeClass("ui-datepicker--calendar");
            }
        });

    }

    function fixTimePicker() {
        $(".timepicker").timepicker({
            dateFormat: "dd-mm-yy",
            beforeShow: function(input, inst) {
                $("#ui-datepicker-div").addClass("ui-datepicker--time");
            },
            onClose: function(input, inst) {
                $("#ui-datepicker-div").css("display", "none");
                $("#ui-datepicker-div").removeClass("ui-datepicker--time");
            }
        });
    }

    function fixQuantity() {
        jQuery('<div class="quantity-button quantity-up"></div><div class="quantity-button quantity-down"></div>').insertAfter('.quantity2 input');
        jQuery('.quantity2').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                let oldValue = parseInt(input.val());

                console.log(oldValue+" test");
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                g_change_transport2();
            });

            btnDown.click(function() {
                let oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                g_change_transport2();
            });

        });
    }


});


$(document).on("click",".g-order-button", function(){
    var km = $("#km").val();
    var km2 = $("#km2").val();
    var input_lang = $("#input_lang").val();
    var startingplace = $(".g-startingplace").val();
    var startplace2 = (typeof $(".g-startingplace2").val() !== "undefined") ? $(".g-startingplace2").val() : '';
    var endingplace = $(".g-endingplace").val();
    var endplace2 = (typeof $(".g-endingplace2").val() !== "undefined") ? $(".g-endingplace2").val() : '';
    var datepicker = $(".g-datepicker").val();
    var startdatetrans2 = (typeof $(".g-datepicker2").val() !== "undefined") ? $(".g-datepicker2").val() : '';
    var timepicker = $(".g-timepicker").val();
    var timeTrans2 = (typeof $(".g-timepicker2").val() !== "undefined") ? $(".g-timepicker2").val() : '';
    var numberofpeople = $(".g-numberofpeople").val();
    var numberofchildren612 = parseInt($(".g-child").val());
    var numberofchildren05 = parseInt($(".g-under-child").val());

    var guestnumber2 = (typeof $(".g-numberofpeople2").val() !== "undefined") ? $(".g-numberofpeople2").val() : '';
    var numberofchildren612_ = parseInt($(".g-child2").val());
    var numberofchildren05_ = parseInt($(".g-under-child2").val());

    var TransporDropDownId = $(".g-transporDropDownId:checked").attr("data-id");
    var TransporDropDownId2 = (typeof $(".g-transporDropDownId2:checked").attr("data-id") !== "undefined") ? $(".g-transporDropDownId2:checked").attr("data-id") : '';
    
    var messageheader = $(this).attr("data-messageheader");
    var datatype = $(this).attr("data-type");

    var ten1 = 0;
    ten1 += parseInt($(".g-startingplace option:selected").attr("data-plus"));
    ten1 += parseInt($(".g-endingplace option:selected").attr("data-plus"));
    ten1 = ten1*10;

    var ten2 = 0;
    ten2 += parseInt($(".g-startingplace2 option:selected").attr("data-plus"));
    ten2 += parseInt($(".g-endingplace2 option:selected").attr("data-plus"));
    ten2 = ten2*10;

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"insertTransCart", 
            input_lang:input_lang, 
            startplace:startingplace,                  
            endplace:endingplace,                  
            startdatetrans:datepicker,                  
            timeTrans:timepicker,                  
            guestnumber:numberofpeople,  
            numberofchildren612:numberofchildren612,                
            numberofchildren05:numberofchildren05,                
            TransporDropDownId:TransporDropDownId,  
            km:km,                
            startplace2:startplace2,                  
            endplace2:endplace2,                  
            startdatetrans2:startdatetrans2,                  
            timeTrans2:timeTrans2,                  
            guestnumber2:guestnumber2, 
            numberofchildren612_:numberofchildren612_,                
            numberofchildren05_:numberofchildren05_,                 
            TransporDropDownId2:TransporDropDownId2,
            km2:km2,                 
            ten1:ten1,                 
            ten2:ten2                 
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-modal-icon").removeClass("notification-icon--done").addClass("notification-icon--error");
            $(".g-modal-text").text(obj.Error.Text); 
            $(document).scrollTop(0);  
            $("#transfer-notification-modal").modal("show"); 
        }else{
            if(datatype=="order"){
                location.href = "/"+input_lang+"/cart";
            }else{
                $(".g-modal-icon").removeClass("notification-icon--error").addClass("notification-icon--done");
                $("#transfer-notification-modal h6").text(messageheader); 
                $(".g-modal-text").text(obj.Success.Text); 
                $("#transfer-notification-modal").modal("show");  
            }
        }  
    });
});

/* new feacher */
function gTimePicker(gt){

    gt.inputHour.on('keyup input', function(){
        let hValue = parseInt($(this).val());
        let mValue = parseInt(gt.inputMinute.val());

        let newValue = 0;
        if(hValue<=23){
            newValue = hValue;
        }else{
            newValue = "00";
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof mValue === "number" && mValue<10){
            mValue = "0"+mValue;
        }
        
        gt.fullTimeBox.html(newValue+" : "+mValue);   
        gt.hiddenFullTimeBox.val(newValue+":"+mValue).trigger('change');
    });

    gt.inputMinute.on('keyup input', function(){
        let hValue = parseInt(gt.inputHour.val());
        let mValue = parseInt($(this).val());

        let newValue = 0;
        if(mValue<=59){
            newValue = mValue;
        }else{
            newValue = "00";
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof hValue === "number" && hValue<10){
            hValue = "0"+hValue;
        }
        
        gt.fullTimeBox.html(hValue+" : "+newValue);   
        gt.hiddenFullTimeBox.val(hValue+":"+newValue).trigger('change');
    });

    gt.upHour.click(function(){

        let hValue = parseInt(gt.inputHour.val());
        let mValue = parseInt(gt.inputMinute.val());

        let newValue = 0;
        if(hValue<23){
            newValue = hValue + 1;
        }else{
            newValue = "00";
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof mValue === "number" && mValue<10){
            mValue = "0"+mValue;
        }

        gt.inputHour.val(newValue);
        gt.fullTimeBox.html(newValue+" : "+mValue);   
        gt.hiddenFullTimeBox.val(newValue+":"+mValue).trigger('change');   
    });

    gt.downHour.click(function(){
        let hValue = parseInt(gt.inputHour.val());
        let mValue = parseInt(gt.inputMinute.val());

        let newValue = 0;
        if(hValue>0){
            newValue = hValue - 1;
        }else{
            newValue = 23;
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof mValue === "number" && mValue<10){
            mValue = "0"+mValue;
        }

        gt.inputHour.val(newValue);
        gt.fullTimeBox.html(newValue+" : "+mValue);   
        gt.hiddenFullTimeBox.val(newValue+":"+mValue).trigger('change');   
    });

    gt.upMinute.click(function(){
        let hValue = parseInt(gt.inputHour.val());
        let mValue = parseInt(gt.inputMinute.val());

        let newValue = 0;
        if(mValue<59){
            newValue = mValue + 1;
        }else{
            newValue = "00";
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof hValue === "number" && hValue<10){
            hValue = "0"+hValue;
        }

        gt.inputMinute.val(newValue);
        gt.fullTimeBox.html(hValue+" : "+newValue);   
        gt.hiddenFullTimeBox.val(hValue+":"+newValue).trigger('change');   
    });

    gt.downMinute.click(function(){
        let hValue = parseInt(gt.inputHour.val());
        let mValue = parseInt(gt.inputMinute.val());

        let newValue = 0;
        if(mValue>0){
            newValue = mValue - 1;
        }else{
            newValue = 59;
        }  

        if(typeof newValue === "number" && newValue<10){
            newValue = "0"+newValue;
        }

        if(typeof hValue === "number" && hValue<10){
            hValue = "0"+hValue;
        }

        gt.inputMinute.val(newValue);
        gt.fullTimeBox.html(hValue+" : "+newValue);   
        gt.hiddenFullTimeBox.val(hValue+":"+newValue).trigger('change');   
    });
}


function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

$(document).ready(function(){
    setTimeout(function(){
        let url_string = window.location.href;
        let url = new URL(url_string);
        let startPlace = parseInt(url.searchParams.get("s"));
        let endPlace = parseInt(url.searchParams.get("e"));
        let startPlace2 = parseInt(url.searchParams.get("s2"));
        let endPlace2 = parseInt(url.searchParams.get("e2"));
        let gdatepicker = htmlEntities(url.searchParams.get("gd"));
        let gtimepicker = htmlEntities(url.searchParams.get("gt"));
        let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
        let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

        let adult = parseInt(url.searchParams.get("ad"));
        let baby = parseInt(url.searchParams.get("ba"));
        let child = parseInt(url.searchParams.get("ch"));

        let adult2 = parseInt(url.searchParams.get("ad2"));
        let baby2 = parseInt(url.searchParams.get("ba2"));
        let child2 = parseInt(url.searchParams.get("ch2"));
        if(!isNaN(startPlace)){ $(".g-startingplace").val(startPlace); }
        if(!isNaN(endPlace)){ $(".g-endingplace").val(endPlace).change(); }
        if(gdatepicker!=="null"){ $(".g-datepicker").val(gdatepicker); }

        if(!isNaN(adult)){ $(".g-numberofpeople").val(adult); }
        if(!isNaN(baby)){ $(".g-under-child").val(baby); }
        if(!isNaN(child)){ $(".g-child").val(child).trigger("change"); }

        g_change_transport();
        
        if(gtimepicker !== "null"){
            let splitHour = gtimepicker.split(":");            
            if(typeof splitHour[0] !== "undefined" && typeof splitHour[1] !== "undefined"){
                $("#g-new-hour").val(splitHour[0]);
                $("#g-new-minute").val(splitHour[1]).change();
                $("#g-new-time").html(splitHour[0] + " : " + splitHour[1]);
            }
        }


        if(!isNaN(startPlace2)){
            $(".button--way-toggle").click();
            setTimeout(function(){
                $(".g-startingplace2").val(startPlace2);
                if(!isNaN(endPlace2)){
                    $(".g-endingplace2").val(endPlace2).change();
                }
                if(gdatepicker2!=="null"){
                    $(".g-datepicker2").val(gdatepicker2);
                }

                if(gtimepicker2!=="null"){
                    let splitHour2 = gtimepicker2.split(":");
                    if(typeof splitHour2[0] !== "undefined" && typeof splitHour2[1] !== "undefined"){
                        $("#g-new-hour2").val(splitHour2[0]);
                        $("#g-new-minute2").val(splitHour2[1]).change();
                        $("#g-new-time2").html(splitHour2[0] + " : " + splitHour2[1]);
                    }
                }

                if(!isNaN(adult2)){ $(".g-numberofpeople2").val(adult2); }
                if(!isNaN(baby2)){ $(".g-under-child2").val(baby2); }
                if(!isNaN(child2)){ $(".g-child2").val(child2).trigger("change"); }

                g_change_transport2();

            }, 1000);
        }        

    }, 1500);
});

$(document).on("change", ".g-startingplace", function(e){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+val+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);

    $(".g-endingplace option").removeAttr('disabled');
    $(".g-endingplace option[value='"+val+"']").attr('disabled','disabled');
    
    
});

$(document).on("change", ".g-endingplace", function(e){
    var val = $(this).val();

    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+val+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);    

    $(".g-startingplace option").removeAttr('disabled');
    $(".g-startingplace option[value='"+val+"']").attr('disabled','disabled');
});


$(document).on("change", ".g-startingplace2", function(e){
    var val = $(this).val();

    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+val+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);    

    $(".g-endingplace2 option").removeAttr('disabled');
    $(".g-endingplace2 option[value='"+val+"']").attr('disabled','disabled');
});

$(document).on("change", ".g-endingplace2", function(e){
    var val = $(this).val();

    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));
    

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+val+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
    

    $(".g-startingplace2 option").removeAttr('disabled');
    $(".g-startingplace2 option[value='"+val+"']").attr('disabled','disabled');
});


$(document).on("change", ".g-datepicker", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    countPriceTransport2();

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+val+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});

$(document).on("change", "#g-timepicker", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+val+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});


$(document).on("change", ".g-datepicker2", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    countPriceTransport2();

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+val+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});

$(document).on("change", "#g-timepicker2", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+val+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});


$(document).on("change", ".g-numberofpeople", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+val+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});

$(document).on("change", ".g-under-child", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+val+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});

$(document).on("change", ".g-child", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+val+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});


$(document).on("change", ".g-numberofpeople2", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+val+"&ba2="+baby2+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});


$(document).on("change", ".g-under-child2", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+val+"&ch2="+child2;
    window.history.pushState('', '', urlToGo);
});

$(document).on("change", ".g-child2", function(){
    let val = $(this).val();
    
    let lang = $("#input_lang").val();
    let url_string = window.location.href;
    let url = new URL(url_string);
    let startPlace = url.searchParams.get("s");
    let endPlace = url.searchParams.get("e")
    let startPlace2 = url.searchParams.get("s2");
    let endPlace2 = url.searchParams.get("e2");
    let gdatepicker = htmlEntities(url.searchParams.get("gd"));
    let gtimepicker = htmlEntities(url.searchParams.get("gt"));

    let gdatepicker2 = htmlEntities(url.searchParams.get("gd2"));
    let gtimepicker2 = htmlEntities(url.searchParams.get("gt2"));

    let adult = parseInt(url.searchParams.get("ad"));
    let baby = parseInt(url.searchParams.get("ba"));
    let child = parseInt(url.searchParams.get("ch"));

    let adult2 = parseInt(url.searchParams.get("ad2"));
    let baby2 = parseInt(url.searchParams.get("ba2"));
    let child2 = parseInt(url.searchParams.get("ch2"));

    let urlToGo = "/"+lang+"/transfers?s="+startPlace+"&e="+endPlace+"&s2="+startPlace2+"&e2="+endPlace2+"&gd="+gdatepicker+"&gt="+gtimepicker+"&gd2="+gdatepicker2+"&gt2="+gtimepicker2+"&ad="+adult+"&ba="+baby+"&ch="+child+"&ad2="+adult2+"&ba2="+baby2+"&ch2="+val;
    window.history.pushState('', '', urlToGo);
});
