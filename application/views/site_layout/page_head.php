<?php
  $assets_url = base_url() .'assets/';
  $feed_url = str_replace('/view/', '/rss/', BLOG_URL);

  $ggl_font = $this->config->item('google_font');
  $robots = $this->config->item('robots');

?>
<meta charset="utf-8" /><title>Track OER &lsaquo; Analytics for open educational resources - OER &rsaquo;<?php /*rapid innovation alpha*/ ?></title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5-els.js"></script>
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php if (!$robots): ?>
<meta name="ROBOTS" content="noindex,nofollow" />
<?php endif; ?>

<link rel=alternate type="application/rss+xml" title="Track OER project blog RSS feed" href="<?php echo $feed_url ?>" />
<?php if (isset($oembed_url)): ?>
<link rel=alternate type="application/json+oembed" title="License-tracker code: <?php #echo $rdf->title ?>"
	href="<?php echo $oembed_url ?>&amp;format=json" />
<link rel=alternate type="application/xml+oembed"
	href="<?php echo $oembed_url ?>&amp;format=xml" />
<?php endif; ?>


<link rel=stylesheet href="<?php echo $assets_url ?>layout-ci.css" />
<link rel=stylesheet href="<?php echo $assets_url ?>forkme.css" />

<?php if ($ggl_font): ?>
<link rel=stylesheet href="http://fonts.googleapis.com/css?family=<?php echo urlencode($ggl_font) ?>&amp;v1" />
<style>
h1{ font-family:"<?php echo $ggl_font ?>", Helvetica, sans-serif; }
</style>
<?php endif; ?>

<script src="http://cdn.enderjs.com/jeesh.js"></script>
<script src="<?php echo $assets_url ?>site/js/trackoer-site.js"></script>


<?php $this->load->view('site_layout/site_analytics') ?>
