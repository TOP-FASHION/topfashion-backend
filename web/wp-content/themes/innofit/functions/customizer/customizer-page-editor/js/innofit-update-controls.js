/**
 * Update controls
 *
 * @package Innofit
 */

/* global requestpost */
/* global wp */
/* global WPEditorWidget */

( function( $ ) {
	'use strict';
	wp.customize(
		'page_on_front', function( value ) {

			value.bind(
				function( newval ) {

					$.ajax(
						{
							url: requestpost.ajaxurl,
							type: 'post',
							data: {
								action: 'innofit_ajax_call',
								pid: newval
							},
							success: function (result) {

								if (result !== '' && result !== 'undefined' ) {

									result      = JSON.parse( result );
									var content = result.post_content;
									jQuery( '#innofit_page_editor' ).val( content );
									WPEditorWidget.setEditorContent( 'innofit_page_editor' );

									if (result.post_thumbnail !== '' && result.post_thumbnail !== 'undefined') {
										wp.customize.instance( requestpost.thumbnail_control ).set( result.post_thumbnail );
										var html = '<label for="innofit_feature_thumbnail-button">' +
										'<span class="customize-control-title">' + requestpost.thumbnail_label + '</span>' +
										'</label>' +
										'<div class="attachment-media-view attachment-media-view-image landscape">' +
										'<div class="thumbnail thumbnail-image">' +
										'<img class="attachment-thumb" src="' + result.post_thumbnail + '" draggable="false" alt=""> ' +
										'</div>' +
										'<div class="actions">' +
										'<button type="button" class="button remove-button">Remove</button>' +
										'<button type="button" class="button upload-button control-focus" id="innofit_feature_thumbnail-button">Change Image</button> ' +
										'<div style="clear:both"></div>' +
										'</div>' +
										'</div>';
										wp.customize.control( requestpost.thumbnail_control ).container['0'].innerHTML = html;
									}

									wp.customize.instance( requestpost.editor_control ).previewer.refresh();
								}
							}
						}
					);

				}
			);
		}
	);
} )( jQuery );
