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
  , Sec = function(u){return u.replace(/(C:\/Users\/|C:\/)/g, '').replace(/file:\/\//, 'http://F')}
  , dl = document.location
  , sp = '!'
  , path = /*dl.hostname +*/ Sec(dl.pathname) + Enc(dl.search + dl.hash)
  ;

  path += (path.indexOf('#') == -1 || path.indexOf('%23') == -1 ? '%23' :'');
  path += Enc(custom_hash.replace(/&amp;/g, '&'));
  path += sp + Enc(dl.protocol); //.replace(/:/, ',')

  path += debug ? sp + 'Debug' + sp + M.floor((M.random()*100)+1) :'';
  Log(path);
  Log(dl);

  //return Enc(path);
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
