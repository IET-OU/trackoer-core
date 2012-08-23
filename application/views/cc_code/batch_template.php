<?php
/**
 * Template for batch processing (B2S).
 * HTML + Creative Commons RDFa + custom Google Analytics Javascript.
 *
 * @copyright 2012-08-23 The Open University.
 */


/*
  Example usage:


  $embed_code = strtr(
    $this->load->view('cc_code/b2s_template', $view_data = NULL, $return = TRUE),
    array(
      '__CC_TERMS__' => 'by-sa',   # License terms, eg. 'by', 'by-nc-sa'
      '__CC_VJ__'    => '3.0',     # License version[/jurisdiction], eg. '2.0/uk' or '3.0'
      '__CC_LABEL__' => 'Creative Commons Attribution-ShareAlike 3.0 Unported License',
      '__ATTR_NAME__'  => 'OpenLearn-LabSpace - Bridge to Success B2S', #'OpenLearn/ Andrew Studnicky',
      '__ATTR_URL__'   => 'http://labspace.open.ac.uk/b2s',
      '__WORK_TITLE__' => 'Learning to Learn 1.0/ Course Overview/ Introduction (page)',
      '__SOURCE_URL__' => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0',
      '__COURSE_HOST__'=> 'labspace.open.ac.uk',
      '__COURSE_ID__'  => 'Learning_to_Learn_1.0',
      '__WORK_ID__'    => 'x_learning_to_learn_0_1.html', # Source filename, etc.
      '__MODE__'       => 'plain-zip',        # 'scorm', 'ims' etc.
      '__SCRIPT_PATH__'=> '../Shared', # Relative path.
      '__SCRIPT_ARG__' => 'type="text/javascript"', # HTML5 ''.
    )
  );
*/
?>

<a rel="license" href="http://creativecommons.org/licenses/__CC_TERMS__/__CC_VJ__/deed.en_GB"
 ><img alt="Creative Commons Licence" style="border-width:0"
 src="http://i.creativecommons.org/l/__CC_TERMS__/__CC_VJ__/88x31.png"
 title="Creative Commons License - with tracking**" /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">__ITEM_TITLE__</span>
 by
 <a xmlns:cc="http://creativecommons.org/ns#" href="__ATTR_URL__" property="cc:attributionName" rel="cc:attributionURL">__ATTR_NAME__</a>
 is licensed under a 
 <a rel="license" href="http://creativecommons.org/licenses/__CC_TERMS__/__CC_VJ__/deed.en_GB">__CC_LABEL__</a><?php /*
 , <a class="wt" href="#!Explain..">with tracking</a>*/ ?>.
 <br />
 Based on a work at
 <a xmlns:dct="http://purl.org/dc/terms/" href="__SOURCE_URL__" rel="dct:source">__SOURCE_URL__</a>.
<?php /*<!--Extend Creative Commons with a course 'identifier'-->
 <br />
 Identifier: <a xmlns:dct="http://purl.org/dc/terms/" href="__SOURCE_URL__" rel="dct:identifier">__COURSE_ID__</a>
*/ ?>
<script __SCRIPT_ARG__ src="__SCRIPT_PATH__/trackoer-ga.js"></script>
<script __SCRIPT_ARG__>
_gaq.push(['_trackoer_ct._setAccount', '__GA__ID__']);
_gaq.push(['_trackoer_ct._trackPageview', trackoer.getPageUrl('!__COURSE_HOST__!__COURSE_ID__!__WORK_ID__!__MODE__')]);
</script>
