$(function () {

    var agreeConditionsControl = $(".agree-conditions-control");
    var buttonRegister = $(".button--register");

    agreeConditionsControl.change(function () {
       if($(this).is(":checked")) {
           buttonRegister.removeAttr("disabled");
       } else {
           buttonRegister.attr("disabled", "disabled");
       }
    });

});