/*!
 Track OER bookmarklet.
 (c)2012-09-11 The Open University.
*/
/*jslint browser: true, devel: true, indent: 4 */

(function () {

	var params = 'edge=1',
		PWL = parent.window.location,
		D = document,
		//DL = d.location,
		enc = encodeURIComponent;
	if (typeof D.trackoer_srvurl == 'undefined') {
		alert("Error!");
	}
	else if (PWL.host.match(/(labspace.*?\.open.ac.uk|openlearn.*?\.open.ac.uk|oercommons\.org)/)) {
		PWL.href = D.trackoer_srvurl + 'oerform?' + params + '&url=' + enc(PWL.href);
	} else {
		alert(
			"Sorry, '"
			+ PWL.host + 
			"' is not supported by Track OER.\n\n The license-tracker service currently supports:\nOpenlearn.open.ac.uk, Labspace.open.ac.uk and OERCommons.org"
		);
	}

})();
