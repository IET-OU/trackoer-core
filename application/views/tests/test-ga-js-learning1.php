<!doctype html><html ><meta charset=utf-8 ><title>Track OER - Google Analytics Javascript</title>

<!--<script src="https://raw.github.com/tatemae/capret/master/public/js/oer_license_parser.js"></script>-->
<script src="oer_license_parser_2.js"></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  //_gaq.push(['_setAccount', 'UA-XXXXX-X']);
  _gaq.push(['_setAccount', 'UA-34064304-2']);
  //_gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<style>body{ margin:2em; font:.9em sans-serif; background:#fafafa; color:#333; } p{ margin:2em 0;} </style>


<h1>Track OER - Google Analytics custom Javascript</h1>


<p>[Creative commons license snippet]
<p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/deed.en_GB"
 ><img alt="Creative Commons Licence" style="border-width:0" src=
 "http://track.olnet.org/track/r/piwik/4/cc:by-nc-sa/labspace.open.ac.uk/Learning_to_Learn_1.0?p=mod%2Foucontent%2Fview.php%3Fid%3D471422%26section%3D3&t=2.3+Gathering+Evidence%E2%80%94Your+Qualities%2C+Knowledge+and+Skills+-+Learning+to+Learn+-+LabSpace+%28Course%29&debug=2"
 class="wb" title="Creative Commons License - with tracking**" 
 /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">2.3 Gathering Evidence&ndash;Your Qualities, Knowledge and Skills - Learning to Learn - LabSpace (Page)</span>
 by <a xmlns:cc="http://creativecommons.org/ns#" href="http://labspace.open.ac.uk" property="cc:attributionName" rel="cc:attributionURL">OpenLearn/Andrew Studnicky</a>
 is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/deed.en_GB">Creative Commons Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales License</a>,
 <a class="wt" href="#!Explain..">with tracking</a>.
 <br />
 Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&amp;section=3#frag" rel="dct:source"
 id="_source" title="dct:source"
 >http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&amp;section=3</a>.


<p>[Creative commons - extension]
<p><a xmlns:dct="http://purl.org/dc/terms/" href="http://labspace.open.ac.uk/Learning_to_Learn_1.0" rel="dct:identifier"
 id="_identifier" title="dct:identifier"
 >Learning_to_Learn_1.0</a>



<p>[custom javascripts . . . <br /> . . . _gaq.push(['_trackPageview', path]); . . . ]
<script>
//http://james.padolsey.com/javascript/parsing-urls-with-the-dom/

// This function creates a new anchor element and uses location
// properties (inherent) to get the desired URL data. Some String
// operations are used (to normalize results across browsers).

function parseURL(url) {
    'use strict';
    var a =  document.createElement('a');
    a.href = url;
    return {
        source: url,
        protocol: a.protocol.replace(':',''),
        host: a.hostname,
        port: a.port,
        query: a.search,
        params: (function(){
            var ret = {},
                seg = a.search.replace(/^\?/,'').split('&'),
                len = seg.length, i = 0, s;
            for (;i<len;i++) {
                if (!seg[i]) { continue; }
                s = seg[i].split('=');
                ret[s[0]] = s[1];
            }
            return ret;
        })(),
        file: (a.pathname.match(/\/([^\/?#]+)$/i) || [,''])[1],
        hash: a.hash.replace('#',''),
        path: a.pathname.replace(/^([^\/])/,'/$1'),
        relative: (a.href.match(/tps?:\/\/[^\/]+(.+)/) || [,''])[1],
        segments: a.pathname.replace(/^\//,'').split('/')
    };
}
</script>

<script>
(function trackoer(){
  var
    debug = true
  , license = oer_license_parser.get_license()
  , current = license.current_license
  , source_url = parseURL(current.source_url)
  , source_id = parseURL(current.source_id)
  , dl = document.location
  , encode = encodeURIComponent
  , M = Math
  , path = parseURL(dl).relative
  ;

  path += (path.indexOf('#') == -1 ? '#' :'');
  path += '!'+ encode(source_url.host) +'!'+ encode(source_id.segments[0]) +'!'+ encode(source_url.relative);

  path += debug ? '!Debug!' + M.floor((M.random()*100)+1) :'';


  _gaq.push(['_trackPageview', path]);

  //console.log(oer_license_parser);
  console.log(current, source_url, path);
})();
</script>


<pre>

NDF, 15 August 2012 (follows conversation with Guy Barrett).

* https://developers.google.com/analytics/devguides/collection/gajs/
* https://github.com/tatemae/capret/tree/master/public/js/
* http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
* oer_license_parse_2.js  |  trackoer-ga.js

* http://dl.dropbox.com/u/3203144/track/page-learning1.html?key=val#hash

</html>