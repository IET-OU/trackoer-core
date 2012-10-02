<?php if ($this->input->get('edge')): ?>

<?php
	$base_url = base_url();
?>
<span id="bookmarklet" title=
"Drag the bookmarklet link to your browser's favorites/ bookmarks bar, or..
&lt;br />
Right-click on the bookmarklet and choose &ldquo;Add to Favorites...&rdquo;"
><span>Bookmarklet </span><a
 title="Track OER<?php if(TRACKOER_LIVE_URL != $base_url): ?> dev<?php endif; ?>" role="button" rel="bookmark" type="application/javascript" href=
"javascript:(function(){var d=document,s=d.createElement('script');s.type='text/javascript';s.src='<?php
  echo $base_url ?>public/js/toer-bookmarklet.js?x='+(Math.random());d.getElementsByTagName('head')[0].appendChild(s);d.trackoer_srvurl='<?php
  echo $base_url ?>';d.trackoer_errtext='<?php echo t(
  'Sorry, this host is not supported by Track OER.\n\nThe license-tracker service currently supports:\nOpenlearn.open.ac.uk, Labspace.open.ac.uk and OERCommons.org'
) ?>'})();"
	>Track OER<?php if(TRACKOER_LIVE_URL != $base_url): ?> dev<?php endif; ?></a></span>

<?php endif; ?>