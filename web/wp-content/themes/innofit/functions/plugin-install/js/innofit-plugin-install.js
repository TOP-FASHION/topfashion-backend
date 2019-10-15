/**
 * Remove activate button and replace with activation in progress button.
 */

/* global innofit_plugin_helper */

jQuery( document ).on(
	'DOMNodeInserted','.activate-now', function () {
		var activateButton = jQuery( '.activate-now' );
		if (activateButton.length) {
			var url = jQuery( activateButton ).attr( 'href' );
			if (typeof url !== 'undefined') {
				// Request plugin activation.
				jQuery.ajax(
					{
						beforeSend: function () {
							jQuery( activateButton ).replaceWith( '<a class="button updating-message">' + innofit_plugin_helper.activating + '...</a>' );
						},
						async: true,
						type: 'GET',
						url: url,
						success: function () {
							// Reload the page.
							location.reload();
						}
					}
				);
			}
		}
	}
);
jQuery( document ).ready(
	function ($) {
		$( 'body' ).on(
			'click', ' .innofit-install-plugin ', function () {
				var slug = $( this ).attr( 'data-slug' );

				wp.updates.installPlugin(
					{
						slug: slug
					}
				);
				return false;
			}
		);

		$( '.activate-now' ).on(
			'click', function (e) {
				var activateButton = $( this );
				e.preventDefault();
				if ($( activateButton ).length) {
					var url = $( activateButton ).attr( 'href' );
					if (typeof url !== 'undefined') {
						// Request plugin activation.
						$.ajax(
							{
								beforeSend: function () {
									$( activateButton ).replaceWith( '<a class="button updating-message">' + innofit_plugin_helper.activating + '...</a>' );
								},
								async: true,
								type: 'GET',
								url: url,
								success: function () {
									// Reload the page.
									location.reload();
								}
							}
						);
					}
				}
			}
		);
	}
);
