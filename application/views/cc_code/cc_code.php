
<a rel="license" href="http://creativecommons.org/licenses/<?php echo $cc_license ?>/deed.<?php echo $cc_loc ?>"
 ><img
 alt="Creative Commons Licence"
 style="border-width:0"
<?php if($with_tracker): ?>
 src=
"<?php echo site_url('track/r') ?>/<?php echo $serv ?>/<?php echo $site_id ?>/cc:<?php echo $cc_terms ?>/<?php echo $source_host ?>/<?php echo $source_identifier ?>?<?php
  if ($source_path): ?>p=<?php echo urlencode($source_path) ?>&amp;<?php endif; ?>t=<?php echo urlencode($title) ?>&amp;debug=2"
 class="wb"
 title="Creative Commons License - with tracking**"
<?php else: ?>
 src="http://i.creativecommons.org/l/<?php echo $cc_license ?>/<?php echo $cc_siz ?>.png"
<?php endif; ?>
 /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title"><?php echo $title ?></span>
 by <a xmlns:cc="http://creativecommons.org/ns#" href="<?php echo $author_url ?>" property="cc:attributionName"
 rel="cc:attributionURL"><?php echo $author ?></a><?php echo $cc_label ?>
<?php /*
 is licensed under a
 <a rel="license" href="http://creativecommons.org/licenses/<?php echo $cc_license ?>/deed.<?php echo $cc_loc ?>">Creative Commons Attribution-NonCommercial-ShareAlike 2.0 UK: England &amp; Wales License</a>
*/ ?><?php
  if($explain_tracking_url): ?>, <a class="wt" href="<?php echo $explain_tracking_url ?>">with tracking</a><?php endif; ?>.
 <br />
 Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="<?php echo $source_url ?>" rel="dct:source"><?php echo $source_url ?></a>.
 <!--Extend Creative Commons with a course 'identifier'-->
 <br />
 Identifier: <a xmlns:dct="http://purl.org/dc/terms/" href="<?php echo $source_identifier ?>" rel="dct:identifier"><?php echo $source_identifier ?></a>
