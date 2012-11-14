
<!-- -*- markdown -*- -->

# CaPRéT: Cut and Paste Reuse Tracking

CaPRéT was an innovative JISC-funded project developed by Tatemae and the [MIT Office of Educational Innovation and Technology][mit-oeit].

As part of the Track OER project we took the original [CaPReT code][capret-code], and re-purposed it to track cut and paste events via different analytics software. There are now three variants.

[Visit the original CaPReT site][capret].

## Classic {#capret}

We made some small fixes to the original CaPRéT code, and [minified the Javascript][capret-js]. [Test of CaPReT-classic][capret-test].

## Piwik  {#piwik}

We extended CaPRéT, so that instead of using the [*classic*][capret] system it logs cut and paste events in a Piwik site. [Minified Javascript][capret-piwik-js] | [Test][capret-piwik-test].

## Google Analytics {#ga}

And, we extended CaPRéT, so that instead of using the [*classic*][capret] system it logs cut and paste events in Google Analytics. [Minified Javascript][capret-ga-js] | [Test][capret-ga-test].

## Internet Explorer {#ie}

End users may find [this help document useful](<?php echo CAPRET_HELP_URL ?>).

<iframe
 class=capret-site
 width="100%" height="400" frameborder=0
 src="http://capret.mitoeit.org/"
 ></iframe>

[mit-oeit]: http://oeit.mit.edu/
[capret-code]: https://github.com/tatemae/capret "Thanks for the code guys!"
[capret-js]: <?php echo base_url() ?>capret/build/capret.min.js "CaPRéT 'classic' scripts - just add jQuery.."
[capret-piwik-js]: <?php echo base_url() ?>capret/build/capret-piwik.min.js "CaPReT scripts with Piwik"
[capret-ga-js]: <?php echo base_url() ?>capret/build/capret-ga.min.js "CaPReT scripts with Google Analytics"
[capret-test]: <?php echo site_url('test/capret/math/course-view') ?> "CaPReT-classic test"
[capret-piwik-test]: <?php echo site_url('test/capret/math/course-piwik') ?> "CaPReT-Piwik test"
[capret-ga-test]: <?php echo site_url('test/capret/math/course-ga') ?> "CaPReT-Google Analytics test"
