jQuery(document).ready(function ($) {
    $(".hotspot").on("click", function (e) {
        e.stopPropagation();
        $(".hotspot-popup").hide();
        $(this).find(".hotspot-popup").toggle();
    });

    $(document).on("click", function () {
        $(".hotspot-popup").hide();
    });

    $(".hotspot-popup").on("click", function (e) {
        e.stopPropagation();
    });
});
