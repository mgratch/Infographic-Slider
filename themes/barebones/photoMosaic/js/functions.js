jQuery(document).ready(function($) {
    $('#target').photoMosaic({
        // input examples
        input: 'html',
        width: 'auto',
        height: 400,
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
        numImagesToPreload: 4,
        controlNavigation: 'none',
        autoScaleSlider: false,
        imageScaleMode:'none',
        imageAlignCenter: !1,
        arrowsNavAutoHide: false,
        navigateByClick: false,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: false,
        slidesSpacing: 0,
        allowCSS3: false,
        minSlideOffset:0,
        imageScalePadding: 0,
        deeplinking: {
            // deep linking options go gere
            enabled: true,
            change: true,
            prefix: 'slide-'
        }
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
        var nav = $(this).find('.rsBullets');
        $(this).after(nav);
    });
    if(window.location.href.slice(-1) == "2") {
        $("#theirStorySlider").royalSlider({
            // options go here
            // as an example, enable keyboard arrows nav
            slidesOrientation: 'horizontal',
            autoScaleSlider: false,
            controlNavigation: 'none',
            imageScaleMode: 'none',
            imageAlignCenter: !1,
            navigateByClick: false,
            sliderTouch: false,
            sliderDrag: false,
            fadeinLoadedSlide: false,
            slidesSpacing: 0,
            allowCSS3: false,
            minSlideOffset:0,
            imageScalePadding: 0,
            startSlideId:1
        });
        var theirSlider = $("#theirStorySlider").data('royalSlider');
        $("#herStory a.more-link").on('click',function(e){
            e.preventDefault();
            theirSlider.goTo(0);
        });
        $("#hisStory a.more-link").on('click',function(e){
            e.preventDefault();
            theirSlider.goTo(2);
        });
        $("#herFullStoryRow a.go-back").on('click',function(e){
            e.preventDefault();
            theirSlider.goTo(1);
        });
        $("#hisFullStoryRow .go-back").on('click',function(e){
            e.preventDefault();
            theirSlider.goTo(1);
        });
        var slider = $('#theirStorySlider');
        var rsContent = $(slider).find('.rsContent');
        $(rsContent).each(function() {
            $(this).addClass('normalize');
        });
    }
});