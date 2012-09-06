<?php
/**
 * Template for batch processing (B2S).
 * HTML + Creative Commons RDFa + custom Google Analytics Javascript.
 *
 * @copyright 2012-08-23 The Open University.
 */

$use_gatrack = isset($use_gatrack) ? $use_gatrack : FALSE;


/*
  Example usage:


  $embed_code = strtr(
    $this->load->view('cc_code/b2s_template', $view_data = NULL, $return = TRUE),
    array(
      '__GA_ID__' => 'UA-12345678-9',
      '__CC_TERMS__' => 'by-sa',   # License terms, eg. 'by', 'by-nc-sa'
      '__CC_VJ__'    => '3.0',     # License version[/jurisdiction], eg. '2.0/uk' or '3.0'
      '__CC_LABEL__' => 'Creative Commons Attribution-ShareAlike 3.0 Unported License',
      '_ATTR_NAME_'  => 'OpenLearn-LabSpace - Bridge to Success B2S', #'OpenLearn/ Andrew Studnicky',
      '_ATTR_URL_'   => 'http://labspace.open.ac.uk/b2s',
      '_TITLE_' => 'Learning to Learn 1.0/ Course Overview/ Introduction (page)',
      '_SOURCE_URL_' => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0',
	  '_SOURCE_TEXT_'=> NULL,
      '__COURSE_HOST__'=> 'labspace.open.ac.uk',
      '__COURSE_ID__'  => 'Learning_to_Learn_1.0',
      '__WORK_ID__'    => 'x_learning_to_learn_0_1.html', # Source filename, etc.
      '__MODE__'       => 'plain-zip',        # 'scorm', 'ims' etc.
      '__SCRIPT_PATH__'=> '../Shared', # Relative path.
      '__SCRIPT_ARG__' => 'type="text/javascript"', # HTML5 ''.
      '__STYLE__' => 'font-size:x-small',
    )
  );
*/
?>

<div id="trackoer-code" style="__STYLE__">
<a rel="license" href="__CC_ICON_URL__"
 ><img alt="Creative Commons Licence" style="border-width:0"
 src="__CC_ICON_SRC__"
<?php /* title="Creative Commons License - with tracking**"*/ ?> /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">_TITLE_</span>
 by
 <a xmlns:cc="http://creativecommons.org/ns#" href="_ATTR_URL_" property="cc:attributionName" rel="cc:attributionURL">_ATTR_NAME_</a>
 is licensed under a 
 <a rel="license" href="__CC_TEXT_URL__">__CC_LABEL__</a><?php /*
 , <a class="wt" href="#!Explain..">with tracking</a>*/ ?>.
 <br />
 Based on a work at
 <a xmlns:dct="http://purl.org/dc/terms/" href="_SOURCE_URL_" rel="dct:source">_SOURCE_TEXT_</a>.
<?php /*<!--Extend Creative Commons with a course 'identifier'-->
 <br />
 Identifier: <a xmlns:dct="http://purl.org/dc/terms/" href="__SOURCE_URL__" rel="dct:identifier">__COURSE_ID__</a>
*/ ?>
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
