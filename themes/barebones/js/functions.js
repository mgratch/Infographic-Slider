jQuery( function( $ ) {
    $( '#herStoryContent .more-link' ).on( 'click', function ( e ) {
        e.preventDefault();
        $.ajax( {
            url: '/wp-json/posts?type=her_story&filter[post_type]=publish&filter[posts_per_page]=1',
            success: function ( data ) {
                var post = data.shift(); // The data is an array of posts. Grab the first one.
                $('#herFullStory .go-back').before( '<span id="herFullStory-data">'+post.content+'</span>' );
            },
            cache: true
        } );
    });
    $( '#hisStoryContent .more-link' ).on( 'click', function ( e ) {
        e.preventDefault();
        $.ajax( {
            url: '/wp-json/posts?type=his_story&filter[post_type]=publish&filter[posts_per_page]=1',
            success: function ( data ) {
                var post = data.shift(); // The data is an array of posts. Grab the first one.
                $('#hisFullStory .go-back').before( '<span id="hisFullStory-data">'+post.content+'</span>' );
            },
            cache: true
        } );
    });
});