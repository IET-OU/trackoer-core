/*!
 Track OER site behaviours (Ender/jeesh.js)
 Copyright 2012-08-17 The Open University.
*/

/* Utilities.
*/
$.log = function(ob){if(typeof console!=='undefined'){console.log(arguments)}};

$(document).ready(function(){

	/* OER Form - extended.
	*/
	function trackoer_form() {
		$('#ga-ac').attr('class', $('input[name=sv]:checked').val() == 'ga' ? 'show' : 'hide');
		$.log('#sv-ga change..');
	}
	$('input[name=sv]').change(function(){
		trackoer_form();
	});
	trackoer_form();


	trackoer_show_embed();
	trackoer_bookmarklet_help();
});

/* Make every test License-tracker code clickable. A click reveals the code-snippet.
*/
function trackoer_show_embed(){
	var elem_code = $('#cc-code,.cc-code')
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


		// "Select all".
		// https://github.com/IET-OU/ouplayer/blob/master/application/themes/ouplayer_base/js/mep-oup-feature-copyembed.js
		var area = $('#'+ area_id);
		area.bind('focus click', function(ev){
			this.select();

			// Work around Chrome's little problem
			//preventDefault: https://bugs.webkit.org/show_bug.cgi?id=22691
			//http://stackoverflow.com/questions/5797539/jquery-select-all-text-from-a-textarea
			area.mouseup(function(e) {
				if(typeof e.preventDefault!=='undefined'){ e.preventDefault() }
				// Prevent further mouseup intervention
			});
			$.log('Embed code selected');
		});
	});

	// Trigger: if the URL ends in #copy-me-js show the <textarea>
	if (dl.hash.indexOf(area_id) != -1) {
		elem_code.click();
	}
}

function trackoer_bookmarklet_help() {
	var hint = $('#bookmarklet').attr('title'),
		id = 'bookmarklet-hint',
		el,
		vis = false;

	if (! hint) return;

	el = $('<p id="'+ id +'" style="display:none">'+ hint +'</p>');
	$('body').append(el);

	$('#bookmarklet a')
	/*.click(function (ev) {
		alert(hint);
	})*/
	.bind('mouseover mouseout focus blur', function (ev) {
		if (vis) {
			el.css('display', 'none');
		} else {
			el.css('display', 'block');
		}
		vis = !vis;
	});
}
