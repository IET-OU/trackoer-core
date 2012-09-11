<?php if ($this->input->get('edge')): ?>

<?php
	$base_url = base_url();
?>
<span id="bookmarklet" title="Drag the bookmarklet link to your bookmarks toolbar">Bookmarklet: <a href=
"javascript:(function(){var d=document,s=d.createElement('script');s.type='text/javascript';s.src='<?php
echo $base_url ?>public/js/toer-bookmarklet.js?x='+(Math.random());d.getElementsByTagName('head')[0].appendChild(s);d.trackoer_srvurl='<?php
echo $base_url ?>'})();"
	>Track OER</a></span>

<?php endif; ?>