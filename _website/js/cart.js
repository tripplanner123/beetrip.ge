var Config = {
    website: "https://beetrip.ge/"
};

function gRemove(){
    var input_lang = $("#input_lang").val();
    var deleteArray = new Array(); 

    $(".g-cart-item").each(function(){
        if($(this).is(':checked')){
            var id = $(this).attr("data-id");
            deleteArray.push(id);
            $("#r"+id).fadeOut();
        }
    });
    
    var id = deleteArray.join();
    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"removeCartItem", 
            input_lang:input_lang, 
            id:id          
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){            
            console.log(obj.Error.Text);
        }else{
            console.log(obj.Success.Text);
            location.reload();
        }
    });
}

$(function () {

    var cartItemSelectControl = $(".cart-item-select-control");
    var cartActionButton = $(".bgcab");
    var buttonBuy = $(".button--buy");
    var paymentBlock = $(".payment-block");
    var deleteButton = $(".g-cart-delete-button");
    var cartItemCheckboxs = $(".g-cart-item");
    var input_lang = $("#input_lang").val();
    var tabpaymethod = $("#pay-method-2-tab");
    var paywithcreditcard = $(".g-pay-with-creditcard");

    cartItemSelectControl.change(function () {
        if($(".cart-item-select-control:checked").length > 0) {

            var ch = $("#siterules").prop("checked");
    
            if(ch){
                cartActionButton.removeAttr("disabled");
            }
            
        } else {
            cartActionButton.attr("disabled", "disabled");
            paymentBlock.addClass("payment-block--hidden");
        }
    });

    tabpaymethod.click(function(){
        $(".tab-content").slideDown();
    });

    paywithcreditcard.click(function(){
        var input_lang = $("#input_lang").val();
        var urlToGo = $(this).attr("data-href");
        var notSelected = new Array();
        var itemstobuy = new Array();
        $(".table-responsive table .cart-items").each(function(){
            let chk = $(".cart-item-select-control", this).prop("checked");
            let dtId = $(".cart-item-select-control", this).attr("data-id");
            if(!chk){
                notSelected.push(dtId);
            }else{
                itemstobuy.push(dtId);
            }
        });

        $.ajax({
            type: "POST",
            url: Config.website+input_lang+"/?ajax=true",
            data: { 
                type:"cartItemNotReady", 
                input_lang:input_lang, 
                notready:notSelected.join(),          
                itemstobuy:itemstobuy.join()          
            } 
        }).done(function( msg ) {
            var obj = $.parseJSON(msg);
            if(obj.Error.Code==1){            
                console.log(obj.Error.Text);
            }else{
                console.log(obj.Success.Text);
                location.href = urlToGo;
            }
        });
    });

    buttonBuy.click(function () {
        var tb = "";
        var totalPriceTopay = 0;
        var curActive = parseFloat($(".currencyChangeActive").attr("data-cur"));
        $(".table-responsive table .cart-items").each(function(){
            let chk = $(".cart-item-select-control", this).prop("checked");
            if(chk){
                let title = $(this).attr("data-title");
                let title2 = $(this).attr("data-title2");
                let cid = $(this).attr("data-cid");
                let transportname1 = $(this).attr("data-transportname1");
                let transportname2 = $(this).attr("data-transportname2");
                let numberofpessingers1 = $(this).attr("data-numberofpessingers1");
                let numberofpessingers2 = $(this).attr("data-numberofpessingers2");
                let price = $(this).attr("data-price");
                let price1 = parseInt($(this).attr("data-price1"));
                let price2 = parseInt($(this).attr("data-price2"));
                let date1 = $(this).attr("data-date1");
                let date2 = $(this).attr("data-date2");

                totalPriceTopay += price1;
                totalPriceTopay += price2;

                
                

                tb += "<tr>";
                
                tb += "<td>"+title;
                if(price2>0){
                    tb += "<br>"+title2;
                }
                tb += "</td>";


                tb += "<td>"+date1;
                if(price2>0){
                    tb += "<br>"+date2;
                }
                tb += "</td>";


                tb += "<td>"+parseInt(Math.round(price1 / curActive))+ " "+currencySign();
                if(price2>0){
                    tb += "<br>"+parseInt(Math.round(price2 / curActive))+ " "+currencySign();
                }
                tb += "</td>";
                tb += "</tr>";
            }
        });

        $(".payment-table--1").html(tb);
        $(".theTotalPrice").html(parseInt(Math.round(totalPriceTopay / curActive)));
        paymentBlock.removeClass("payment-block--hidden");
    });


    deleteButton.click(function(){     

        $("#g-message-modal-footer .gremoveButton").attr("onclick", "gRemove()");      
        $("#g-message-modal").modal("show"); 

    });

    var link = document.getElementsByClassName("g-cart");
    link[0].className += " active";

});

$(document).on("change", "#siterules", function(){
    var input_lang = $("#input_lang").val();
    var ch = $(this).prop("checked");
    var x = false;
    var siterules = "";
    $(".cart-item-select-control").each(function(){
        if($(this).prop("checked")){
            x=true;
        }
    });

    if(ch && x){
        siterules = "checked";
        $(".bgcab").removeAttr("disabled");
    }else{
        siterules = "unchecked";
        $(".bgcab").attr("disabled","disabled");
    }


    $.ajax({
        type: "POST",
        url: Config.website+input_lang+"/?ajax=true",
        data: { 
            type:"changeSiteRules", 
            input_lang:input_lang, 
            siterules:siterules          
        } 
    }).done(function( msg ) {
        var obj = $.parseJSON(msg);
        if(obj.Error.Code==1){            
            console.log(obj.Error.Text);
        }else{
            console.log(obj.Success.Text);
        }
    });
});
