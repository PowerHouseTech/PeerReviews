/**
 * Image controls.
 */
( function( $ ){

    function initMediaUpload() {

        var mediaUploader;

        $('.widget-image-select').on('click', function( e ) {

            var imageInputFieldId = $(this).next().attr('id');
            e.preventDefault();

            // Extend the wp.media object.
            mediaUploader = wp.media({
                title: RommeledImageWidget.frame_title,
                button: {
                    text: RommeledImageWidget.button_title
                },
                multiple: false
            });

            // When a file is selected, grab the URL and set it as the text field's value.
            mediaUploader.on('select', function() {

                // Image input field.
                var imgInput = $('#'+imageInputFieldId+'');

                attachment = mediaUploader.state().get('selection').first().toJSON();

                imgInput.val( attachment.url + '?id=' + attachment.id )
                    .next('img').attr('src', attachment.url )
                    .css('display', 'block')
                    .closest('.widget-content').children('.non-sortable').css('display','block');
            });

            // Open the uploader dialog.
            mediaUploader.open();
            return false;

        });
    }

    function removeImage() {

        $('.imageRemove').on('click', function( e ) {

            e.preventDefault();

            var img = $(this).prev().children('img');
            var val = $(this).prev().children('input');

            img.attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D')
                .css('display', 'none')
                .closest('.widget-content').children('.non-sortable').css('display','none');

            val.val('');

        });
    }

    function sortElements() {

        var sort = $('.widget-image-sortable');
        sort.sortable({
            placeholder: "ui-state-highlight",
            opacity: 0.8,
            cursor: 'move',
            update: function(event, ui) {
                var order = $(this).sortable("toArray");
                $(this).next().val(order.join(","));
            }
        });

        sort.disableSelection();
    }

    $( document ).on( 'widget-added widget-updated', function(){
        initMediaUpload();
        removeImage();
        sortElements();
    });

    $( document ).ready( function() {
        initMediaUpload();
        removeImage();
        sortElements();
    } );

})( jQuery );
