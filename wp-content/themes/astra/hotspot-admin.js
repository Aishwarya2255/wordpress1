jQuery(document).ready(function($) {
    $(".hotspot_marker").click(function(event) {
        $(".hotspot-popup").remove(); // Remove existing popups
        
        let title = $(this).data("title");
        let description = $(this).data("description");
        let price = $(this).data("price");
        let imageUrl = $(this).data("image");
        let link = $(this).data("link");

        let popup = $('<div class="hotspot-popup"></div>');
        popup.append('<h4>' + title + '</h4>');
        if (imageUrl) {
            popup.append('<img src="' + imageUrl + '" />');
        }
        popup.append('<p>' + description + '</p>');
        if (price) {
            popup.append('<strong>Price: ' + price + '</strong>');
        }
        popup.append('<a href="' + link + '" target="_blank">Buy Now</a>');

        $("body").append(popup);
        popup.css({
            top: event.pageY + 10 + "px",
            left: event.pageX + 10 + "px"
        }).fadeIn();
    });

    $(document).on("click", function(event) {
        if (!$(event.target).closest(".hotspot_marker, .hotspot-popup").length) {
            $(".hotspot-popup").fadeOut(function() {
                $(this).remove();
            });
        }
    });
});
