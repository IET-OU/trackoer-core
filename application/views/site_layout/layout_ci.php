<?php
  $assets_url = base_url() .'application/assets/';
?>
<!doctype html><html lang="en"><meta charset="utf-8" /><title>Track OER</title>

<!--[if lt IE 9]>
<link rel="stylesheet" href="http://www3.open.ac.uk/includes/ouice/3/ie.css" />
<![endif]-->

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="ROBOTS" content="noindex,nofollow" />

<link rel=stylesheet href="<?php echo $assets_url ?>layout-ci.css" />
<link rel=stylesheet href="<?php echo $assets_url ?>forkme.css" />

<body>


<div id="container">


	<?php echo $content_for_layout ?>


	<p class="ci-footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

<div id="forkme-banner"><a href="https://github.com/IET-OU/trackoer-core" title="Fork me on GitHub">Fork me on GitHub</a></div>
<?php /*
<a href="http://github.com/you"><img style="position: absolute; top: 0; left: 149px; border: 0;" src="https://a248.e.akamai.net/assets.github.com/img/7afbc8b248c68eb468279e8c17986ad46549fb71/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub"></a>
*/ ?>


</body>
</html>