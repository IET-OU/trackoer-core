<?php
	$property = isset($property) ? $property .'.' : '';
	$script_url = base_url() .'public/js/';
?>


<?php if ($with_trackoer): ?>
<script src="<?php echo $script_url ?>oer_license_parser.js"></script>
<script src="<?php echo $script_url ?>parseurl-dom.js"></script>
<script src="<?php echo $script_url ?>trackoer-page-url.js"></script>
<?php endif; ?>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['<?php echo $property ?>_setAccount', '<?php echo $account ?>']);
<?php if ($with_trackoer): ?>
  _gaq.push(['<?php echo $property ?>_trackPageview', trackoer.getPageUrl()]);
<?php else: ?>
  _gaq.push(['<?php echo $property ?>_trackPageview']);
<?php endif; ?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
