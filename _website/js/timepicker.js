$(function () {

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

});