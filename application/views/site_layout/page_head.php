<?php
  $assets_url = base_url() .'assets/';
  $feed_url = str_replace('/view/', '/rss/', BLOG_URL);

  $ggl_font = $this->config->item('google_font');
  $robots = $this->config->item('robots');
  $meta_tags = $this->config->item('meta_tags');
  $meta_tags = $meta_tags ? $meta_tags : array();

  $page_title = isset($page_title) ? $page_title : NULL;
  $rev = isset($rev) ? $rev : NULL;

?>
<?php
/*
 * Basic site setup - encoding, HTML5 Javascript shim/shiv, mobiles, robots.
 */
?>
<head>
<meta charset="utf-8" /><title><?php if($page_title): echo $page_title ?> - Track OER<?php else: ?>Track OER &lsaquo; Analytics for open educational resources - OER &rsaquo;<?php endif; /*rapid innovation alpha*/ ?></title>
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
 *
 * @link http://ogp.me/
 * @link http://developers.facebook.com/tools/debug/og/object?q=track.olnet.org
 * @link http://graph.facebook.com/375383159206190?callback=FN
 */ ?>
<?php foreach ($meta_tags as $tag):
    $keys = array_keys($tag); ?>
<meta <?php echo $keys[0] ?>="<?php echo $tag[$keys[0]] ?>" <?php echo $keys[1] ?>="<?php echo $tag[$keys[1]] ?>" />
<?php endforeach; ?>

<meta property="og:title" content="Track OER project" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo base_url() ?>" />
<?php /* Logo based on {@link https://github.com/IET-OU/trackoer-core/graphs/commit-activity} */ ?>
<meta property="og:image" content="<?php echo $assets_url ?>site/trackoer-ca-logo-big.png" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="222" />
<meta property="og:image:height" content="201" />
<meta property="og:description" content=
"Track OER is a JISC-funded project at The Open University to demonstrate technical solutions to Web analytics for Open Educational Resources." />
<?php /*<meta prefix="fb: http://ogp.me/ns/fb#" property="fb:app_id" content="115190258555800">
<link rel="alternate" type="application/rdf+xml" href="http://ogp.me/ns/ogp.me.rdf">*/ ?>
<?php if (isset($rev->timestamp)): ?>
<meta property="og:updated_time" content="<?php echo $rev->timestamp ?>" />
<?php endif; ?>

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
<link rel=stylesheet href="<?php echo $assets_url ?>site/css/mobile.css" />

<?php if ($ggl_font): ?>
<link rel=stylesheet href="http://fonts.googleapis.com/css?family=<?php echo urlencode($ggl_font) ?>&amp;v1" />
<style>
h1{ font-family:"<?php echo $ggl_font ?>", Helvetica, sans-serif; }
</style>
<?php endif; ?>

<script src="http://cdn.enderjs.com/jeesh.min.js"></script>
<script src="<?php echo $assets_url ?>site/js/trackoer-site.js"></script>


<?php $this->load->view('site_layout/site_analytics') ?>
</head>