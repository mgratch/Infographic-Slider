var count = 0;
var delete_buttons = [];
var dom = {
    uploads: jQuery( "#gform_preview_1_1" )
};
(function($) {
    function showImagePreview( file ) {
        var target = "#"+file.id;
        var item = $( "<li></li>" ).prependTo( target );
        var title = $(target).find("strong").html();
        //$(target).find("strong").remove();
        var image = $( new Image() ).appendTo( item );
        var pic_form = $( '<div class="image-meta-form"><label class="setting sr-only" data-setting="title">' +
            '<span class="name">Title</span>' +
            '</label>' +
            '<input placeholder="title" name="title" type="text" value="'+title+'">' +
            '<label class="setting sr-only" data-setting="description">' +
            '<span class="name">Description</span>' +
            '</label>' +
            '<textarea placeholder="description" name="description"></textarea></div>' ).appendTo( target );
        var preloader = new mOxie.Image();
        preloader.onload = function() {
            preloader.downsize( 128, 128 );
            image.prop( "src", preloader.getAsDataURL() );
        };
        preloader.load( file.getSource() );
        $(image).on("click", function(){
            $.each($(".ginput_preview"),function(){
               $(this).removeClass("active");
            });
           $(this).parents(".ginput_preview").addClass("active");
        });
    }
    $(document).bind('gform_post_render', function(){
        function handlePluploadFilesAdded( uploader,files ) {
            for ( var i = 0 ; i < files.length ; i++ ) {
                if ($("#"+files[i].id).children('li').length == 0){
                    console.log($("#"+files[i].id).children('li').length);
                    showImagePreview( files[ i ] );
                }
            }
        }
        gfMultiFileUploader.uploaders.gform_multifile_upload_1_1.bind('UploadComplete', handlePluploadFilesAdded);
        gfMultiFileUploader.uploaders.gform_multifile_upload_1_1.bind('UploadComplete',function() {
            delete_buttons = $(".gform_delete");
            count = delete_buttons.length;
            $("#input_1_2").val(count).change();
            $.each(delete_buttons, function() {
                this.addEventListener("click", handler);
                function handler(e){
                    e.target.removeEventListener(e.type, arguments.callee);
                    count = $(".gform_delete").length;
                    $("#input_1_2").val(count).change();
                }
                $(this).appendTo($(this).prev("li"));
                $(this).parents('.ginput_preview').css('visibility','visible');
            });
        });
        var submit_button = $("#gform_submit_button_1");
        submit_button[0].addEventListener("click", handler);
        function handler(e){
            e.target.removeEventListener(e.type, arguments.callee);
            //e.preventDefault();
            var items = [];
            var i = 0;
            $.each($(".ginput_preview"), function(){
                var item = {};
                item.id = $(this).find("strong").html();
                item.title = $(this).find("input").val();
                item.desc = $(this).find("textarea").val();
                items[i] = item;
                i++;
            });
            $("#input_1_3").val(JSON.stringify(items));
        }
    });
    $(document).bind('gform_confirmation_loaded', function(event, formId){
        var options = $('#target').data('photoMosaic').opts;
        $('#target').removeData('photoMosaic').empty();
        $.ajax( {
            url: '/wp-json/posts?type=our_story&filter[post_type]=publish&filter[name]=our-story',
            success: function ( data ) {
                var post = data.shift(); // The data is an array of posts. Grab the first one.
                $('#target').html(post.content);
                $('#target').photoMosaic(options)
            },
            cache: false
        } );
    });
})(jQuery);