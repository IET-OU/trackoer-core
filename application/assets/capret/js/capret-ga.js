/**
* @preserve capret-ga.js: Based on capret-piwik.js
* ©2012 The Open University/ License MIT/ Author N.D.Freear 2012-09-12.
* http://track.olnet.org
*/
// See, https://developers.google.com/analytics/resources/articles/gaTrackingTroubleshooting#gifParameters

/*jslint browser:true, devel:true, indent:4 */
/*global document, window, oer_license_parser, jQuery, gaTrack */


//var _gaq = _gaq || [];

(function (jQuery) {
	'use strict';

	jQuery = jQuery.noConflict(); //(Not removeAll=true)

	function get_data(key, mydefault) {
		// Drupal 6/jQuery 1.3.2 doesn't fix $.data('my-prop') to $.data('myProp') - '_' for consistency.
		var val = jQuery('script[src*=capret-ga]').attr('data-utm_' + key);
		val = typeof val === 'undefined' ? mydefault : val;
		return '0' === val ? false : val;
	}

	var utmac = get_data('ac', 'UA-12345-6'),
		debug = get_data('debug', false),
		//IE_hack = get_data('ie_hack', false),   // Append beacon to source document for IE? (default: false)
		IE_comment = get_data('ie_comment', true), // Add a help-comment for MSIE? Guy's idea (default: true, i18n)
	// Aliases
		UA = jQuery.browser,
		Doc = document,
		DL = Doc.location,
		LP = oer_license_parser,  //3rd party.
		log = function (s) {if (typeof console === 'object' && debug) {console.log(arguments.length <= 1 ? s : arguments); } };
	log('capret-ga');

	function truncate(str, length) {
		if (str.length > length) {
			str = str.substring(0, length);
			str = str.replace(/w+$/, '');
			str += '...';
		}
		return str;
	}
	function final_params_ga(copy_text, env) {
		env.len = copy_text.length;
		env.tx = truncate(copy_text, 100); //Not escape()!
		env.lmod = Doc.lastModified;
		env.pcopy = DL.pathname + DL.search + '#!' + env.tx + '!' + 'CaPReT';
		env.pview = '/Unknown-Dest' + env.pcopy + '/' + 'view';
		env.title = Doc.title + '/' + env.tx + '/' + env.ct;
		env.ecopy = '(CapReT*copy*' + env.tx + ')(' + env.len + ')';
		env.eview = '(CapReT*view*' + env.tx + ')';
	}
	function image_tag_ga(env) {
		var img = '<img src="' + gaTrack(env.ac, false, env.pview, env.title, env.direct, env.eview, true) + '" alt=""/>';

		log(img);
		log(env);

		return img;
	}
	jQuery(function () {
		var env = {
			ac: utmac,
			ct: new Date().toUTCString(),
			host: DL.hostname,
			//id: make_id(),
			direct: true
		},
			//scope = 3,
			license = LP.get_license(),
			comment = IE_comment && UA.msie ? (
				'<!--\n * Content copied using Internet Explorer.\n' +
				' * To paste rich-text cleanly use a different browser or paste into an HTML source editor on your site.\n' +
				' * For more help visit, http://track.olnet.org/help/capret/ie\n-->'
			) : '';
		comment = typeof IE_comment === 'string' && IE_comment.length > 1 && UA.msie ? '<!--\n' + IE_comment + '\n-->' : comment;

		jQuery('body').clipboard({
			append: function (e) {

				final_params_ga(e, env);

				gaTrack(env.ac, env.host, env.pcopy, env.title, env.direct);
				gaTrack(env.ac, env.host, env.pcopy, env.title, env.direct, env.ecopy);

				/*_gaq.push(['_capret_._setAccount', utmac]);
				_gaq.push(['_capret_._setCustomVar', 1, 'via', 'CaPReT', scope]);
				_gaq.push(['_capret_._setCustomVar', 2, 'length', env.len, scope]);
				_gaq.push(['_capret_._setCustomVar', 3, 'text', env.tx, scope]);
				_gaq.push(['_capret_._setCustomVar', 5, 'copyTime', env.ct, scope]);
				_gaq.push(['_capret_._trackEvent', 'CaPReT', 'copy', env.tx]);
				_gaq.push(['_capret_._trackPageview', env.pcopy]);
				*/

				// A side effect of adding the image tag to the clipboard is that the browser will make a request out to the stats server.
				// That notifies us that text was copied
				return comment + image_tag_ga(env) + license.license_html;
			}
		});
	});
})(jQuery);


/*ga-start*-/
(function () {
  var s, D = document, ga = D.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' === D.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  s = D.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
/-*ga-end*/
