var Config = {
	website: "https://beetrip.ge/"
};

function currencySign(){
    var curActive = $(".currencyChangeActive").attr("data-curname");
    var html = "<span class=\"lari-symbol\">l</span>";
    switch(curActive){
        case 'usd':
            html = "$";
            break;
        case 'eur':
            html = "&euro;";
            break;
    }

    return html;
}

$('.DatePicker').datepicker({
	format: 'yyyy-mm-dd',
	ignoreReadonly: true,
	autoclose:true
});

$(document).on("click",".g-facebook-login", function(){
	var u = $(this).attr("data-url");
	location.href = u;
});

$(document).on("click",".toploginButtonTri", function(){
    var input_lang = $("#input_lang").val();
    var login = $(".top-login-email").val();
    var password = $(".top-login-password").val();

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"logintry", 
            top:true,
            input_lang:input_lang,               
            login:login,               
            password:password                 
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-top-login").html(obj.Error.Text).fadeIn();
        }else if(obj.Success.Code==1){
        	location.href = obj.Success.redirect;
        } 
    });
});

$(document).on("click", ".g-logout", function(){
	location.href = "/"+input_lang+"/home?logout=true";
});

$(document).on("click",".RegistrationButton", function(){
    var input_lang = $("#input_lang").val();
    var firstname = $(".first-name").val();
    var lastname = $(".last-name").val();
    var idnumber = $(".id-number").val();
    var birthday = $(".g-birthdate").val();
    var country = $(".g-country").val();
    var city = $(".g-city").val();
    var mobilenumber = $(".mobile-number").val();
    var email = $(".email-address").val();
    var password = $(".user-password").val();
    var passwordConfirm = $(".password-confirm").val();
    var capchacode = $(".captcha-code").val();
    var termsCondi = ($(".terms-conditions").is(':checked')) ? "true" : "false";

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"registernewuser", 
            input_lang:input_lang, 
            firstname:firstname,                  
            lastname:lastname,                  
            idnumber:idnumber,                  
            birthday:birthday,                  
            country:country,                  
            city:city,                  
            mobilenumber:mobilenumber,                  
            email:email,                  
            password:password,                  
            passwordConfirm:passwordConfirm,                  
            capchacode:capchacode,                  
            termsCondi:termsCondi                  
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $("#captcha").attr("src", "_modules/captcha/captchaImage.php");
            $(".g-message-registration-page").html(obj.Error.Text).fadeIn();
            $(".captcha-code").val('');
        }else{
        	$("#g-registration-form input").val('');
        	$(".g-message-registration-page").html(obj.Success.Text).fadeIn();
        }

        $(document).scrollTop(0);
        
    });
});


$(document).on("click", ".g-recover-password-button", function(){
    var input_lang = $("#input_lang").val();
    var email = $(".g-recover-email").val();
    var gErrorMessageHeader = $(this).attr("data-gErrorMessageHeader")
    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"recoverStepOne", 
            input_lang:input_lang, 
            email:email                 
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-top-recover-password").html(obj.Error.Text).fadeIn();
        }else{
            $("#password-recover-modal h5").text(gErrorMessageHeader);
            
            $(".g-recover-email").val('');
            $("#password-recover-modal .modal-body").html(obj.Success.Text).fadeIn();
            $("#password-recover-modal .modal-footer button").hide();
        }        
    });
});


$(document).on("click", ".g-recover-pass-final-button", function(){
    var input_lang = $("#input_lang").val();
    var password = $(".g-recover-page-password").val();
    var confirm = $(".g-recover-page-password-confirm").val();
    var code = $("#code").val();

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"recoverStepTwo", 
            input_lang:input_lang, 
            password:password,                 
            confirm:confirm, 
            code:code                
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-recover-page-password").html(obj.Error.Text).fadeIn();
        }else{
            $(".g-recover-page-password").val('');
            $(".g-recover-page-password-confirm").val('');
            $(".g-message-recover-page-password").html(obj.Success.Text).fadeIn();
            setTimeout(function(){
                location.href = "/"+input_lang+"/home";
            }, 2000);
        }        
    });
});

$(document).on("click", ".g-profile-button-update", function(){
    var input_lang = $("#input_lang").val();
    var password = $(".g-profile-password-update").val();
    var newpassword = $(".g-profile-newpassword-update").val();
    var passwordconfirm = $(".g-profile-passwordconfirm-update").val();

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"updatepassword", 
            input_lang:input_lang, 
            currentpassword:password,                 
            newpassword:newpassword, 
            comfirmpassword:passwordconfirm                
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-updateprofilepass").html(obj.Error.Text).fadeIn();
        }else{
            $(".g-profile-password-update").val('');
            $(".g-profile-newpassword-update").val('');
            $(".g-profile-passwordconfirm-update").val('');
            $(".g-message-updateprofilepass").html(obj.Success.Text).fadeIn();
            $(".g-visiablePassUpdate").hide();
        }        
    });
});

$(document).on("click", ".g-profileedit-button-update", function(){
    var input_lang = $("#input_lang").val();
    var firstname = $(".g-profile-firstname-update").val();
    var lastname = $(".g-profile-lastname-update").val();
    var idnumber = $(".g-profile-idnumber-update").val();
    var mobile = $(".g-profile-mobile-update").val();
    var birthdaydate = $(".g-profile-birthdaydate-update").val();
    var country = $(".g-profile-country-update").val();
    var city = $(".g-profile-city-update").val();

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"updateprofileinfo", 
            input_lang:input_lang, 
            firstname:firstname,                 
            lastname:lastname, 
            idnumber:idnumber, 
            mobile:mobile,
            birthdaydate:birthdaydate,                 
            country:country,                 
            city:city                 
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-updateprofileinfo").html(obj.Error.Text).fadeIn();
        }else{
            $(".g-message-updateprofileinfo").html(obj.Success.Text).fadeIn();
            setTimeout(function(){
                location.href = "/"+input_lang+"/profile";
            },1500);
        }        
    });
});

$(document).on("click", ".g-contact-send", function(){
    var input_lang = $("#input_lang").val();
    var entername = $(".g-contact-entername").val();
    var email = $(".g-contact-email").val();
    var subject = $(".g-contact-subject").val();
    var message = $(".g-contact-message").val();

    $(".g-message-contact").html("...").fadeIn();
    $('html, body').animate({
        scrollTop: 0
    }, 1000);

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"contactsendmail", 
            input_lang:input_lang, 
            entername:entername,                 
            email:email, 
            subject:subject, 
            message:message                
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            $(".g-message-contact").html(obj.Error.Text).fadeIn();
        }else{
           $(".g-contact-entername").val('');
           $(".g-contact-email").val('');
           $(".g-contact-subject").val('');
           $(".g-contact-message").val('');
           $(".g-message-contact").html(obj.Success.Text).fadeIn();
        }        
    });
});

$(document).on("click", ".profile-image-tag", function(){
    $("#profile-image").click();
});

$(document).on("change", "#profile-image", function(e){
    $("#profileimageform").click();
});


$(document).on("click", ".button-group--cart-action-button", function(){
    // var html = "";
    // var theTotalPrice = 0;
    // var ids = [];

    // $(".cart-table tbody tr").each(function(){
    //     var checkboxID = $("td:eq(5) .g-cart-item", this).attr("id");

    //     if(document.getElementById(checkboxID).checked){
    //         console.log(checkboxID);
    //         let title = $("td:eq(1)", this).text();
    //         let cid = $(this).attr('data-cid');
    //         let totalprice = parseFloat($("td:eq(2) .tdprice:eq(0)", this).text());
    //         // totalprice += parseFloat($("td:eq(2) .tdprice:eq(1)", this).text());
    //         let datex = $("td:eq(3) p:eq(0)", this).text();
    //         let timex = $("td:eq(3) p:eq(1)", this).text();

    //         theTotalPrice += parseFloat(totalprice);
    //         ids.push(cid);

    //         html += '<tr>';
    //         html += '<td>';
    //         html += title;
    //         html += '</td>';
    //         html += '<td>';
    //         html += parseFloat(totalprice);
    //         html += '</td>';
    //         html += '<td>';
    //         html += datex + " " + timex;
    //         html += '</td>';
    //         html += '</tr>';
    //     }
    // });


    // $(".payment-table--1").html(html);
    // $(".sum-price-block__price-val .theTotalPrice").html(theTotalPrice);
    // $("#itemstobuy").val(ids.join());

    $('html, body').animate({
        scrollTop: $(".payment-block").offset().top
    }, 1000);
});

$(document).on("click", ".button--payment-submit", function(){
    var input_lang = $("#input_lang").val();
    var company = $(".g-pay-company").val();
    var address = $(".g-pay-address").val();
    var id = $(".g-pay-id").val();
    var vat = $(".g-pay-vat").val();
    var gMessageHeader = $(this).attr("data-gMessageHeader");

    var notSelected = new Array();
    var Selected = new Array();
    $(".table-responsive table .cart-items").each(function(){
        let chk = $(".cart-item-select-control", this).prop("checked");
        let dtId = $(".cart-item-select-control", this).attr("data-id");
        if(!chk){
            notSelected.push(dtId);
        }else{
            Selected.push(dtId);
        }
    });
    $("#itemstobuy").val(Selected.join());
    var itemstobuy = $("#itemstobuy").val();

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"addInvoice", 
            input_lang:input_lang, 
            itemstobuy:itemstobuy, 
            company:company,                 
            address:address, 
            id:id, 
            vat:vat,
            notSelected:notSelected.join()               
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
           console.log(obj.Error.Text);
        }else{
           $(".g-pay-company").val('');
           $(".g-pay-address").val('');
           $(".g-pay-id").val('');
           $(".g-pay-vat").val('');
           
          $("#cart-message-modal").modal("show");
          setTimeout(function(){
            location.href = "/"+input_lang+"/profile";
          }, 2000);
        }        
    });
});

$(document).on("click", ".g-myorder", function(){
    var input_lang = $("#input_lang").val();
    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"loadorders", 
            input_lang:input_lang                
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
           console.log(obj.Error.Text);
        }else{
            console.log("success");
           $("#cart-orders-modal").modal("show");
        }        
    });
});


$(document).on("click", ".g-pickup-button", function(){
    var doubleway = $(this).attr("data-doubleway");
    var modaltitle = $(this).attr("data-modaltitle");
    var pick1 = $(this).attr("data-pick1");
    var pick2 = $(this).attr("data-pick2");
    var cartid = $(this).attr("data-cartid");
    var pickplacevalue1 = $(this).attr("data-pickplacevalue1");
    var pickplacevalue2 = $(this).attr("data-pickplacevalue2");
    $("#pick1").val(pickplacevalue1);
    $("#pick2").val(pickplacevalue2);

    $("#g-pickplace-modal").modal("show");
    $("#g-pickplace-modal .modal-dialog .modal-content").css("min-height", "auto");
    $("#g-pickplace-modal .modal-dialog .modal-content .modal-header .modal-title").html(modaltitle);
    $("#pick1").attr("placeholder", pick1);
    $("#g-pickplace-modal-footer button").attr("data-cartid", cartid);
    if(doubleway=="true"){
        $("#pick2").attr("placeholder", pick2).show();
    }else{
        $("#pick2").attr("placeholder", pick2).hide();
    }
    // $("#g-message-modal .modal-body").html(doubleway);
    console.log(doubleway);
});

$(document).on("click", "#g-pickplace-modal-footer button", function(){
    var input_lang = $("#input_lang").val();
    var cartid = $(this).attr("data-cartid");

    var pick1 = $("#pick1").val();
    var pick2 = $("#pick2").val();
    $("#r"+cartid+" .g-pickup-button").attr("data-pickplacevalue1", pick1);
    $("#r"+cartid+" .g-pickup-button").attr("data-pickplacevalue2", pick2);

    $(".pph"+cartid).text(pick1);
    $(".pph2"+cartid).text(pick2);

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"insertpickupplace", 
            input_lang:input_lang,               
            cartid:cartid,               
            pick1:pick1,                 
            pick2:pick2                 
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            console.log(obj.Error.Text);
        }else if(obj.Success.Code==1){
            console.log(obj.Success.Text);
        } 
    });
    $("#g-pickplace-modal").modal("hide");
});


$(document).on("click", "#g-new-show-box", function(){
    var opened = $(this).attr("data-opened");
    
    if(opened=="false"){
        $("#g-new-timepickbox").show();
        $(this).attr("data-opened", "true");
    }else{
        $("#g-new-timepickbox").hide();
        $(this).attr("data-opened", "false");
    }
});

$(document).on("click", "#g-new-show-box2", function(){
    var opened = $(this).attr("data-opened");
    
    if(opened=="false"){
        $("#g-new-timepickbox2").show();
        $(this).attr("data-opened", "true");
    }else{
        $("#g-new-timepickbox2").hide();
        $(this).attr("data-opened", "false");
    }
});


$(document).on("click", ".currencyChange", function(){
    var cur = $(this).attr("data-curname");
    var input_lang = $("#input_lang").val();
    

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"currencyChange", 
            input_lang:input_lang,               
            cur:cur                
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){
            console.log(obj.Error.Text);
        }else if(obj.Success.Code==1){
            location.reload();
        } 
    });
});

Date.prototype.yyyymmdd = function() {
  var mm = this.getMonth() + 1;
  var dd = this.getDate();

  return [
      (dd>9 ? '' : '0') + dd + "-",
      (mm>9 ? '' : '0') + mm + "-",
      this.getFullYear()
  ].join('');
};


var g_countOngoingTour = function(crew, price_sedan, guest_sedan, price_minivan, price_minibus, price_bus, tour_margin, child_ages, cuisune, ticket, hotel, guide, tour_income_margin=null, productPrices){
    var perprice = 0;
    var totalprice = 0;
    var cuisune_price = 0;
    var ticket_price = 0;

    var sedanMax = productPrices.sedan.p_ongoing_max_crowd;
    var vanMax = productPrices.minivan.p_ongoing_max_crowd;
    var miniBusMax = productPrices.minibus.p_ongoing_max_crowd;
    var busMax = productPrices.bus.p_ongoing_max_crowd;

    var totalCrew = parseInt(crew) + parseInt($("#gg_children_612").val()) + parseInt($("#gg_children_05").val());
    
    // console.log(productPrices.sedan.p_ongoing_max_crowd);
    var outTotalPrice = 0;
    /* new count start */
    if(totalCrew<=sedanMax){// sedan
        if(totalCrew<=guest_sedan){// crew <= admin user sedan 
            var bepx = Math.ceil((price_sedan * tour_margin) / 100); 
            outTotalPrice = price_sedan - bepx;
        }else{
            outTotalPrice = price_sedan;
        }
    }else if(totalCrew>sedanMax && totalCrew<=vanMax){//minivan
        outTotalPrice = price_minivan;
    }else if(totalCrew>vanMax && totalCrew<=miniBusMax){//minibus
        outTotalPrice = price_minibus;
    }else if(totalCrew>miniBusMax){// bus
        var howManyBusNeed = Math.ceil(totalCrew / busMax);
        outTotalPrice = price_bus * howManyBusNeed;
    }
    /* new count end */



    /* additional info start */
    let adults = parseInt(crew);
    let child6 = parseInt($("#gg_children_612").val());
    let child0 = parseInt($("#gg_children_05").val());
    var aditionalprice = guide;
    // adult prices
    aditionalprice += (hotel * adults);
    aditionalprice += (cuisune * adults);
    aditionalprice += (ticket * adults);
    // child 6-12 prices
    aditionalprice += ((hotel / 2) * child6);
    aditionalprice += ((cuisune / 2) * child6);
    aditionalprice += ((ticket / 2) * child6); 

    
    // child 0-5
    // free
    /* additional info end */

    /* change additional service prices START*/
    let hotelPrice = 0;
    hotelPrice += (hotel * adults);
    hotelPrice += ((hotel / 2) * child6);
    
    let cuisunePrice = 0;
    cuisunePrice += (cuisune * adults);
    cuisunePrice += ((cuisune / 2) * child6); 
    
    let ticketPrice = 0;
    ticketPrice += (ticket * adults);
    ticketPrice += ((ticket / 2) * child6);
    
    // $("#hotelPrice__").html(totalCrew+"x");
    // $("#cuisunePrice__").html(totalCrew+"x");
    // $("#ticketPrice__").html(totalCrew+"x");
    // $("#gidi__").html(totalCrew+"x");

    
    // $("#hotelPrice").attr("data-gelprice",hotelPrice);
    // $("#cuisunePrice").attr("data-gelprice",cuisunePrice);
    // $("#ticketPrice").attr("data-gelprice",ticketPrice);
    var usd = parseFloat($("#g-cur-exchange-usd").val());
    var eur = parseFloat($("#g-cur-exchange-eur").val());
    var exchange_cur = 1;
    var cur = " <span class='lari-symbol'>l</span>";

    if($("#g-cur__").val()=="usd"){
        exchange_cur = usd; 
        cur = " $";
    }else if($("#g-cur__").val()=="eur"){
        exchange_cur = eur; 
        cur = " &euro;";
    }

    console.log(exchange_cur);


    // $("#hotelPrice").html(Math.round(hotelPrice / exchange_cur)+cur);
    // $("#cuisunePrice").html(Math.round(cuisunePrice / exchange_cur)+cur);
    // $("#ticketPrice").html(Math.round(ticketPrice / exchange_cur)+cur);
    /* change additional service prices END*/
    
    var theTotalPriceForPerPerson = parseInt((outTotalPrice + aditionalprice) / totalCrew);
    var theTotapPrice = parseInt(outTotalPrice + aditionalprice);



    // console.log(theTotalPriceForPerPerson + " -" + tour_income_margin+"-");

    var incomePricePerPerson = 0;
    var incomePrice = 0;
    if(tour_income_margin!=null && tour_income_margin!="" && !isNaN(tour_income_margin)){
        tour_income_margin=parseInt(tour_income_margin);
        incomePricePerPerson = Math.round(theTotalPriceForPerPerson * tour_income_margin / 100);
        incomePrice = Math.round(theTotapPrice * tour_income_margin / 100);
    }

    // $("#packageprice").attr("data-gelprice", (theTotalPriceForPerPerson + incomePricePerPerson));
    // $("#packageprice").html(Math.round((theTotalPriceForPerPerson + incomePricePerPerson) / exchange_cur)+cur);
    $(".gelprice").attr("data-gelprice", Math.round(theTotapPrice + incomePrice));
    $(".gelprice").html(Math.round((theTotapPrice + incomePrice) / exchange_cur)+cur);

    // $(".QuantityButton").attr("disabled", false);
};

$(document).on("click", ".g-addCart", function(e){
    var redirectToCart = ($(this).attr("data-redirect") === "true");
    var input_lang = $("#input_lang").val();
    var id = $(this).attr("data-id");
    var title = $(this).attr("data-title");
    var errorText = $(this).attr("data-errortext");

    var guestNuber = parseInt($('#gg-adults').val());    
    var childrenunder = parseInt($("#gg_children_05").val());
    var children = parseInt($("#gg_children_612").val());
    

    var insurance123 = 1;
    var g_insuarance_damzgvevi = "";
    var g_insuarance_dazgveuli = "";
    var g_insuarance_misamarti = "";
    var g_insuarance_dabtarigi = "";
    var g_insuarance_pasporti = "";
    var g_insuarance_piradinomeri = "";
    var g_insuarance_telefonis = "";
    var CSRF_token = $('#CSRF_token').val();

    // if($(this).hasClass("active")){
    //     $(this).removeClass("active");
    // }else{
    //     $(this).addClass("active");
    // }

    var dd = $(".DatePicker2").val().split("-");
    var inside = dd[2]+"-"+(dd[1]>9 ? '' : '0')+dd[1]+"-"+(dd[0]>9 ? '' : '0')+dd[0];


    var tra = "sedan";

    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"updateCart", 
            input_lang:input_lang, 
            guestNuber:guestNuber, 
            children:children,
            childrenunder:childrenunder,
            id:id,
            insurance123:insurance123, 
            g_insuarance_damzgvevi:g_insuarance_damzgvevi,
            g_insuarance_dazgveuli:g_insuarance_dazgveuli, 
            g_insuarance_misamarti:g_insuarance_misamarti,
            g_insuarance_dabtarigi:g_insuarance_dabtarigi,
            g_insuarance_pasporti:g_insuarance_pasporti,
            g_insuarance_piradinomeri:g_insuarance_piradinomeri,
            g_insuarance_telefonis:g_insuarance_telefonis,
            inside:inside, 
            tra:tra,
            token:CSRF_token         
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){   
            $('#ErrorModal .modal-dialog .modal-body .Title').text(title);
            $('#ErrorModal .modal-dialog .modal-body .Text').text(obj.Error.Text);
            $('#ErrorModal').modal('show');
        }else{
            if(!redirectToCart){
                if($(".addCart[data-redirect='true']").hasClass("g-visiable-button")){
                    $(".addCart[data-redirect='true']").removeClass("g-visiable-button");
                    $(".addCart[data-redirect='true']").fadeOut();
                }else{
                    $(".addCart[data-redirect='true']").addClass("g-visiable-button");
                    $(".addCart[data-redirect='true']").fadeIn();
                }

                $('#SuccessModal .modal-dialog .modal-body .Title').text(title);
                $('#SuccessModal .modal-dialog .modal-body .Text').text(obj.Success.Text);
                $('#SuccessModal').modal('show');
            }else{
                location.href = "/"+input_lang+"/cart";
            }
        }
        $(".HeaderCardIcon span").text(obj.Success.countCartitem);
    });

});