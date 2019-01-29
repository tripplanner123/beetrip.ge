$(function () {
    var dateToday = new Date();
    $(".datepicker").datepicker({
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

});