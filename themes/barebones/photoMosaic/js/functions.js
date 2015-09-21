jQuery(document).ready(function($) {
    var img_count = $("#target img").length;
    if (img_count < 25){
        var height = 400;
    }
    else {
        var height = 'auto';
    }
    $('#target').photoMosaic({
        // input examples
        input: 'html',
        width: 'auto',
        height: height,
        columns: 'auto',
        padding: 10,
        order: 'masonry',
        lazyload: false,
        prevent_crop: false,
        // lightbox settings
        modal_name : 'prettyPhoto',
        modal_ready_callback: function($pm) {
            $('a[rel^="prettyPhoto"]', $pm).prettyPhoto({
                overlay_gallery: false,
                slideshow: false,
                theme: "pp_default",
                deeplinking: false,
                social_tools: "",
                show_title: false
            });
        }
    });
});
