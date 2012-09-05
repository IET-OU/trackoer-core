/*!
* @author Niklas von Hertzen <niklas at hertzen.com>
* @created 14.6.2011 
* @website http://hertzen.com
*
* @author Nick Freear
* @created 2012-09-04
* @license MIT
* (loosely based on Hertzen's work)
*/
/*jslint browser:true, devel:true, indent:4 */
/*global document:false, window:false, alert:false, jQuery:false */

(function ($) {
	'use strict';

	$.fn.clipboard = function (options) {
		var defaults = {
			prepend: null, // content/function to prepend to copy selection
			append: null,  // content/function to append to copy selection
			disable: false,  // disable copying for element
			oncopy: function (content) {} // callback on copy event
		},
			log = function (o) {if (typeof console === 'object') {console.log(arguments.length <= 1 ? o : arguments); } };

		log('jquery.clipboard 2');

		options = $.extend({}, defaults, options);

		$(this).each(function (i, el) {

			el.oncopy = function (e, b) {
				if (options.disable) {
					return false;
                }

				// Polyfill Internet Explorer/MSIE with 'ierange.js'.
				if (typeof window.getSelection === 'function') {
					// (the rest - which don't support clipboardData)
					log('win.getSelection - non-IE');

					var s = window.getSelection(),
						r,
						tmpr,
						span = '<span style="display:inline-block; width:0px; height:0px; overflow:hidden; zoom:1;" />';

					if (s.rangeCount >= 1) {
						r = s.getRangeAt(0);
					} else {
						r = document.createRange();
					}

					if (s.rangeCount >= 1) {
						tmpr = s.getRangeAt(s.rangeCount - 1);
					} else {
						tmpr = document.createRange();
					}

					if (options.append !== null) {
						var append,
							a,
							rangeAppend = document.createRange();

						if ($.isFunction(options.append)) {
							append = options.append(tmpr.toString());
						} else {
							append = options.append;
						}
						a = $(span).html(append);

						rangeAppend.setStart(tmpr.endContainer, tmpr.endOffset);
						rangeAppend.insertNode(a[0]);
						rangeAppend.setEnd(a[0], a[0].childNodes.length);
						window.setTimeout(function () {
							$(a).remove();
						}, 0);
					}

					if (options.prepend !== null) {
						var prepend,
							n,
							range = document.createRange();

						if ($.isFunction(options.prepend)) {
							prepend = options.prepend(tmpr.toString());
						} else {
							prepend = options.prepend;
						}
						n = $(span).html(prepend);

						r.insertNode(n[0]);

						range.setStart(n[0], 0);
						range.setEnd(n[0], n[0].childNodes.length);
						s.addRange(range);

						window.setTimeout(function () {
							$(n).remove();
						}, 0);
					}

					s.removeAllRanges();

					s.addRange(r);
					if (options.append !== null) {
						s.addRange(rangeAppend);
					}
					options.oncopy(s.toString());

				} else if (window.clipboardData && document.selection) { // (Internet Explorer)

					log('win.clipboardData - IE!');

					var s = document.selection,
						r = s.createRange(),
						dr = r.duplicate(),
						t = r.htmlText;

					if (options.prepend !== null) {
						if ($.isFunction(options.prepend)) {
							t = options.prepend(t) + t;
						} else {
							t = options.prepend + t;
						}
					}

					if (options.append !== null) {
						if ($.isFunction(options.append)) {
							t = t + options.append(t);
						} else {
							t = t + options.append;
						}
					}

					options.oncopy(t);

					if (window.clipboardData.setData("Text", t)) {
						return false;
					}
				} else {
					alert('Error!');
				}
			};
		});
		return this;
	};
})(jQuery);
