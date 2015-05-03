jQuery(document).ready(function($) {
    var $ = jQuery;
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

    $("#theirStorySlider").royalSlider({
        // options go here
        // as an example, enable keyboard arrows nav
        slidesOrientation: 'horizontal',
        controlNavigation: 'none',
        autoScaleSlider: false,
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

    $("#venueSlider").royalSlider({
        // options go here
        // as an example, enable keyboard arrows nav
        slidesOrientation: 'horizontal',
        controlNavigation: 'none',
        autoScaleSlider: false,
        imageScaleMode: 'none',
        imageAlignCenter: !1,
        navigateByClick: false,
        sliderTouch: false,
        sliderDrag: false,
        fadeinLoadedSlide: false,
        slidesSpacing: 0,
        allowCSS3: false,
        minSlideOffset:0,
        imageScalePadding: 0
    });

    /*
    var venueSlider = $("#venueSlider").data('royalSlider');
    var button = $("#ourVenueStory a.go-back");

    console.log(button);

    $(button).on('click',function(e){
        alert("prevented");
    });
    */
});
jQuery(window).load(function(){
    var $ = jQuery;

    var boxOneHeight = jQuery("#herStory .leftSide").outerHeight();
    var boxTwoHeight = jQuery("#hisStory .rightSide").outerHeight();
    var currHeight = jQuery("#theirStorySlider .rsOverflow").outerHeight();
    var slideHeight = jQuery("#herFullStory").outerHeight();
    var theirSlider = $("#theirStorySlider").data('royalSlider');
    var hisSlideHeight = jQuery("#hisFullStory").outerHeight();

    var s = $("a.go-back");
    var pos = s.position();
    var stickermax = $(document).outerHeight() - s.outerHeight() - 40; //40 value is the total of the top and bottom margin
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        s.html("Distance from top:" + pos.top + "<br />Scroll position: " + windowpos);
        if (windowpos >= pos.top && windowpos < stickermax) {
            s.attr("style", ""); //kill absolute positioning
            s.addClass("stick"); //stick it
        } else if (windowpos >= stickermax) {
            s.removeClass(); //un-stick
            s.css({position: "absolute", top: stickermax + "px"}); //set sticker right above the footer

        } else {
            s.removeClass(); //top of page
        }
    });

    if (jQuery(window).width() < jQuery(window).height()){
        theirSlider.ev.on('rsAfterContentSet', function(event) {
            jQuery("#theirStorySlider .rsOverflow").animate({
                height: (boxOneHeight + boxTwoHeight + 25)});
        });
    }
    else {
        theirSlider.ev.on('rsAfterContentSet', function(event) {
            jQuery("#theirStorySlider .rsOverflow").animate({
                height: (boxOneHeight + 25)});
        });
    }

    $("#herStory a.more-link").on('click',function(e){
        e.preventDefault();
        if (slideHeight > currHeight){
            theirSlider.ev.on('rsBeforeMove', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(slideHeight + 25);
            });
        }
        theirSlider.goTo(0);
    });
    $("#hisStory a.more-link").on('click',function(e){
        e.preventDefault();
        if (hisSlideHeight > currHeight){
            theirSlider.ev.on('rsBeforeMove', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(hisSlideHeight + 25);
            });
        }
        theirSlider.goTo(2);
    });
    $("#herFullStoryRow a.go-back").on('click',function(e){
        e.preventDefault();
        if (jQuery(window).width() < jQuery(window).height()){
            theirSlider.ev.on('rsBeforeMove', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(boxOneHeight + boxTwoHeight + 25);
            });
        }
        else {
            theirSlider.ev.on('rsAfterContentSet', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(boxOneHeight + 25);
            });
        }
        theirSlider.goTo(1);
    });
    $("#hisFullStoryRow .go-back").on('click',function(e){
        e.preventDefault();
        if (jQuery(window).width() < jQuery(window).height()){
            theirSlider.ev.on('rsBeforeMove', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(boxOneHeight + boxTwoHeight + 25);
            });
        }
        else {
            theirSlider.ev.on('rsAfterContentSet', function(event) {
                jQuery('html, body').animate({ scrollTop: $("#theirStorySlider").offset().top });
                jQuery("#theirStorySlider .rsOverflow").height(boxOneHeight + 25);
            });
        }
        theirSlider.goTo(1);
    });
});