/*!
* capret-ga.js: Based on capret-piwik.js
* ©2012 The Open University/ License MIT/ Author N.D.Freear 2012-09-12.
* http://track.olnet.org
*/
// See, https://developers.google.com/analytics/resources/articles/gaTrackingTroubleshooting#gifParameters

/*jslint browser:true, devel:true, indent:4 */
/*global document, window, oer_license_parser, jQuery */

var _gaq = _gaq || [];

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
		msie_hack = get_data('msie_hack', false), // Append beacon to source document for IE? (default: false)
		debug = get_data('debug', false),
	// Aliases
		M = Math,
		enc = encodeURIComponent,
		doc = document,
		DL = doc.location,
		license_parser = oer_license_parser,  //3rd party library.
		log = function (s) {if (typeof console === 'object' && debug) {console.log(arguments.length <= 1 ? s : arguments); } };

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
		env.txt = escape(truncate(copy_text, 100));
		env.lmod = doc.lastModified;	
		return jQuery.param(env);
	}
	function image_tag_ga(copy_text, env){		
		return '<img src="http://www.google-analytics.com/__utm.gif?' + final_params_ga(copy_text, env) + '"/>';
	}
	jQuery(function() {
		var env = {};
		env.utmac = utmac;
		env.ct = new Date().getTime();
		//env.id = make_id();
		var license = license_parser.get_license();
		jQuery('body').clipboard({
			append: function(e){
				var res = final_params_ga(e, env),				
					scope = 3,
					path = DL.pathname + DL.search + '#!' + env.txt + '!' + 'capret';

				_gaq.push(['_capret_._setAccount', utmac]);
				_gaq.push(['_capret_._setCustomVar', 1, 'via', 'CaPReT', scope]);
				_gaq.push(['_capret_._setCustomVar', 2, 'length', env.len, scope]);
				_gaq.push(['_capret_._setCustomVar', 3, 'text', env.txt, scope]);
				_gaq.push(['_capret_._setCustomVar', 5, 'copyTime', ct, scope]);
				_gaq.push(['_capret_._trackEvent', 'CaPReT', 'copy', env.txt]);
				_gaq.push(['_capret_._trackPageview', path]);

				// A side effect of adding the image tag to the clipboard is that the browser will make a request out to the stats server.
				// That notifies us that text was copied
				return /*image_tag_ga(e, env) +*/ license.license_html;
			}
		});				
	});
})(jQuery);


/*ga-start*/
(function () {
  var s, D = document, ga = D.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' === D.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  s = D.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
/*ga-end*/
