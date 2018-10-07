/**
 * Created by dinh0 on 10/7/2018.
 */

function LGMediaInsertSlider($item)
{
    var Input = $item.find('input.image');
    var Preview = $item.find('.preview-img');
    console.log(Input,Preview, $item);
    var Frame;

    if ( undefined !== Frame )
    {
        Frame.open();

        return;
    }

    if ( typeof wp.media === 'undefined' )
    {
        return;
    }

    Frame = wp.media
    ({
        frame: 'select',
        //multiple: 'add',
        library:
        {
            type: 'image'
        }
    })
        .on( 'open', function()
        {
            var Selection = Frame.state().get( 'selection' );
            if (Input.val()) {
                var AttachmentIds = Input.val().split( ',' );

                AttachmentIds.forEach( function( Id )
                {
                    var Attachment = wp.media.attachment( Id );

                    Attachment.fetch();

                    Selection.add( Attachment ? [ Attachment ] : [] );
                });
            }

        })
        .on( 'select', function()
        {
            var Selection = Frame.state().get( 'selection' );

            Input.val( _.compact( Selection.pluck( 'id' ) ) ).change();

            Preview.empty();

            _.compact( Selection.pluck( 'sizes' ) ).forEach( function( ImageSize )
            {
                var URL = '';

                if ( ImageSize.thumbnail && ImageSize.thumbnail.url )
                {
                    URL = ImageSize.thumbnail.url;
                }
                else if ( ImageSize.full && ImageSize.full.url )
                {
                    URL = ImageSize.full.url;
                }

                if ( URL )
                {
                    Preview.append( '<img src="' + URL + '" alt="" style="height: 100px;">' );
                }
            });
        });

    Frame.open();
}


jQuery( document ).ready( function( $ )
{
    $( '#LightGallery-MetaBox #LightGallery-Images' ).change( function()
    {
        if ( $( this ).val() )
        {
            $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).val( '[lightgallery images="' + $( this ).val() + '"]' );
        }
        else
        {
            $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).val( '' );
        }
    });

    $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).focus( function()
    {
        if ( $( this ).val() )
        {
            $( this ).select();
        }
    });
    $( document).on('click', '#Slider-MetaBox .remove-image',  function( e )
    {
        e.preventDefault();
        var $item = $(this).closest('.slider-item');
        $item.remove();
    });
    $( document).on('click', '#Slider-MetaBox .select-image',  function( e )
    {
        e.preventDefault();
        var $item = $(this).closest('.slider-item');
        LGMediaInsertSlider($item);
    });
    $( '#Slider-MetaBox button.add-image' ).click( function( e )
    {
        e.preventDefault();
        var lastItem = $('.slider-item').last();
        var newItem = lastItem.clone();
        newItem.find('input.image').val('');
        newItem.find('.preview-img').html('');
        newItem.find('.caption').val('');
        if (!newItem.find('p.header .remove-image').length){
            newItem.find('p.header').append('<span class="remove-image">x</span>');
        }
        newItem.insertAfter(lastItem)
    });

    $( '#LightGallery-MetaBox .media-clear' ).click( function( e )
    {
        e.preventDefault();

        $( '#LightGallery-MetaBox #LightGallery-Preview' ).empty();

        $( '#LightGallery-MetaBox #LightGallery-Images, #LightGallery-MetaBox #LightGallery-ShortCode' ).val( '' );
    });

    $( '#LightGallery-MetaBox .editor-insert' ).click( function( e )
    {
        e.preventDefault();

        if ( $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).val() )
        {
            if ( tinyMCE && tinyMCE.activeEditor )
            {
                tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).val() );
            }
            else
            {
                var Elm = $( 'textarea#content' );

                Elm.val( Elm.val().substring( 0, Elm.prop( 'selectionStart' ) ) + $( '#LightGallery-MetaBox #LightGallery-ShortCode' ).val() + Elm.val().substring( Elm.prop( 'selectionEnd' ), Elm.val().length ) );
            }
        }
    });
});
