var smWindowToggle = 0;
window.RS_DATA = window.RS_DATA || {};

jQuery(document).ready(function($) {
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var h = document.getElementById("mainSlider").clientHeight;
    var h1 = document.getElementById("herImageCol").clientHeight;
    var h2 = document.getElementById("textCol").clientHeight;
    var finalH = h - h1 - h2 - 20;

    var contents = $('#target');
    if (w < 801){
        $(contents).hide();
        $.ajax( {
            url: '/wp-json/posts?type=our_story&filter[post_type]=publish&filter[name]=smaller-gallery',
            success: function ( data ) {
                var post = data.shift(); // The data is an array of posts. Grab the first one.
                $(contents).hide();
                $('#gallery-container').append(post.content);
                $("#new-royalslider-1").royalSlider(RS_DATA);
            },
            cache: true
        } );
        smWindowToggle = 1;
    }
    $(
        '<style>' +
            '@media (max-width:991px) {' +
                    '#homeRow #textCol:after{ ' +
                    'height: ' + finalH + 'px !important;' +
                    'bottom: -'+ finalH +'px' +
                ' }' +
            ' }' +
        '</style>').appendTo('head');
});
jQuery(window).resize(function( $ ) {
    //do something
    var $ = jQuery;
    var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var h = document.getElementById("mainSlider").clientHeight;
    var h1 = document.getElementById("herImageCol").clientHeight;
    var h2 = document.getElementById("textCol").clientHeight;
    var finalH = h - h1 - h2 - 20;

    var contents = $('#target');

    var width = $(document).width();
    if (width <= 800 && smWindowToggle == 0) {
        $.ajax( {
            url: '/wp-json/posts?type=our_story&filter[post_type]=publish&filter[name]=smaller-gallery',
            success: function ( data ) {
                var post = data.shift(); // The data is an array of posts. Grab the first one.
                $(contents).hide();
                $('#gallery-container').append(post.content);
                $("#new-royalslider-1").royalSlider(RS_DATA);
            },
            cache: true
        } );
        smWindowToggle = 1;
    }
    else if (width <= 800 && smWindowToggle == 1){
        $(contents).hide();
        $("#new-royalslider-1").show();
    }
    else if (width > 800) {
        $("#new-royalslider-1").hide();
        $(contents).show();
    }
    $(
        '<style>' +
        '@media (max-width:991px) {' +
        '#homeRow #textCol:after{ ' +
        'height: ' + finalH + 'px !important;' +
        'bottom: -'+ finalH +'px' +
        ' }' +
        ' }' +
        '</style>').appendTo('head');
});