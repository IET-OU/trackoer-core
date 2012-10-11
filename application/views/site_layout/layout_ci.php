<?php
  $piwik_url = $this->config->item('piwik_url');
  $test_menu = $this->config->item('test_menu');
  $feed_url = str_replace('/view/', '/rss/', BLOG_URL);

  // Create HTML body classes - 'page' and/or 'route'.
  $segment_1 = $this->uri->segment(1);
  $body_classes = $segment_1 ? 'pg-'.strtolower(get_class(get_instance())) ." rt-$segment_1" : 'pg-home';

  $with_nav = TRUE;

  $with_unit_tests = isset($with_unit_tests) && $with_unit_tests;


?>
<!doctype html><html lang="en">
<?php


  $this->load->view('site_layout/page_head');

?>


<body class="<?php echo $body_classes ?>">


<div id="container">

<?php if ($with_nav): ?>
	<nav id="nav">
		<ul class="ou-sections">
		<li class="tm-toer-home"><a href="<?php echo site_url() ?>">Track OER home</a>
		<li class="tm-about"><a href="<?php echo site_url('about') ?>">About</a>
		<li class="tm-piwik"><a href="<?php echo $piwik_url ?>" title="Piwik analytics for Track OER">Piwik</a>
		<li class="tm-form"><a href="<?php echo site_url('oerform') ?>" title="Get a license-tracker snippet">OER form</a>
		<?php /* Todo!
		<li class="tm-choose"><a href="<?php echo site_url('choose') ?>">CC Choose</a>*/ ?>
		<li class="tm-test"><a href="<?php echo site_url('test') ?>" title="Demonstrations">Tests/ demos</a>
		<li class="tm-extern cw blog"><a href="<?php echo BLOG_URL ?>" title="Track OER project blog, on Cloudworks">Project blog</a>
		<?php if(defined('B2S_CONTENT_URL')): ?><li class="tm-extern b2s olrn"><a href="<?php echo B2S_CONTENT_URL ?>" title="Bridge to Success content, on OpenLearn-Labspace">Bridge to Success content</a><?php endif; ?>
		<?php if(defined('OLNET_URL')): ?><li class="tm-extern olnet"><a href="<?php echo OLNET_URL ?>" title="Open Learning Network">OLnet</a><?php endif; ?>
		<?php if(defined('OU_OER_URL')): ?><li class="tm-extern ou-oer"><a href="<?php echo OU_OER_URL ?>" title="About Open Educational Resources at The Open University">OER at The Open University</a><?php endif; ?>
		</ul>
	</nav>
<?php endif; ?>


<?php if ('test' == $segment_1): ?>
	<?php if ($test_menu): ?>
	<ul id=test-nav>
	<?php foreach ($test_menu as $text => $path): ?>
		<li><a href="<?php echo FALSE===strpos($path, '://') ? site_url($path) : $path ?>"><?php echo $text ?></a>
	<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<div class=warn><p>Note, this is a test/ demonstration page, which contains a Creative Commons license <a href="#cc-code">image-tracker</a>.</div>
<?php endif; ?>


<?php if ($with_unit_tests): ?>
<p class=go-test-result>&rarr; <a href="#test-result">Unit test results</a></p>
<?php endif; ?>



	<?php echo $content_for_layout ?>



<?php if ($with_unit_tests): ?>

<?php elseif ($with_nav): ?>

<?php /*<style>
#logo1{ position:relative; z-index:1; }
#logo2{ position:relative; z-index:999; top:-205px; height:202px; opacity:.7; background:#fefefe; color:#220d00; /*#441d10; #111*-/ font:bold 4.55em Amaranth; text-align:center;
 padding-top:121px; padding-right:2px; word-spacing:-.2em; letter-spacing:-.06em; }
#logo2 span{ font-weight:normal; x-font-style:italic; }
</style>*/ ?>


	<div id="ou-org-footer">
		<ul>
		<li class="f-logo ou"><a href="http://www.open.ac.uk/"><img title="&copy;2012 The Open University" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/OpenUniversityLogo.png"></a>
		<li class="f-logo f-extern jisc"><a href="http://www.jisc.ac.uk/"><img title="Joint Information Systems Committee" src="http://www.open.ac.uk/blogs/OULDI/wp-content/uploads/2010/11/JISCcolour23.jpg"></a>
		<li class="f-logo f-extern hefce"><a href="http://www.hefce.ac.uk/"><img title="Higher Education Funding Council for England" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/HEFCELogo.png" data-X-src="http://jisc.ac.uk/aboutus/~/media/JISC/aboutus/funders/HEFCE48.ashx"></a>
		<li class="f-logo site"><a href="<?php echo site_url() ?>"><img id="logo1" title="Track OER home" src="<?php echo base_url() ?>assets/site/trackoer-ca-logo.png"></a>
			<?php /*<div id="x-logo2"></div>
			<div id="logo2"><div>Track <span>OER</span></div></div>*/ ?>
		<li class="f-tx"><a href="http://www.open.ac.uk/privacy-ol">Privacy and cookies</a>
		<li class="f-tx"><a href="http://www.open.ac.uk/conditions">Conditions of use</a>
		<li class="f-tx"><a href="<?php echo CONTACT_URL ?>">Contact us/ Feedback</a>
		<li class="f-rss"><a href="<?php echo $feed_url ?>" title="RSS feed for the Project blog, on Cloudworks">Feed</a>
		<li class="ci-footer"><abbr title="Page rendered in {elapsed_time} seconds">{elapsed_time}s</abbr></li>
		<li id="forkme-banner"><a href="<?php echo CODE_URL ?>" title="Fork me on GitHub"><span>Fork me on </span>GitHub</a></li>
		</ul>
	<?php

	$this->view('site_layout/bookmarklet')

	?>
	</div>
<?php else: ?>
	<p class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	<div id="forkme-banner"><a href="<?php echo CODE_URL ?>" title="Fork me on GitHub">Fork me on GitHub</a></div>
<?php endif; ?>

</div>


<?php /*<script src="<?php echo $assets_url ?>site/js/trackoer-site.js"></script>*/ ?>

<?php
	$this->view('tests/busterjs_unit');
?>


</body>
</html>