function transition_to($new_page) {
    // Fade out the current page
    $('#current-page').fadeOut(500);

    // Load the new page
    $.ajax({
        url: $new_page,
        success: function(data) {
            // Fade in the new page
            $(data).fadeIn(500);
        }
    });
}