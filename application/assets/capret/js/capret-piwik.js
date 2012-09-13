/*!
* capret-piwik.js: Based on capret.js
* ©2012 The Open University/ License MIT/ Author N.D.Freear 2012-08-21.
* http://track.olnet.org
*/
// See, http://piwik.org/docs/tracking-api/reference

/*jslint browser:true, devel:true, indent:4, maxerr:500 */
/*global document, window, oer_license_parser, jQuery */

(function (jQuery) {
	'use strict';

	jQuery = jQuery.noConflict(); //(Not removeAll=true)

	function get_data(key, mydefault) {
		// Drupal 6/jQuery 1.3.2 doesn't fix $.data('my-prop') to $.data('myProp') - '_' for consistency.
		//var val = jQuery('script[src*=capret-piwik]').data('piwik_' + key);
		//return val || mydefault;

		var val = jQuery('script[src*=capret-piwik]').attr('data-piwik_' + key);

		val = typeof val === 'undefined' ? mydefault : val;
		return '0' === val ? false : val;
	}

	var piwik_url = get_data('url', 'http://track.olnet.org/piwik'),
		idsite = get_data('idsite', 1),
		source_ref = get_data('src_ref', true),   // Put document.location in 'urlref' Piwik param? (default: true)
		msie_hack = get_data('msie_hack', false), // Append beacon to source document for IE? (default: false)
		msie_comment = get_data('msie_comment', true),
		record = get_data('rec', 1),
		debug = get_data('debug', false),
	// Aliases
		ua = jQuery.browser,
		M = Math,
		enc = encodeURIComponent,
		J = JSON,  //3rd party?
		doc = document,
		license_parser = oer_license_parser,  //3rd party library.
		log = function (s) {if (typeof console === 'object' && debug) {console.log(arguments.length <= 1 ? s : arguments); } };
	log('capret-piwik');

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
		env.action_name = enc(doc.title) + '/' + enc(' ' + tx) + '/' + enc(' CaPReT'); //+'"';

		//Custom variable JSON (last, in case it is stripped on paste?)
		env[cv] = {
			//'1': ['via', 'CaPReT'],
			'1': ['source', doc.location.href],
			'2': ['length', copy_text.length], //'len'
			'3': ['text', tx], //'txt'
			'4': ['modified', doc.lastModified], //'lmod'
			'5': ['copyTime', new Date().toUTCString()] //.toISOString?
		};
		env[cv] = enc(J.stringify(env[cv]));

		return jQuery.param(env);
	}
	function image_tag_piwik(copy_text, env) {
		var img = '<img src="' + piwik_url + '/piwik.php?' + final_params_pi(copy_text, env) + '"/>';

		log(img);
		log(env);
		//log(J.stringify({a:1}));

		return img;
	}
	jQuery(function () {
		var env = {},
			win = jQuery(window),
			urlkey = source_ref ? 'urlref' : 'url',
			license = license_parser.get_license();

		env[urlkey] = enc(doc.location.href); //Use 'ContentReuse' Piwik plugin.
		env.res = enc(win.width() + 'x' + win.height());
		//env.id = make_id();

		jQuery('body').clipboard({
			append: function (e) {
				var comment = msie_comment && ua.msie ? (
				'<!--\n * Content copied using Internet Explorer.\n' +
				' * To paste rich-text cleanly use a different browser or paste into an HTML source editor on your site.\n' +
				' * For more help visit, http://track.olnet.org/help/capret/ie\n-->') : '';
				comment = typeof msie_comment == 'string' && msie_comment.length > 1 && ua.msie ? '<!--\n' + msie_comment + '\n-->' : comment;

				// A side effect of adding the image tag to the clipboard is that the browser will make a request out to the stats server.
				// That notifies us that text was copied
				if (msie_hack && ua.msie) {
					// Maybe a fix for MSIE 8.. seems to work, partly!
					jQuery('body').append(image_tag_piwik(e, env));

					return license.license_html;
				}
				return comment + image_tag_piwik(e, env) + license.license_html;
			}
		});
	});
})(jQuery);
