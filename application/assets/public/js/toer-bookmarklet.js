/*!
 Track OER bookmarklet.
 (c)2012-09-11 The Open University.
*/
/*jslint browser:true, devel:true, indent:4 */
/*global parent, document, window, alert */

(function () {
	'use strict';

	var params = 'edge=1',
		PWL = parent.window.location,
		D = document,
		//DL = d.location,
		enc = encodeURIComponent;
	if (typeof D.trackoer_srvurl === 'undefined') {
		alert("Error, missing 'trackoer_srvurl'!");
	}
	else if (typeof D.trackoer_errtext === 'undefined') {
		alert("Error, missing 'trackoer_errtext'!");
	}
	else if (D.trackoer_srvurl.indexOf(PWL.host) !== -1) {
		// IF "Self", display a reassuring explanation!
		alert("Track OER bookmarklet success!\n\nYou're all set up! This button will remain in your Internet browser whenever you use it.");
		//'Just click this same "Add to Wish List" button while shopping at any online store to save items to any of your Amazon Wish Lists.'
		//http://www.amazon.co.uk/wishlist/get-button/
	}
	else if (PWL.host.match(/(labspace.*?\.open\.ac\.uk|openlearn\.*?\.open\.ac\.uk|oercommons\.org)/)) {
		PWL.href = D.trackoer_srvurl + 'oerform?' + params + '&url=' + enc(PWL.href);
	} else {
		alert(
			PWL.host + ' : ' + D.trackoer_errtext
			/*"Sorry, '"
			+ PWL.host + 
			"' is not supported by Track OER.\n\n The license-tracker service currently supports:\nOpenlearn.open.ac.uk, Labspace.open.ac.uk and OERCommons.org"
			*/
		);
	}

})();
