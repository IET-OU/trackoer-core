/**
* @preserve capret-piwik.js: Based on capret.js
* Copyright 2012 The Open University/ License MIT/ Author N.D.Freear 2012-08-21.
* http://track.olnet.org
*/
// See, http://piwik.org/docs/tracking-api/reference

/*jslint browser:true, devel:true, indent:4, maxerr:500 */
/*global document, window, oer_license_parser, jQuery, $ */

(function ($) {
	'use strict';

	var Doc = document,
		jQuery = Doc.capret_no_conflict ? $.noConflict() : window.$,  //(Not removeAll=true)
		get_data = function (key, mydefault) {
			// Drupal 6/jQuery 1.3.2 doesn't fix $.data('my-prop') to $.data('myProp') - '_' for consistency.
			var val = jQuery('script[src*=capret-piwik]').attr('data-piwik_' + key);

			val = typeof val === 'undefined' ? mydefault : val;
			return '0' === val ? false : val;
		},
		piwik_url = get_data('url', 'http://track.olnet.org/piwik'),
		idsite = get_data('idsite', 1),
		source_ref = get_data('src_ref', true),   // Put document.location in 'urlref' Piwik param? (default: true)
		IE_hack = get_data('ie_hack', false),     // Append beacon to source document for IE? (default: false)
		IE_comment = get_data('ie_comment', true), // Add a help-comment for MSIE? Guy's idea (default: true, i18n)
		record = get_data('rec', 1),
		debug = get_data('debug', false),
	// Aliases
		UA = jQuery.browser,
		M = Math,
		enc = encodeURIComponent,
		J = JSON,  //3rd party?
		DL = Doc.location,
		LP = oer_license_parser,  //3rd party.
		log = function (s) {if (typeof console === 'object' && debug) {console.log(arguments.length <= 1 ? s : arguments); } };
	log('capret-piwik');

	/*function get_data(key, mydefault) {
		// Drupal 6/jQuery 1.3.2 doesn't fix $.data('my-prop') to $.data('myProp') - '_' for consistency.
		var val = jQuery('script[src*=capret-piwik]').attr('data-piwik_' + key);

		val = typeof val === 'undefined' ? mydefault : val;
		return '0' === val ? false : val;
	}*/

	function truncate(str, length) {
		if (str.length > length) {
			str = str.substring(0, length);
			str = str.replace(/w+$/, '');
			str += '...';
		}
		return str;
	}
	function final_params_pi(copy_text, env) {
		var tx = truncate(copy_text, 100),
			cv = '_cvar';

		// Piwik..
		env.idsite = idsite;
		env.rec = record;
		env.rand = M.floor(M.random() * 100);
		env.action_name = enc(Doc.title) + '/' + enc(' ' + tx) + '/' + enc(' CaPReT'); //+'"';

		//Custom variable JSON (last, in case it is stripped on paste?)
		env[cv] = {
			//'1': ['via', 'CaPReT'],
			'1': ['source', DL.href],
			'2': ['length', copy_text.length], //'len'
			'3': ['text', tx], //'txt'
			'4': ['modified', Doc.lastModified], //'lmod'
			'5': ['copyTime', new Date().toUTCString()] //.toISOString?
		};
		env[cv] = enc(J.stringify(env[cv]));

		return jQuery.param(env);
	}
	function image_tag_piwik(copy_text, env) {
		var img = '<img src="' + piwik_url + '/piwik.php?' + final_params_pi(copy_text, env) + '" alt=""/>';

		log(img);
		log(env);
		//log(J.stringify({a:1}));

		return img;
	}
	jQuery(function () {
		var env = {},
			Win = jQuery(window),
			urlkey = source_ref ? 'urlref' : 'url',
			license = LP.get_license(),
			comment = IE_comment && UA.msie ? (
				'<!--\n * Content copied using Internet Explorer.\n' +
				' * To paste rich-text cleanly use a different browser or paste into an HTML source editor on your site.\n' +
				' * For more help visit, http://track.olnet.org/help/capret/ie\n-->'
				) : '';
			comment = typeof IE_comment === 'string' && IE_comment.length > 1 && UA.msie ? '<!--\n' + IE_comment + '\n-->' : comment;

		env[urlkey] = enc(DL.href); //Use 'ContentReuse' Piwik plugin.
		env.res = enc(Win.width() + 'x' + Win.height());
		//env.id = make_id();

		jQuery('body').clipboard({
			append: function (e) {

				// A side effect of adding the image tag to the clipboard is that the browser will make a request out to the stats server.
				// That notifies us that text was copied
				if (IE_hack && UA.msie) {
					// Maybe a fix for MSIE 8.. seems to work, partly!
					jQuery('body').append(image_tag_piwik(e, env));

					return license.license_html;
				}
				return comment + image_tag_piwik(e, env) + license.license_html;
			}
		});
	});
})(jQuery);
