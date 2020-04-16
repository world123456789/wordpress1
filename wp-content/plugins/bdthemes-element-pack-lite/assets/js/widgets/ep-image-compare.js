( function( $, elementor ) {

	'use strict';

	var widgetImageCompare = function( $scope, $ ) {

		var $imageCompare         = $scope.find( '.bdt-image-compare > .twentytwenty-container' ),
            default_offset_pct    = $imageCompare.data('default_offset_pct'),
            orientation           = $imageCompare.data('orientation'),
            before_label          = $imageCompare.data('before_label'),
            after_label           = $imageCompare.data('after_label'),
            no_overlay            = $imageCompare.data('no_overlay'),
            move_slider_on_hover  = $imageCompare.data('move_slider_on_hover'),
            move_with_handle_only = $imageCompare.data('move_with_handle_only'),
            click_to_move         = $imageCompare.data('click_to_move');

        if ( ! $imageCompare.length ) {
            return;
        }

        $($imageCompare).twentytwenty({
            default_offset_pct: default_offset_pct,
            orientation: orientation,
            before_label: before_label,
            after_label: after_label,
            no_overlay: no_overlay,
            move_slider_on_hover: move_slider_on_hover,
            move_with_handle_only: move_with_handle_only,
            click_to_move: click_to_move
        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-image-compare.default', widgetImageCompare );
	});

}( jQuery, window.elementorFrontend ) );