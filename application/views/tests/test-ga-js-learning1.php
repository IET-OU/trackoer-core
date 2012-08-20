<?php

  #$public_js_url = base_url() .'public/js/';
  #$google_analytics_id = 'UA-34064304-2';
  /*
   We assume there will be 2+ Google Analytics accounts.
   http://stackoverflow.com/questions/2651834/google-analytics-async-tracking-with-two-accounts
  */
  #$ga_property_id = '_trackoer_content';
  #$piwik_siteid = 4;

?>


<h1>Track OER - Google Analytics custom Javascript</h1>


<p>[Creative Commons RDFa license snippet]


<div id=cc-code><p>
<?php echo $cc_code ?>
</div>


<?php /*
<pre>


NDF, 15 August 2012 (follows conversation with Guy Barrett).

* https://developers.google.com/analytics/devguides/collection/gajs/
* https://github.com/tatemae/capret/tree/master/public/js/
* http://james.padolsey.com/javascript/parsing-urls-with-the-dom/
* http://blog.stevenlevithan.com/archives/parseuri
* oer_license_parse_2.js  |  trackoer-ga.js

* http://dl.dropbox.com/u/3203144/track/page-learning1.html?key=val#hash

</pre>
*/ ?>

<script>

console.log(document.location);

</script>