/*!
 Track OER site behaviours (Ender/jeesh.js)
 Copyright 2012-08-17 The Open University.
*/

/* OER Form - extended.
*/
$('input[name=sv]').change(function(){
	console.log('#sv-ga change..');
	$('#ga-ac').attr('class', $('input[name=sv]:checked').val() == 'ga' ? 'show' : 'hide');
});

/* Make every test License-tracker code clickable. A click reveals the code-snippet.
*/
(function trackoer_show_embed(){
	var elem_code = $('#cc-code')
		, area_id = 'copy-me-js'
		, dl = document.location
		, path = dl.pathname
		, f_show = false
		;
	//console.log(path, path.indexOf('/oerform'));
	//if (! elem_code) elem_code = $('#cc-code');
	if (! elem_code || path.indexOf('/oerform') != -1) return;

	//console.log('Adding button-js..');
	elem_code.attr({
		// Keyboard/ WAI-ARIA accessibility!
		'role': 'button',
		'tabindex': 1,
		'title': 'Show the License-tracker code'
	}).click(function(){
		var area = $('#'+ area_id);
		if (area.length > 0) {
			if (f_show) {
				area.attr('class', 'hide');
			} else {
				area.attr('class', 'show');
			}
			f_show = ! f_show;
			return;
		}
		f_show = ! f_show;

		var code = elem_code.html().replace(/<\/?p>/g, '').replace(/</g, '&lt;').replace(/\n/, ''); // /\n/g -- No linebreaks?
		//console.log(code);

		elem_code
			.after('<textarea id="'+ area_id +'" class="show" title="Copy me!" rows="10" cols="85" readonly="">' + code + '</textarea>')
			//.after('<label class="blk" for="copy-me-js">Copy me!</label>') //Hmm, back to front!
			.attr({ });
	});

	// Trigger: if the URL ends in #copy-me-js show the <textarea>
	if (dl.hash.indexOf(area_id) != -1) {
		elem_code.click();
	}
})();
