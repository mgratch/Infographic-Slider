jQuery(document).ready(function($) {
    $('#target').photoMosaic({
        // input examples
        input: 'html',
        width: 'auto',
        columns: 'auto',
        padding: 10,
        order: 'masonry',
        lazyload: 100,
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
    $("#mainSlider").royalSlider({
        // options go here
        // as an example, enable keyboard arrows nav
        slidesOrientation: 'vertical',
        autoScaleSlider: false,
        autoHeight: false,
        imageScaleMode:'none',
        imageAlignCenter: !1,
        arrowsNavAutoHide: false,
        navigateByClick: false,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: false
    });
    var sliderInstance = $('.royalSlider').data('royalSlider');
    $('.royalSlider').on('mousewheel', function(e, delta, deltaX, deltaY) {
        if (delta < 0) {
            sliderInstance.next();
        } else if (delta > 0) {
            sliderInstance.prev();
        }
    });
    $(document).off('keydown.rskb').on('keyup.rskb', function(e) {
        if (e.keyCode === 38) {
            e.preventDefault();
            sliderInstance.prev();
        } else if (e.keyCode === 40) {
            e.preventDefault();
            sliderInstance.next();
        }
    });
    var slider = $('.royalSlider');
    $(slider).each(function() {
        var slider = this;
        var nav = $(this).find('.rsNav');
        $(this).after(nav);
    });
});