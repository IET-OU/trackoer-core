/* 
* @author Niklas von Hertzen <niklas at hertzen.com>
* @created 14.6.2011 
* @website http://hertzen.com
*/


(function( $ ){
	$.fn.clipboard = function(options) {     
		var defaults = {
			prepend: null,
			append: null,
			oncopy: function(content){
			}
		};

		var options = $.extend({},defaults,options);
		$(this).each(function(i,el){

			el.oncopy = function(e,b){
				if (window.clipboardData && document.selection) { // Internet Explorer
					var s = document.selection;
					var r = s.createRange();
					var t;
					var txt = r.htmlText;

					if (options.prepend!==null){
						if($.isFunction(options.prepend)){
							t = options.prepend(txt) + txt;
						} else {
							t = options.prepend + txt;
						}                        
					}

					if (options.append!==null){
						if($.isFunction(options.append)){
							t = options.append(txt) + txt;
						} else {
							t = options.append + txt;
						}
					}

					options.oncopy(t);

					if (window.clipboardData.setData ("Text", t)){
						return false;
					}
				}else {
					// the rest (which don't support clipboardData)
					var s = window.getSelection();
					var r;

					if (s.rangeCount >= 1) {
						r = s.getRangeAt(0);
					} else {
						r = document.createRange();
					}

					var tmpr;
					if (s.rangeCount >= 1) {
						tmpr = s.getRangeAt(s.rangeCount - 1);
					} else {
						tmpr = document.createRange();
					}

					if (options.append!==null){
						var append;
						if($.isFunction(options.append)){
							append = options.append(tmpr.toString());
						} else {
							append = options.append;
						}
						var a = $('<span />').html(append);
						var rangeAppend = document.createRange();
						rangeAppend.setStart(tmpr.endContainer,tmpr.endOffset);
						rangeAppend.insertNode(a[0]);
						rangeAppend.setEnd(a[0], a[0].childNodes.length);
						window.setTimeout(function(){
							$(a).remove();
							},0);                                
						}

						if (options.prepend!==null){
							var prepend;
							if($.isFunction(options.prepend)){
								append = options.prepend(tmpr.toString());
							} else {
								append = options.prepend;
							}
							var n = $('<span />').html(prepend);

							r.insertNode(n[0]);

							var range = document.createRange();
							range.setStart(n[0], 0);
							range.setEnd(n[0], n[0].childNodes.length);
							s.addRange(range);

							window.setTimeout(function(){
								$(n).remove();
								},0);  
							}

							s.removeAllRanges();

							s.addRange(r);
							if (options.append!==null){
								s.addRange(rangeAppend);   
							}
							options.oncopy(s.toString());
						}
					};
				});
				return this;
			}
			})( jQuery );