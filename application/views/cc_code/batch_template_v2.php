<?php
/**
 * Template for batch processing -- OpenLearn v2.
 * HTML + (Creative Commons RDFa) + custom Google Analytics Javascript.
 *
 * @copyright 2012-09-14 The Open University.
 */

$use_gatrack = isset($use_gatrack) ? $use_gatrack : FALSE;


?>

<div class="oucontent-copyright trackoer-code" style="display:block">
<p>
	<img src="../Shared/copyright.png" alt="Creative Commons non-commercial share alike icon" style="float: right;"/>
	Except for third party materials and otherwise, this content is made available
    under a Creative Commons Attribution-NonCommercial-ShareAlike 2.0 Licence. See <a xmlns:cc="http://creativecommons.org/ns#" rel="cc:morePermissions" href="copyright-full.html">full copyright statement</a> for details.
</p>
<script __SCRIPT_ARG__ src="__SCRIPT_PATH__/trackoer-ga.js"></script>
<script __SCRIPT_ARG__>
<?php if ($use_gatrack): ?>
gaTrack('__GA_ID__', window.location.host, trackoer.getPageUrl('!__COURSE_HOST__!__COURSE_ID__!__WORK_ID__!__MODE__'));<?php //Remysharp:gajs.js*/ ?>
<?php else: ?>
_gaq.push(['_trackoer_ct._setAccount', '__GA_ID__']);
<?php /*_gaq.push(['_trackoer_ct._setCustomVar', 1, 'via', 'CLI', 3]); //&utme=8(via)9(CLI)&..
_gaq.push(['_trackoer_ct._trackEvent', 'Cat', 'Act']); */ ?>
_gaq.push(['_trackoer_ct._trackPageview', trackoer.getPageUrl('!__COURSE_HOST__!__COURSE_ID__!__WORK_ID__!__MODE__')]);
<?php endif; ?>

</script>
</div>
