<?php

  $public_js_url = base_url() .'public/js/';
  $google_analytics_id = 'UA-34064304-2';
  $piwik_siteid = 4;

?>

<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $google_analytics_id ?>']);
  //_gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>



<h1>Track OER - Google Analytics custom Javascript</h1>


<p>[Creative Commons RDFa license snippet]

<div id=cc-code><p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/deed.en_GB"
 ><img alt="Creative Commons Licence" style="border-width:0" src=
 "http://track.olnet.org/track/r/piwik/<?php echo $piwik_siteid ?>/cc:by-nc-sa/labspace.open.ac.uk/Learning_to_Learn_1.0?p=mod%2Foucontent%2Fview.php%3Fid%3D471422%26section%3D3&t=2.3+Gathering+Evidence%E2%80%94Your+Qualities%2C+Knowledge+and+Skills+-+Learning+to+Learn+-+LabSpace+%28Course%29&debug=2"
 class="wb" title="Creative Commons License - with tracking**" 
 /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">2.3 Gathering Evidence&ndash;Your Qualities, Knowledge and Skills - Learning to Learn - LabSpace (Page)</span>
 by <a xmlns:cc="http://creativecommons.org/ns#" href="http://labspace.open.ac.uk" property="cc:attributionName" rel="cc:attributionURL">OpenLearn/Andrew Studnicky</a>
 is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/deed.en_GB">Creative Commons Attribution-NonCommercial-ShareAlike 2.0 UK: England & Wales License</a>,
 <a class="wt" href="#!Explain..">with tracking</a>.
 <br />
 Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&amp;section=3#frag" rel="dct:source"
 >http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&amp;section=3</a>.
<!--Extend Creative Commons with a course 'identifier'	-->
 <br />
 Identifier: <a xmlns:dct="http://purl.org/dc/terms/" href="http://labspace.open.ac.uk/Learning_to_Learn_1.0" rel="dct:identifier">Learning_to_Learn_1.0</a>
</div>



<script src="<?php echo $public_js_url ?>oer_license_parser.js"></script>
<?php /*<script src="<?php echo $public_js_url ?>parseuri.js"></script>*/ ?>
<script src="<?php echo $public_js_url ?>parseurl-dom.js"></script>
<script src="<?php echo $public_js_url ?>trackoer-page-url.js"></script>
<script>
  // Just the one line -- after the RDFa!
  _gaq.push(['_trackPageview', trackoer.getPageUrl()]);
</script>



<pre>


NDF, 15 August 2012 (follows conversation with Guy Barrett).

* https://developers.google.com/analytics/devguides/collection/gajs/
* https://github.com/tatemae/capret/tree/master/public/js/
* http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
* http://blog.stevenlevithan.com/archives/parseuri
* oer_license_parse_2.js  |  trackoer-ga.js

* http://dl.dropbox.com/u/3203144/track/page-learning1.html?key=val#hash

</pre>
