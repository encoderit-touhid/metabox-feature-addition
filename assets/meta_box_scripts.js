(function( $ ) {
	'use strict';
    var preSelectedImages = $("#_custom_product_gallery").val();
    $('#custom_product_gallery_button').click(function(e) {
       
        e.preventDefault();
        var isMultiple = false;
        if($(this).attr('is-multiple') == "1"){
            isMultiple = true;
        }
        if((preSelectedImages.length==0)){
            var autoSelectedImages = [];
        }else{
            var autoSelectedImages = preSelectedImages.split(",");
            var numberArray = autoSelectedImages.map(function(element) {
                return Number(element);
            });
            autoSelectedImages = numberArray;
        }
        var custom_uploader = wp.media({
            title: 'Select Images for Gallery',
            button: {
                text: 'Add Images'
            },
            multiple: isMultiple
        });
        // Open the media uploader
        custom_uploader.open();
        // Pre-select the images
        custom_uploader.state().get('selection').reset();
        autoSelectedImages.forEach(function(imageID) {
            var attachment = wp.media.attachment(imageID);
            attachment.fetch();
            custom_uploader.state().get('selection').add(attachment);
        });
        custom_uploader.on('select', function() {
            var attachments = custom_uploader.state().get('selection').toJSON();
            var imageIds = [];
            for (var i = 0; i < attachments.length; i++) {
                imageIds.push(attachments[i].id);
            }
            if((preSelectedImages.length !=0 )){
                console.log('autoSelectedImages', autoSelectedImages)
                console.log('imageIds', imageIds)
                var tmp1 = autoSelectedImages.filter(element => imageIds.includes(element));
                var tmp2 = imageIds.filter(function (element) {
                    return !autoSelectedImages.includes(element);
                });
                var C = [...tmp1, ...tmp2]
            }else{
                var C = imageIds;
            }
            console.log('c', C)
            $('#custom_product_gallery_container').empty();
            $('.lightbox__content').empty();
            //updateLightbox();
            //document.querySelector(".lightbox__content");
            $.ajax({
                type: 'POST',
                url: ajaxurl, // Use the WordPress AJAX URL
                data: {
                    action: 'save_custom_product_gallery',
                    nonce: $('#custom_product_gallery_nonce').val(),
                    imageIds: C
                },
                success: function(response) {
                    preSelectedImages = C.toString();
                    $("#_custom_product_gallery").val(C.toString());
                    $('#custom_product_gallery_container').html(response);

                    slider_functionalities();
                }
            });
        });
        custom_uploader.open();
    });
})( jQuery );
