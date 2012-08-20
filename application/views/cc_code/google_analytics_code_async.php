<?php
	$property = isset($property) ? $property .'.' : '';
	$script_url = base_url() .'public/js/';
?>
<?php if ($custom_hash): ?>
<script src="<?php echo $script_url ?>trackoer-ga.js"></script>
<?php elseif ($with_trackoer): ?>
<script src="<?php echo $script_url ?>oer_license_parser.js"></script>
<script src="<?php echo $script_url ?>parseurl-dom.js"></script>
<?php /*<script src="<?php echo $script_url ?>parseuri.js"></script>*/ ?>
<script src="<?php echo $script_url ?>trackoer-page-url.js"></script>
<?php endif; ?>
<script>
<?php if (! $custom_hash): ?>
  var _gaq = _gaq || [];
<?php endif; ?>
  _gaq.push(['<?php echo $property ?>_setAccount', '<?php echo $account ?>']);
<?php if ($custom_hash): ?>
  _gaq.push(['<?php echo $property ?>_trackPageview', trackoer.getPageUrl('<?php echo htmlentities($custom_hash) ?>')]);
<?php elseif ($with_trackoer): ?>
  _gaq.push(['<?php echo $property ?>_trackPageview', trackoer.getPageUrl()]);
<?php else: ?>
  _gaq.push(['<?php echo $property ?>_trackPageview']);
<?php endif; ?>
<?php if (! $custom_hash): ?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
<?php endif; ?>
</script>
