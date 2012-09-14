/** @preserve (c)2012-08-15 The Open University.
*/
var trackoer = trackoer || {};

trackoer.getPageUrl = function() {
  var
    debug = true
  , Uri = parseURL //Was: parseUri() -- but we need 'segments'!
  , Enc = encodeURIComponent
  , M = Math
  , Log = function(ob){if(typeof console!=='undefined'){console.log(arguments)}}
  , license = oer_license_parser.get_license()
  , current = license.current_license
  , source_url = Uri(current.source_url) // Page-level Actual course http://labpspace.open.ac.uk/mod/oucontent/view.php?id=1234&section=5
  , source_id = Uri(current.source_id)   // Course-level, Eg. http://labspace.open.ac.uk/Learning_to_Learn_1.0
  , dl = document.location
  , sp = '!'
  , path = Uri(dl).relative //Uri(dl).host+
  ;

  path += (path.indexOf('#') == -1 ? '#' :'');
  path += Enc(sp + source_url.host + sp + source_id.segments[0] + sp + source_url.relative);

  path += debug ? sp + 'Debug' + sp + M.floor((M.random()*100)+1) :'';

  //Log(oer_license_parser);
  Log(current, source_url, path);

  return path;
};
