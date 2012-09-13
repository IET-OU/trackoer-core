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
		var val = jQuery('script[src*=capret-piwik]').data('piwik-' + key);
		return val || mydefault;
	}

	var piwik_url = get_data('url', 'http://track.olnet.org/piwik'),
		idsite = get_data('idsite', 1),
		source_ref = get_data('src-ref', true),   // Put document.location in 'urlref' Piwik param? (default: true)
		msie_hack = get_data('msie-hack', false), // Append beacon to source document for IE? (default: false)
		record = get_data('rec', 1),
		debug = get_data('debug', false),
	// Aliases
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
				// A side effect of adding the image tag to the clipboard is that the browser will make a request out to the stats server.
				// That notifies us that text was copied
				if (msie_hack && jQuery.browser.msie) {
					// Maybe a fix for MSIE 8.. seems to work, partly!
					jQuery('body').append(image_tag_piwik(e, env));

					return license.license_html;
				}
				return image_tag_piwik(e, env) + license.license_html;
			}
		});
	});
})(jQuery);
