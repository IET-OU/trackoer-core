/*!
 trackoer.getPageUrl version 2 + Google Analytics asynch.
 (c)2012-08-20 The Open University.
*/
var trackoer = trackoer || {};

trackoer.getPageUrl = function(custom_hash) {
  var
    debug = true
  , Enc = encodeURIComponent
  , M = Math
  , Log = function(ob){if(typeof console!=='undefined'){console.log(arguments)}}
  , dl = document.location
  , sp = '!'
  , path = dl.hostname + dl.pathname + dl.search + dl.hash
  ;

  path += (path.indexOf('#') == -1 ? '#' :'');
  path += Enc(custom_hash.replace(/&amp;/g, '&'));
  //path += custom_hash.replace(/&amp;/g, '&');

  path += debug ? sp + 'Debug' + sp + M.floor((M.random()*100)+1) :'';
  Log(path);

  return path;
};


var _gaq = _gaq || [];
/*ga-start*/
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
/*ga-end*/
