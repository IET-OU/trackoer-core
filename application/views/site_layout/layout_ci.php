<?php
  $base_url = base_url();
  $assets_url = $base_url .'application/assets/';
  $piwik_url = $this->config->item('piwik_url');

  $with_nav = TRUE;


?>
<!doctype html><html lang="en"><meta charset="utf-8" /><title>Track OER - rapid innovation alpha</title>
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5-els.js"></script>
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="ROBOTS" content="noindex,nofollow" />

<link rel=stylesheet href="<?php echo $assets_url ?>layout-ci.css" />
<link rel=stylesheet href="<?php echo $assets_url ?>forkme.css" />

<body>


<div id="container">

<?php if ($with_nav): ?>
	<nav id="nav">
		<ul class="ou-sections">
		<li class="tm-toer-home"><a href="<?php echo $base_url ?>">Track OER home</a>
		<li class="tm-about"><a href="<?php echo $base_url ?>about">About</a>
		<li class="tm-piwik"><a href="<?php echo $piwik_url ?>" title="Our Piwik analytics">Piwik</a>
		<li class="tm-form"><a href="<?php echo $base_url ?>trackoer" title="Get a license-tracker snippet">OER form</a>
		<?php /* Todo!
		<li class="tm-choose"><a href="<?php echo $base_url ?>choose">CC Choose</a>*/ ?>
		<li class="tm-test"><a href="<?php echo $base_url ?>test" title="Demonstrations">Tests/ demos</a>
		<li class="tm-extern cw blog"><a href="http://cloudworks.ac.uk/tag/view/trackoer" title="Our blog, on Cloudworks">Project blog</a>
		<li class="tm-extern olrn"><a href="http://labspace.open.ac.uk/b2s" title="Bridge to Success content, on OpenLearn-Labspace">Bridge to Success</a>
		<li class="tm-extern olnet"><a href="http://www.olnet.org/" title="Open Learning Network">OLnet</a>
		</ul>
	</nav>
<?php endif; ?>



	<?php echo $content_for_layout ?>



<?php if ($with_nav): ?>
	<div id="ou-org-footer">
		<ul>
		<li class="f-logo ou"><a href="http://open.ac.uk/"><img title="&copy;2012 The Open University" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/OpenUniversityLogo.png"></a>
		<li class="f-logo f-extern jisc"><a href="http://jisc.ac.uk/"><img title="Joint Information Systems Committee" src="http://www.open.ac.uk/blogs/OULDI/wp-content/uploads/2010/11/JISCcolour23.jpg"></a>
		<li class="f-logo f-extern hefce"><a href="http://hefce.ac.uk/"><img title="Higher Education Funding Council for England" src="http://www8.open.ac.uk/score/sites/all/themes/zen_score/footerLogos/HEFCELogo.png" data-X-src="http://jisc.ac.uk/aboutus/~/media/JISC/aboutus/funders/HEFCE48.ashx"></a>
		<li class="f-tx"><a href="http://www.open.ac.uk/privacy-ol">Privacy and cookies</a>
		<li class="f-tx"><a href="http://www.open.ac.uk/conditions">Conditions of use</a>
		<li class="f-tx"><a href="#">Contact us/ Feedback</a>
		<li class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</li>
		<li id="forkme-banner"><a href="https://github.com/IET-OU/trackoer-core" title="Fork me on GitHub">Fork me on GitHub</a></li>
		</ul>
	</div>
<?php else: ?>
	<p class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	<div id="forkme-banner"><a href="https://github.com/IET-OU/trackoer-core" title="Fork me on GitHub">Fork me on GitHub</a></div>
<?php endif; ?>

</div>

<?php /*
<a href="http://github.com/you"><img style="position: absolute; top: 0; left: 149px; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/7afbc8b248c68eb468279e8c17986ad46549fb71/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub"></a>
*/ ?>


</body>
</html>