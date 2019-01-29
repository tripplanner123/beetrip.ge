$(function () {

    // clone site menu to sideBar
    $(".menu").clone().removeClass("menu--header").addClass("menu--side-bar").appendTo(".side-bar");

    // side bar
    var body = $("body");
    var sideBarOverlay = $(".side-bar-overlay");
    var sideBar = $(".side-bar");
    var sideBarClose = $(".side-bar__close");
    var sideBarToggle = $(".side-bar-toggle");

    sideBarOverlay.click(function () {
        sideBarHide();
    });

    sideBarClose.click(function (e) {
        e.preventDefault();

        sideBarHide();
    });

    sideBarToggle.click(function (e) {
        e.preventDefault();

        sideBarShow();
    });

    function sideBarShow() {
        body.addClass("overflow-y-before-lg-hidden");
        sideBarOverlay.addClass("active");
        sideBar.addClass("active");
    }

    function sideBarHide() {
        body.removeClass("overflow-y-before-lg-hidden");
        sideBarOverlay.removeClass("active");
        sideBar.removeClass("active");
    }

    // Footer List accordion
    var footerListItemsToggle =  $(".footer__list-items-toggle");
    var footerListItem = $(".footer__list-item");
    var selectedfooterListItems;

    footerListItemsToggle.click(function () {

        if(! checkResolutionLowThen992()) {
            return;
        }

        footerListItem.removeClass("footer__list-item--show-before-lg");

        if(! checkFooterListItemsToggleActive($(this))) {
            footerListItemsToggle.removeClass("footer__list-items-toggle--active");
            $(this).addClass("footer__list-items-toggle--active");
            selectedfooterListItems = $(this).closest(".footer__list").find(".footer__list-item");
            selectedfooterListItems.addClass("footer__list-item--show-before-lg");
        } else {
            footerListItemsToggle.removeClass("footer__list-items-toggle--active");
        }

    });

    function checkFooterListItemsToggleActive(el) {
        return !!(el.hasClass("footer__list-items-toggle--active"));
    }

    // Check resolution < 992
    function checkResolutionLowThen992() {
        return ($(window).outerWidth() < 992);
    }

});