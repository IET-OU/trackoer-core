<?php
  $base_url = base_url();
  $assets_url = $base_url .'assets/';
  $piwik_url = $this->config->item('piwik_url');
  $feed_url = str_replace('/view/', '/rss/', BLOG_URL);

  // Create HTML body classes - 'page' and/or 'route'.
  $segment_1 = $this->uri->segment(1);
  $body_classes = $segment_1 ? 'pg-'.strtolower(get_class(get_instance())) ." rt-$segment_1" : 'pg-home';

  $with_nav = TRUE;

  $with_unit_tests = isset($with_unit_tests) && $with_unit_tests;

?>
<!doctype html><html lang="en"><meta charset="utf-8" /><title>Track OER - rapid innovation alpha</title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5-els.js"></script>
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="ROBOTS" content="noindex,nofollow" />

<link rel=alternate type="application/rss+xml" title="Track OER project blog RSS feed" href="<?php echo $feed_url ?>" />
<?php if (isset($oembed_url)): ?>
<link rel=alternate type="application/json+oembed" title="License-tracker code: <?php #echo $rdf->title ?>"
	href="<?php echo $oembed_url ?>&amp;format=json" />
<link rel=alternate type="application/xml+oembed"
	href="<?php echo $oembed_url ?>&amp;format=xml" />
<?php endif; ?>

<link rel=stylesheet href="<?php echo $assets_url ?>layout-ci.css" />
<link rel=stylesheet href="<?php echo $assets_url ?>forkme.css" />

<script src="http://cdn.enderjs.com/jeesh.js"></script>

<body class="<?php echo $body_classes ?>">


<div id="container">

<?php if ($with_nav): ?>
	<nav id="nav">
		<ul class="ou-sections">
		<li class="tm-toer-home"><a href="<?php echo $base_url ?>">Track OER home</a>
		<li class="tm-about"><a href="<?php echo $base_url ?>about">About</a>
		<li class="tm-piwik"><a href="<?php echo $piwik_url ?>" title="Piwik analytics for Track OER">Piwik</a>
		<li class="tm-form"><a href="<?php echo $base_url ?>oerform" title="Get a license-tracker snippet">OER form</a>
		<?php /* Todo!
		<li class="tm-choose"><a href="<?php echo $base_url ?>choose">CC Choose</a>*/ ?>
		<li class="tm-test"><a href="<?php echo $base_url ?>test" title="Demonstrations">Tests/ demos</a>
		<li class="tm-extern cw blog"><a href="<?php echo BLOG_URL ?>" title="Track OER project blog, on Cloudworks">Project blog</a>
		<?php if(defined('B2S_CONTENT_URL')): ?><li class="tm-extern b2s olrn"><a href="<?php echo B2S_CONTENT_URL ?>" title="Bridge to Success content, on OpenLearn-Labspace">Bridge to Success content</a><?php endif; ?>
		<?php if(defined('OLNET_URL')): ?><li class="tm-extern olnet"><a href="<?php echo OLNET_URL ?>" title="Open Learning Network">OLnet</a><?php endif; ?>
		<?php if(defined('OU_OER_URL')): ?><li class="tm-extern ou-oer"><a href="<?php echo OU_OER_URL ?>" title="About Open Educational Resources at The Open University">OER at The Open University</a><?php endif; ?>
		</ul>
	</nav>
<?php endif; ?>

<?php if ('test' == $segment_1): ?>
	<ul id=test-nav>
		<li><a href="<?php echo site_url('test/b2s_learn') ?>">Learning to Learn/ B2S</a>
		<li><a href="<?php echo site_url('test/b2s_learn_section') ?>">Learning to Learn section/page</a>
		<li><a href="<?php echo site_url('test/b2s_learn_gajs') ?>?param1=value1#hash">Google Analytics custom script</a>
	</ul>
	<div class=warn><p>Note, this is a test/ demonstration page, which contains a Creative Commons license <a href="#cc-code">image-tracker</a>.</div>
<?php endif; ?>

<?php if ($with_unit_tests): ?>
<p class=go-test-result>&rarr; <a href="#test-result">Unit test results</a></p>
<?php endif; ?>



	<?php echo $content_for_layout ?>



<?php if ($with_unit_tests): ?>

<?php elseif ($with_nav): ?>

	<div id="ou-org-footer">
		<ul>
		<li class="f-logo ou"><a href="http://open.ac.uk/"><img title="&copy;2012 The Open University" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/OpenUniversityLogo.png"></a>
		<li class="f-logo f-extern jisc"><a href="http://jisc.ac.uk/"><img title="Joint Information Systems Committee" src="http://www.open.ac.uk/blogs/OULDI/wp-content/uploads/2010/11/JISCcolour23.jpg"></a>
		<li class="f-logo f-extern hefce"><a href="http://hefce.ac.uk/"><img title="Higher Education Funding Council for England" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/HEFCELogo.png" data-X-src="http://jisc.ac.uk/aboutus/~/media/JISC/aboutus/funders/HEFCE48.ashx"></a>
		<li class="f-tx"><a href="http://www.open.ac.uk/privacy-ol">Privacy and cookies</a>
		<li class="f-tx"><a href="http://www.open.ac.uk/conditions">Conditions of use</a>
		<li class="f-tx"><a href="<?php echo CONTACT_URL ?>">Contact us/ Feedback</a>
		<li class="f-rss"><a href="<?php echo $feed_url ?>" title="RSS feed for the Project blog, on Cloudworks">Feed</a>
		<li class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</li>
		<li id="forkme-banner"><a href="<?php echo CODE_URL ?>" title="Fork me on GitHub">Fork me on GitHub</a></li>
		</ul>
	</div>
<?php else: ?>
	<p class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	<div id="forkme-banner"><a href="<?php echo CODE_URL ?>" title="Fork me on GitHub">Fork me on GitHub</a></div>
<?php endif; ?>

</div>


<script src="<?php echo $assets_url ?>site/js/trackoer-site.js"></script>


<?php
	$this->view('tests/busterjs_unit');
?>


</body>
</html>