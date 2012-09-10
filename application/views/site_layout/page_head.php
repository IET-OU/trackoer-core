<?php
  $assets_url = base_url() .'assets/';
  $feed_url = str_replace('/view/', '/rss/', BLOG_URL);

  $ggl_font = $this->config->item('google_font');
  $robots = $this->config->item('robots');


?>
<?php
/*
 * Basic site setup - encoding, HTML5 Javascript shim/shiv, mobiles, robots.
 */
?>
<meta charset="utf-8" /><title>Track OER &lsaquo; Analytics for open educational resources - OER &rsaquo;<?php /*rapid innovation alpha*/ ?></title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5-els.js"></script>
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php if (!$robots): ?>
<meta name="ROBOTS" content="noindex,nofollow" />
<?php endif; ?>


<?php
/*
 * Meta-data - including Facebook Open Graph {@link http://davidwalsh.name/facebook-meta-tags}
 */ ?>
<meta property="og:site_name" content="Track OER project"/>
<meta name="og:description" content=
"Track OER is a JISC and HEFCE-funded project to demonstrate technical solution to Web analytics for Open Educational Resources." />

<meta name="copyright" content="&copy;2012 The Open University." />
<meta name="description" content=
"Track OER is a JISC and HEFCE-funded project to facilitate Web analytics for Open Educational Resources. It is a rapid innovation project to demonstrate technical solutions, based around software like Piwik, Google Analytics and CaPRéT." />


<?php
/*
 * API connections - feeds / oEmbed output.
 */ ?>
<link rel=alternate type="application/rss+xml" title="Track OER project blog RSS feed" href="<?php echo $feed_url ?>" />
<?php if (isset($oembed_url)): ?>
<link rel=alternate type="application/json+oembed" title="License-tracker code: <?php #echo $rdf->title ?>"
	href="<?php echo $oembed_url ?>&amp;format=json" />
<link rel=alternate type="application/xml+oembed"
	href="<?php echo $oembed_url ?>&amp;format=xml" />
<?php endif; ?>


<?php
/*
 * Stylesheets, Javascript.
 */ ?>
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
