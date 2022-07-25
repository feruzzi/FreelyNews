$(document).ready(function () {
    // $(".view-menu").on("click", function (e) {
    //     $(".menu-content").fadeToggle(800, "linear");
    // });
    $(".menu-nav").on("click", function (e) {
        if ($(".menu-nav").val() == "view") {
            alert($(".menu-nav").val());
            $(".menu-content").removeClass("menu-hide");
            $(".menu-nav").val("hide");
            $(".menu-icon-container").addClass("cross");
        } else {
            alert($(".menu-nav").val());
            $(".menu-content").addClass("menu-hide");
            $(".menu-nav").val("view");
            $(".menu-icon-container").removeClass("cross");
        }
    });
    // $(".menu-nav").on("click", function (e) {
    //     $(".menu-content").addClass("d-none");
    //     $(".hide-menu").addClass("view-menu");
    //     $(".hide-menu").removeClass("hide-menu");
    // });
});
