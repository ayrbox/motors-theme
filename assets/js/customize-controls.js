/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */




(function() {	
	wp.customize.bind( 'ready', function() {

		// Only show the color hue control when there's a custom color scheme.
		wp.customize( 'colorscheme', function( setting ) {
			wp.customize.control( 'colorscheme_hue', function( control ) {
				var visibility = function() {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

		// Detect when the front page sections section is expanded (or closed) so we can adjust the preview accordingly.
		wp.customize.section( 'theme_options', function( section ) {
			section.expanded.bind( function( isExpanding ) {

				// Value of isExpanding will = true if you're entering the section, false if you're leaving it.
				wp.customize.previewer.send( 'section-highlight', { expanded: isExpanding });
			} );
		} );
	});
})( jQuery );






/** 
 * @package Beans theme
 */


(function(api, $) {
	'use strict';
	api.controlConstructor['pages'] = api.Control.extend( {
		ready: function() {
			var control = this;
			setTimeout(function() {
				control._init();				
			}, 2500);
		},		
		_init: function() {
			var control = this;



			control.getPages = function() {
				var form = $('.page-form', control.container);				
				var data = $('input, textarea, select', form).serialize();				
				return JSON.stringify(data);
			}


			control.updatePages = function() {
				var data = control.getPages();
				 $("[data-hidden-value]", control.container).val(data);
				 $("[data-hidden-value]", control.container).trigger('change');				
			}


			//Close/Open widge panel
			control.container.on('click', '.widget .widget-action, .widget .page-close, .widget-title', function(e) {
				e.preventDefault();
				var $widget = $(this).closest('.widget');				
				if($widget.hasClass('expanded')) {					
					$('.widget-inside', $widget).slideUp(200, 'linear', function() {
						$('.widget-inside', $widget).removeClass('show').addClass('hide');
						$widget.removeClass('expanded');
					});
				} else {					
					$('.widget-inside', $widget).slideDown(200, 'linear', function() {
						$('.widget-insize', $widget).removeClass('hide').addClass('show');
						$widget.addClass('expanded');
					});
				}
			});


			control.container.on('click', '.page-remove', function(e) {
				e.preventDefault();
				var $pageListItemContext = $(this).closest('.page-list-item');
				$("body").trigger('page-list-item-removed', $pageListItemContext);
				$pageListItemContext.remove();
				control.updatePages();				
				//TODO: Update page id - Recommended
			});




			/** Template function */
			control.pageTemplate = _.memoize(function() {
				var tpl;
				var options = {
					evaluate: /<#([\s\S]+?)#>/g,
					interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
					escape: /\{\{([^\}]+?)\}\}(?!\})/g,
					variable: 'data'
				};
				return function(data) {
					if(typeof window.page_tpl === "undefined") {
						window.page_tpl = $('#page-item-tpl').html();
					}
					tpl = _.template(window.page_tpl, null, options);					
					return tpl(data);
				};
			});
			control.template = control.pageTemplate();
			

			
			
			var _pages = control.params.pages;
			$.each(_pages, function(i, _page) {				
				_page.item_id = i;
				var $html = $(control.template(_page));				
				$('.page-list', control.container).append($html);				
				// console.log("control.container", control.container);				
				// control.bindActions($html);
			});


			//Events
			control.container.on('click', '.add-page', function() {
				var init_page = {
					item_id : 0, page_id: 0, show_title: 1, show_link: 1
				};

				$('.page-list-item', control.container).each(function(i, listItem) {
					init_page.item_id = i+1;
				});


				var $html = $(control.template(init_page));
				$('.page-list', control.container).append($html);
				// control.bindActions($html);
			});

			$('.page-list', control.container).on('keyup change', 'input, select, textarea', function(e) {
				control.updatePages();
			});


			$('body').on('page-list-item-removed', function(event, $context) {				
				console.log("PAGE-ITEM", $context);
			})
		}//Init
	});


}(wp.customize, jQuery));



