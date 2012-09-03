<?php
  $piwik_url = $this->config->item('piwik_url');
  $piwik_ssl = 'https://demo.piwik.org/';

  // Assume that we use GA for this site with the ID 'UA-12345-1'.
  $ga_site_id = $this->config->item('google_analytics_default_id');
  $ga_site_id = preg_replace('/-\d$/', '-1', $ga_site_id);
?>


<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $ga_site_id ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>


<!-- Piwik --> 
<script>
  var pkBaseURL = (("https:" == document.location.protocol) ? "<?php echo $piwik_ssl ?>" : "<?php echo $piwik_url ?>/");
  document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script>
try {
  var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
  piwikTracker.trackPageView();
  piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://track.olnet.org/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

