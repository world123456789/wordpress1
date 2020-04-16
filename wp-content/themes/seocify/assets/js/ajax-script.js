( function( $) {
    "use strict";
    $('body').on('submit', 'form.cart', function(e) {
        e.preventDefault();

        var $form = $(this),
            $thisbutton = $form.find('.button'),
            data = $form.serialize();

        data += '&action=seocify_ajax_add_to_cart';

        if( $thisbutton.val() ) {
            data += '&add-to-cart=' + $thisbutton.val();
        }

        $thisbutton.removeClass( 'added not-added' );
        $thisbutton.addClass( 'loading' );

        $( document.body ).trigger( 'adding_to_cart', [ $thisbutton, data ] );
        // Ajax action.
            $.post( xs_ajax_obj.ajaxurl, data, function( response ) {

                if ( ! response ) {
                    return;
                }

                if ( response.error && response.product_url ) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                }else{
                    $thisbutton.removeClass( 'lading' );
                    $thisbutton.addClass( 'not-added' );
                    $('.xs-sidebar-group').addClass('isActive');
                    $('.modal').modal('hide');

                }

                // Trigger event so themes can refresh other areas.
                $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
            });

    });
    $(document).on( 'added_to_wishlist removed_from_wishlist', function(){
        $.ajax({
            url: xs_ajax_obj.ajaxurl,
            data: {
                action: 'seocify_wishlist_count'
            },
            method: 'POST',
            success: function(data) {
                $('.xswhishlist').html(data);
            }
        });
    });

    $( 'body' ).on( 'added_to_cart', function(){
        $('.xs_added_to_cart').addClass('active');
        setTimeout(function(){
            $('.xs_added_to_cart').removeClass('active');
        }, 3000);

    });

}( jQuery) );