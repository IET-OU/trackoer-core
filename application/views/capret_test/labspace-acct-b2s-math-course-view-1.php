<?php

    $resource_url = 'http://labspaceacct.open.ac.uk/';

    $jquery_js_url = 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js';
    ##$capret_js_url = 'http://capret.mitoeit.org/js/';
    $capret_js_url = base_url() .'capret/js/';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html  xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/standard/styles.php" />
<link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/ou/styles.php" />
<link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/oci/styles.php" />
<link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/oci_labspace/styles.php" />

<!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/standard/styles_ie7.css" />
<![endif]-->
<!--[if IE 6]>
    <link rel="stylesheet" type="text/css" href="http://labspaceacct.open.ac.uk/theme/standard/styles_ie6.css" />
<![endif]-->



<meta name="description" content="Succeed with Math will help you review key math concepts, and then apply these
        concepts to real world applications. Units available include: Math and You, Getting Down to
        the Basics, Numbers Everywhere, Parts of the Whole, Relationships Among Numbers, Exploring
        Patterns and Formulas, Investigating Geometric Shapes and Sizes, and Communicating with
        Data, Charts and Graphs."/>
<meta name="keywords" content="AACC, Anne, Arundel, Bridge, College, Community, Math, Succeed, Success"/>
<link rel="alternate" type="application/rdf+xml" href="http://labspaceacct.open.ac.uk/course/view.php?id=7654&amp;format=rdf"/>
<title> Succeed with Math - LabSpace - The Open University</title>
<link rel="shortcut icon" href="http://labspaceacct.open.ac.uk/theme/oci_labspace/favicon.ico" />
<meta name="robots" content="index,follow"/>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/editor/tinymce/jscripts/tiny_mce/tiny_mce_gzip.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/editor/tinymcepre.js.php?course=7654&amp;editorlanguage=en_oc_utf8"></script>
<!--<style type="text/css">/*<![CDATA[*/ body{behavior:url(http://labspaceacct.open.ac.uk/lib/csshover.htc);} /*]]>*/</style>-->

<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/javascript-static.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/javascript-mod.php"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/overlib/overlib.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/overlib/overlib_cssstyle.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/cookies.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/ufo.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/lib/dropdown.js"></script>  

<script type="text/javascript" defer="defer">
//<![CDATA[
setTimeout('fix_column_widths()', 20);
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
function openpopup(url, name, options, fullscreen) {
   if (url.substr(0,4)!='http') { // add wwwroot if referential link passed
    var fullurl = "http://labspaceacct.open.ac.uk" + url;
   } else {
      var fullurl = url;
   }
    var windowobj = window.open(fullurl, name, options);
    if (!windowobj) {
        return true;
    }
    if (fullscreen) {
        windowobj.moveTo(0, 0);
        windowobj.resizeTo(screen.availWidth, screen.availHeight);
    }
    windowobj.focus();
    return false;
}

function uncheckall() {
    var inputs = document.getElementsByTagName('input');
    for(var i = 0; i < inputs.length; i++) {
        inputs[i].checked = false;
    }
}

function checkall() {
    var inputs = document.getElementsByTagName('input');
    for(var i = 0; i < inputs.length; i++) {
        inputs[i].checked = true;
    }
}

function inserttext(text) {
  text = ' ' + text + ' ';
  if ( opener.document.forms['theform'].message.createTextRange && opener.document.forms['theform'].message.caretPos) {
    var caretPos = opener.document.forms['theform'].message.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
  } else {
    opener.document.forms['theform'].message.value  += text;
  }
  opener.document.forms['theform'].message.focus();
}

function getElementsByClassName(oElm, strTagName, oClassNames){
	var arrElements = (strTagName == "*" && oElm.all)? oElm.all : oElm.getElementsByTagName(strTagName);
	var arrReturnElements = new Array();
	var arrRegExpClassNames = new Array();
	if(typeof oClassNames == "object"){
		for(var i=0; i<oClassNames.length; i++){
			arrRegExpClassNames.push(new RegExp("(^|\\s)" + oClassNames[i].replace(/\-/g, "\\-") + "(\\s|$)"));
		}
	}
	else{
		arrRegExpClassNames.push(new RegExp("(^|\\s)" + oClassNames.replace(/\-/g, "\\-") + "(\\s|$)"));
	}
	var oElement;
	var bMatchesAll;
	for(var j=0; j<arrElements.length; j++){
		oElement = arrElements[j];
		bMatchesAll = true;
		for(var k=0; k<arrRegExpClassNames.length; k++){
			if(!arrRegExpClassNames[k].test(oElement.className)){
				bMatchesAll = false;
				break;
			}
		}
		if(bMatchesAll){
			arrReturnElements.push(oElement);
		}
	}
	return (arrReturnElements)
}




// ou-specific begins
/* Inclusion of Moodle 2 HTML Editor code */

var id2suffix = {};

// ou-specific ends



//]]>
</script>
<!--[if IE]>
  <style type="text/css">
  #page { width: expression(document.body.clientWidth < 800 ? "752px" : "auto"); }
  #help #page { width: auto; }
  </style>
<![endif]-->
<script type="text/javascript" src="<?php echo $resource_url ?>includes/header.js"></script>
<script type="text/javascript" src="http://labspaceacct.open.ac.uk/theme/oci/header.js"></script>

<link rel="alternate" type="application/rss+xml" title="RSS: All Units" href="http://labspaceacct.open.ac.uk/rss/file.php/stdfeed/1/labspace.xml" /></head>
<body onunload="popupclose()"  class='course course-7654 dir-ltr lang-en_oc_utf8 safari' id="course-view" onload="hide_rights_info();">
<script type="text/javascript">ou_sitestat();</script><div id="page">
<div class="page_bod"><div id="div_header">
<div class="header_logo b2s">
<a href="http://labspaceacct.open.ac.uk"><span id="span-header">&nbsp;<div id="acct-header">Test Site</div></span></a>
</div><div id="header">
<h1 class="headermain">Succeed with Math</h1>
<div class="headermenu">
<div id="userdetails">
<div class="logindetails"> (<a  href="https://labspaceacct.open.ac.uk/login/index.php">Sign in</a>) <a href="http://labspace.open.ac.uk/mod/resource/view.php?id=394269"><img class="iconhelp" alt="Help with this" title="Help with this" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/help.gif" /></a>
</div>
</div>
</div>
<div class="clearer"></div>
</div>
<div class="navbar" id="navbar">
    <div class="breadcrumb"><h2 class="accesshide " >You are here</h2> <ul>
<li class="first"><a onclick="this.target='_top'" href="http://labspaceacct.open.ac.uk/">LabSpace</a></li><li> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> <a href="http://labspaceacct.open.ac.uk/course">All Units</a></li><li> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> <a href="http://labspaceacct.open.ac.uk/course/category.php?id=39">SectorSpace</a></li><li> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> <a href="http://labspaceacct.open.ac.uk/course/category.php?id=43">B2S</a></li><li class="crumb_1"> <span class="accesshide " ><span class="arrow_text">/</span>&nbsp;</span><span class="arrow sep">&#x25BA;</span> Succeed_with_Math_1.0</li></ul></div>
    <div class="breadcrumb" style="float:right"><div id="coursesearchform"><form id="coursesearchnavbar" action="http://labspaceacct.open.ac.uk/course/search.php" method="get"><fieldset class="coursesearchbox invisiblefieldset"><span class="helplink"><a title="Help with the Search string (new window)" href="http://labspaceacct.open.ac.uk/help.php?module=moodle&amp;file=search/searchstring.html&amp;forcelang="  onclick="this.target='popup'; return openpopup('/help.php?module=moodle&amp;file=search/searchstring.html&amp;forcelang=', 'popup', 'menubar=0,location=0,scrollbars,resizable,width=740,height=400', 0);"><img class="iconhelp" alt="Help with the Search string (new window)" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/help.gif" /></a></span><input type="text" id="coursesearchbox" size="20" name="search" alt="Search units" value="" /><input type="submit" value="Search units" /></fieldset></form></div>&nbsp;</div>
    <span style="float:right"></span>
    <div class="clearer"></div>
</div>
<div class="clearer"></div>
</div><!-- END OF HEADER -->
<div id="content">
<div class="course-content">
<!--[if IE]>
  <style type="text/css">
  .weekscss-format { width: expression(document.body.clientWidth < 800 ? "752px" : "auto"); }
  </style>
<![endif]-->

<div class="studyplan-format studyplan-topics"><div id="left-column"><a href="#sb-1" class="skip-block">Skip Sign</a><div  id="inst31" class="block_login_link sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst31" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Sign block', 'Hide Sign block'); return false;" alt="Hide Sign block" title="Hide Sign block" class="hide-show-image" /><h2>Sign</h2></div></div><div class="content">
<ul class='list'>
<li class="r0"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/login"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/login.png" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/login">Sign in</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/login/signup.php"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/register.png" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/login/signup.php">Register</a></div></li>
<li class="r0"><div class="icon column c0"><a href="http://labspace.open.ac.uk/mod/resource/view.php?id=394270&direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/help.gif" alt="" /></a></div><div class="column c1"><a href="http://labspace.open.ac.uk/mod/resource/view.php?id=394270&direct=1">Why register?</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspace.open.ac.uk/mod/resource/view.php?id=394269"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/help.gif" alt="" /></a></div><div class="column c1"><a href="http://labspace.open.ac.uk/mod/resource/view.php?id=394269">Where is the sign in form?</a></div></li>
</ul>
</div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst31","Show Sign block","Hide Sign block");
//]]>
</script><span id="sb-1" class="skip-block-to"></span><a href="#sb-2" class="skip-block">Skip Alternative Formats</a><div  id="inst18" class="block_formats sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst18" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Alternative Formats block', 'Hide Alternative Formats block'); return false;" alt="Hide Alternative Formats block" title="Hide Alternative Formats block" class="hide-show-image" /><h2>Alternative Formats</h2></div></div><div class="content">
<ul class='list'>
<li class="r0"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/formats/download_unit.php?id=7654"><img src="http://labspaceacct.open.ac.uk/theme/oci_labspace/images/download.gif" alt="Download this unit" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/formats/download_unit.php?id=7654">Download this unit</a></div></li>
</ul>
</div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst18","Show Alternative Formats block","Hide Alternative Formats block");
//]]>
</script><span id="sb-2" class="skip-block-to"></span><a href="#sb-3" class="skip-block">Skip Rate and Review</a><div  id="inst27" class="block_rate_course sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst27" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Rate and Review block', 'Hide Rate and Review block'); return false;" alt="Hide Rate and Review block" title="Hide Rate and Review block" class="hide-show-image" /><h2>Rate and Review</h2></div></div><div class="content">
<ul class='list'>
<li class="r0"><div class="icon column c0"><img src="http://labspaceacct.open.ac.uk/blocks/yui_menu/icons/viewall.gif" width="16" height="16" alt="" /></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/mod/questionnaire/report.php?instance=4526&amp;sid=4538&amp;action=vall">View reviews</a></div></li>
<li class="r1"><div class="icon column c0"><img src="http://labspaceacct.open.ac.uk/blocks/rate_course/star.gif" width="16" height="16" alt="" /></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/rate_course/rate.php?courseid=7654">Give a rating</a></div></li>
<li class="r0"><div class="icon column c0"><img src="http://labspaceacct.open.ac.uk/pix/spacer.gif" width="1" height="1" alt="" /></div><div class="column c1"></div></li>
</ul>
<div class="footer"><div class="centered"><img src="http://labspaceacct.open.ac.uk/blocks/rate_course/graphic/rating_graphic.php?courseid=7654" alt="Rating: 4.5 stars."/><br/>Rated by 14 user(s)</div></div></div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst27","Show Rate and Review block","Hide Rate and Review block");
//]]>
</script><span id="sb-3" class="skip-block-to"></span><a href="#sb-4" class="skip-block">Skip Tags</a><div  id="inst22" class="block_tags sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst22" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Tags block', 'Hide Tags block'); return false;" alt="Hide Tags block" title="Hide Tags block" class="hide-show-image" /><h2>Tags</h2></div></div><div class="content">
                    <div id="f_coursetags" style="display:block">Unit tags:<div class="coursetag_list"><ul class="tag-cloud inline-list"><li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9392" title="1 thing tagged with &quot;aacc&quot;" style="font-size: 80%">AACC</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9393" title="1 thing tagged with &quot;anne&quot;" style="font-size: 80%">Anne</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9394" title="1 thing tagged with &quot;arundel&quot;" style="font-size: 80%">Arundel</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9365" title="1 thing tagged with &quot;bridge&quot;" style="font-size: 80%">Bridge</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9395" title="1 thing tagged with &quot;college&quot;" style="font-size: 80%">College</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=1656" title="1 thing tagged with &quot;community&quot;" style="font-size: 80%">Community</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=8531" title="1 thing tagged with &quot;math&quot;" style="font-size: 80%">Math</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9410" title="1 thing tagged with &quot;pgcc elearn l2l learning group learning club&quot;" style="font-size: 80%">PGCC eLearn L2L Learning Group Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9409" title="1 thing tagged with &quot;pgcc elearning math learning group learning club&quot;" style="font-size: 80%">PGCC eLearning Math Learning Group Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9403" title="1 thing tagged with &quot;pgcc reg math learning group learning club&quot;" style="font-size: 80%">PGCC REG MATH Learning Group Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9406" title="1 thing tagged with &quot;pgcc soar l2l learning group learning club&quot;" style="font-size: 80%">PGCC SOAR L2L Learning Group Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9405" title="1 thing tagged with &quot;pgcc soar math learning group learning club&quot;" style="font-size: 80%">PGCC SOAR MATH Learning Group Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9408" title="1 thing tagged with &quot;pgcc tba l2l learning club&quot;" style="font-size: 80%">PGCC TBA L2L Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9407" title="1 thing tagged with &quot;pgcc tba math learning group learning club&quot;" style="font-size: 80%">PGCC TBA MATH LEARNING GROUP Learning Club</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9367" title="1 thing tagged with &quot;succeed&quot;" style="font-size: 80%">Succeed</a></li> <li><a href="http://labspaceacct.open.ac.uk/tag/index.php?id=9366" title="1 thing tagged with &quot;success&quot;" style="font-size: 80%">Success</a></li> </ul>
</div>
                        <div class="coursetag_morelink">
                            <a href="http://labspaceacct.open.ac.uk/tag/coursetags_more.php?show=course&amp;courseid=7654" title="Show and filter more tags">more...</a>
                        </div>
                    </div><div class="footer"><hr />Please
                    <a href="http://labspaceacct.open.ac.uk/login/index.php">sign in
                        </a> to tag your favourite units</div></div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst22","Show Tags block","Hide Tags block");
//]]>
</script><span id="sb-4" class="skip-block-to"></span><a href="#sb-5" class="skip-block">Skip Toolkit</a><div  id="inst22380" class="block_html sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst22380" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Toolkit block', 'Hide Toolkit block'); return false;" alt="Hide Toolkit block" title="Hide Toolkit block" class="hide-show-image" /><h2>Toolkit</h2></div></div><div class="content"><!--DONOTCLEAN-->
<p><a target="_blank" href="http://labspace.open.ac.uk/mod/resource/view.php?id=468241&amp;direct=1"><img src="http://labspace.open.ac.uk/file.php/1/B2S/what-do-you-get-from-course.png" alt="How to get the most from the course" title="How to get the most from the course" style="vertical-align:top;float:left;padding-right:4px;" /> How to get the most from this course</a></p>
<p><a target="_blank" href="http://labspace.open.ac.uk/mod/resource/view.php?id=468240&amp;direct=1"><img src="http://labspace.open.ac.uk/file.php/1/B2S/information.png" alt="FAQs" title="FAQs" style="vertical-align: top;" /> FAQs</a></p>
<p><a target="_blank" href="http://labspace.open.ac.uk/mod/questionnaire/view.php?id=468238&amp;direct=1"><img src="http://labspace.open.ac.uk/file.php/1/B2S/what-do-you-think.png" alt="What do you think of the course" title="What do you think of the course" style="vertical-align:top;float:left;padding-right:4px;" /> What do you think of the course?</a></p></div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst22380","Show Toolkit block","Hide Toolkit block");
//]]>
</script><span id="sb-5" class="skip-block-to"></span><a href="#sb-6" class="skip-block">Skip Share this with a friend</a><div  id="inst22395" class="block_share sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst22395" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Share this with a friend block', 'Hide Share this with a friend block'); return false;" alt="Hide Share this with a friend block" title="Hide Share this with a friend block" class="hide-show-image" /><h2>Share this with a friend</h2></div></div><div class="content"><div><form action="http://labspaceacct.open.ac.uk/blocks/share/share.php" method="post" id="blockshare"><div><input type="hidden" name="courseid" value="7654"/><input type="button" name="block_share" value="Send link" onclick="window.location = 'mailto: ?subject=Interesting OpenLearn Resource&amp;body=Hi,%0D%0AI\'ve just come across the OpenLearn website (www.open.ac.uk/openlearn) where you can study Open University materials online for free.%0D%0AI particularly thought you might be interested in \'Succeed with Math\' which is available at:http://labspaceacct.open.ac.uk/Succeed_with_Math_1.0%0D%0AHope you find it useful!';document.blockshare.submit();return false" /></div></form><span class="helplink"><a title="Help with sending a link (new window)" href="http://labspaceacct.open.ac.uk/help.php?module=moodle&amp;file=block_share.html&amp;forcelang="  onclick="this.target='popup'; return openpopup('/help.php?module=moodle&amp;file=block_share.html&amp;forcelang=', 'popup', 'menubar=0,location=0,scrollbars,resizable,width=740,height=400', 0);"><img class="iconhelp" alt="Help with sending a link (new window)" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/help.gif" /></a></span></div><span style="font-size:0.8em">Permalink: <input type="text" style="width:162px;" value="http://labspaceacct.open.ac.uk/Succeed_with_Math_1.0" readonly="readonly" name="displayonly"/></span></div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst22395","Show Share this with a friend block","Hide Share this with a friend block");
//]]>
</script><span id="sb-6" class="skip-block-to"></span></div><div id="right-column"><a href="#sb-7" class="skip-block">Skip Learning Tools</a><div  id="inst30" class="block_learning_tools sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst30" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Learning Tools block', 'Hide Learning Tools block'); return false;" alt="Hide Learning Tools block" title="Hide Learning Tools block" class="hide-show-image" /><h2>Learning Tools</h2></div></div><div class="content">
<ul class='list'>
<li class="r0"><div class="icon column c0"><a href="http://labspace.open.ac.uk/course/category.php?id=15"><img src="http://labspaceacct.open.ac.uk/blocks/compendium/images/help.gif" alt="" /></a></div><div class="column c1"><a href="http://labspace.open.ac.uk/course/category.php?id=15">Using Learning Tools</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=fm"><img src="http://labspaceacct.open.ac.uk/blocks/flashmeeting/images/book.png" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=fm">FM Live Communication</a></div></li>
<li class="r0"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=fv"><img src="http://labspaceacct.open.ac.uk/blocks/flashvlog/images/vlognow.png" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=fv">FlashVlog</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=km"><img src="http://labspaceacct.open.ac.uk/blocks/compendium/images/down.png" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=km">Knowledge Maps</a></div></li>
<li class="r0"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/mod/oublog/allposts.php"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oublog/icon.gif" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/mod/oublog/allposts.php">Learning Journals</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=lc&amp;id=7654"><img src="http://labspaceacct.open.ac.uk/blocks/learning_clubs/images/clubs.gif" alt="" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/learning_tools/learning_tool.php?courseid=7654&amp;tool=lc&amp;id=7654">Learning Clubs</a></div></li>
<li class="r0"><div class="icon column c0"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/forumng/icon.gif" alt="" /></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/mod/forumng/view.php?id=460396">Unit forum</a></div></li>
</ul>
</div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst30","Show Learning Tools block","Hide Learning Tools block");
//]]>
</script><span id="sb-7" class="skip-block-to"></span><a href="#sb-8" class="skip-block">Skip Related educational resources</a><div  id="inst17" class="block_related_units sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst17" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Related educational resources block', 'Hide Related educational resources block'); return false;" alt="Hide Related educational resources block" title="Hide Related educational resources block" class="hide-show-image" /><h2>Related educational resources</h2></div></div><div class="content"><div class="holder"><h3 class="inlineheader">OpenLearners also studied:</h3><br/><a href="http://labspaceacct.open.ac.uk/course/view.php?id=7442">Learning to Learn</a><br/><a href="http://labspaceacct.open.ac.uk/course/view.php?id=7950">PGCC TBA L2L Learning Club</a><br/><a href="http://labspaceacct.open.ac.uk/course/view.php?id=7904">AACC Orientation Programs Learning Club</a><br/></div><div class="holder"><h3 class="inlineheader">Other sites</h3><br/><a href="http://labspaceacct.open.ac.uk/blocks/related_units/OtherOERs.php?id=7654">See other resources</a></div></div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst17","Show Related educational resources block","Hide Related educational resources block");
//]]>
</script><span id="sb-8" class="skip-block-to"></span><a href="#sb-9" class="skip-block">Skip Versions</a><div  id="inst9" class="block_versions sideblock"><div class="header"><div class="title"><input type="image" src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/t/switch_minus.gif" id="togglehide_inst9" onclick="elementToggleHide(this, true, function(el) {return findParentNode(el, 'DIV', 'sideblock'); }, 'Show Versions block', 'Hide Versions block'); return false;" alt="Hide Versions block" title="Hide Versions block" class="hide-show-image" /><h2>Versions</h2></div></div><div class="content">
<ul class='list'>
<li class="r0"><div class="icon column c0">1.0</div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/course/view.php?id=7654">Original OpenLearn version</a></div></li>
<li class="r1"><div class="icon column c0"><img src="http://labspaceacct.open.ac.uk/pix/spacer.gif" width="1" height="1" /></div><div class="column c1"></div></li>
<li class="r0"><div class="icon column c0"><a href="http://labspace.open.ac.uk/course/view.php?name=Cont_1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/resource/icon.gif" alt="QuickStart" /></a></div><div class="column c1"><a href="http://labspace.open.ac.uk/course/view.php?name=Cont_1" >QuickStart</a></div></li>
<li class="r1"><div class="icon column c0"><a href="http://labspaceacct.open.ac.uk/blocks/versions/allversions.php?id=7654"><img src="http://labspaceacct.open.ac.uk/blocks/versions/images/list.gif" alt="List all versions of this unit" /></a></div><div class="column c1"><a href="http://labspaceacct.open.ac.uk/blocks/versions/allversions.php?id=7654">List all versions of this unit</a></div></li>
</ul>
</div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst9","Show Versions block","Hide Versions block");
//]]>
</script><span id="sb-9" class="skip-block-to"></span><div  id="inst32" class="block_html sideblock"><div class="content">


<!--Capret-widget begins-->
<p>
<script src="<?php echo $jquery_js_url ?>"></script>
<script src="<?php echo $capret_js_url ?>jquery.plugin.clipboard.js"></script>
<script src="<?php echo $capret_js_url ?>oer_license_parser.js"></script>
<script src="<?php echo $capret_js_url ?>capret.js"></script>
</p>
<p><a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/"><img alt="Creative Commons Licence" style="border-width: 0;" src="http://i.creativecommons.org/l/by-sa/3.0/88x31.png" /></a><br />This work by <a xmlns:cc="http://creativecommons.org/ns#" href="http://labspace.open.ac.uk" property="cc:attributionName" rel="cc:attributionURL">Labspace - Bridge to success B2S</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/3.0/">Creative Commons Attribution-ShareAlike 3.0 Unported License</a>.</p>
<p>This site is <a href="http://capret.mitoeit.org/">CaPRéT enabled</a>: Cut and Paste Reuse Tracking</p>
<!--Capret-widget ends-->


</div></div><script type="text/javascript">
//<![CDATA[
elementCookieHide("inst32","Show  block","Hide  block");
//]]>
</script><span id="sb-10" class="skip-block-to"></span></div><div id="middle-column" class="has-left-column has-right-column"><span id="ou-content">&nbsp;</span><div class="studyplantopbar"><h2 class='studyplantop'><span class='studyplancorner'>OpenLearn Study Unit </span></h2></div><table class="studyplanweeks  studyplan-noheadings studyplan-nocompletioncol"><tr class='studyplansection oddrow' id='section-1'><td class="studyplancontent"><div class="studyplancontentdeco1"><div class="studyplanweeknumbercell"></div><div class="studyplancontentbg1"></div><div class="studyplancontentbg2"></div><div class="studyplancontentdeco3"></div><div class="studyplancontentdeco4"></div><div class="studyplanactivities"><ul class="section img-text">
<li class="activity label label_text"><div class="centered">&#13;
<div class="inline_relpos"><img src="http://labspace.open.ac.uk/file.php/7654/quizimages/y162_1_gates_front.jpg" alt="This will need to be replaced with your image and copyright" /><div class="div_right"><a href="#" title="Show/Hide rights info" onclick="showhide_source_ref(this);return false">©<br /></a></div>&#13;
</div>&#13;
</div></li>
<li class="activity label label_text">Succeed with Math will help you review key math concepts, and then apply these
        concepts to real world applications. Units available include: Math and You, Getting Down to
        the Basics, Numbers Everywhere, Parts of the Whole, Relationships Among Numbers, Exploring
        Patterns and Formulas, Investigating Geometric Shapes and Sizes, and Communicating with
        Data, Charts and Graphs.</li>
<li class="activity label label_text"><br /><b>Time</b>: 80 hours<br /><b>Level</b>: Introductory</li>
<li class="activity questionnaire"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/questionnaire/view.php?id=469218&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/questionnaire/icon.gif" class="activityicon" alt="" /> <span>Self-Reflection Questionnaire<span class="accesshide " >  </span></span></a></li>
<li class="activity label label_text"><h2>Unit 1</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469312&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Welcome to Succeed with Math!<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 2</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=470831&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Getting Down to the Basics Part 1<span class="accesshide " > Course content</span></span></a></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469652&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Getting Down to the Basics Part 2<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 3</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469750&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Numbers Everywhere<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 4</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=470273&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Parts of the Whole Part 1<span class="accesshide " > Course content</span></span></a></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=470281&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Parts of the Whole Part 2<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 5</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=470294&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Relationships Among Numbers<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 6</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469255&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Exploring Patterns and Formulas<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 7</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469259&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Investigating Geometric Shapes and Sizes<span class="accesshide " > Course content</span></span></a></li>
<li class="activity label label_text"><h2>Unit 8</h2></li>
<li class="activity oucontent"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/oucontent/view.php?id=469247&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/oucontent/icon.gif" class="activityicon" alt="" /> <span>Communicating with Data, Charts, and Graphs<span class="accesshide " > Course content</span></span></a></li>
<li class="activity questionnaire"><img class="spacer" height="12" width="20" src="http://labspaceacct.open.ac.uk/pix/spacer.gif" alt="" /><a   href="http://labspaceacct.open.ac.uk/mod/questionnaire/view.php?id=469219&amp;direct=1"><img src="http://labspaceacct.open.ac.uk/pix/smartpix.php/oci_labspace/mod/questionnaire/icon.gif" class="activityicon" alt="" /> <span>Please tell us what you thought of the course<span class="accesshide " > Questionnaire</span></span></a></li>
</ul><!--class='section'-->

</div></div></td></tr></table></div></div><div class="clearer"></div></div>

</div>
</div>
<!-- end div content -->
<div id="footer">
<div class="div_right">
<p>
<a href="http://labspaceacct.open.ac.uk/rss/file.php/stdfeed/1/full_opml.xml" onclick="return openNewWindow('http://labspaceacct.open.ac.uk/rss/file.php/stdfeed/1/full_opml.xml')"><img src="http://labspaceacct.open.ac.uk/blocks/formats/images/opml.gif" width="16" height="16" style="position:relative;top:3px;left:-3px;" alt="OPML Feed"/>OPML Feed</a>
<img src="http://labspaceacct.open.ac.uk/theme/oci/images/bookmark.gif" alt="Add a bookmark" style="position:relative; top:3px;" />
<a id="bookmark" href="javascript:CreateBookmarkLink();">bookmark link</a>
<script type="text/javascript">
addBookmark();
</script><img src="http://labspaceacct.open.ac.uk/theme/oci/images/facebook_share_icon.gif" alt="Facebook" style="position:relative; top:3px;" />
<a href="http://www.facebook.com/share.php?u=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654&amp;t=Succeed_with_Math_1.0%3A+Succeed+with+Math+-+LabSpace+-+OpenLearn+-+The+Open+University" onclick="return openNewWindow('http://www.facebook.com/share.php?u=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654&amp;t=Succeed_with_Math_1.0%3A+Succeed+with+Math+-+LabSpace+-+OpenLearn+-+The+Open+University')">Share on Facebook</a>&nbsp;&nbsp;
<img src="http://labspaceacct.open.ac.uk/theme/oci/images/delicious.small.gif" alt="Del.icio.us" style="position:relative; top:1px; left:-1px;" />
<a href="http://del.icio.us/post?url=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654" onclick="return openNewWindow('http://del.icio.us/post?url=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654')">Save to Delicious</a>&nbsp;&nbsp;
<img src="http://labspaceacct.open.ac.uk/theme/oci/images/stumbleit.gif" alt="StumbleUpon" style="position:relative; top:2px; left:-1px" />
<a href="http://www.stumbleupon.com/submit?url=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654" onclick="return openNewWindow('http://www.stumbleupon.com/submit?url=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654')">StumbleUpon</a>&nbsp;&nbsp;
<img src="http://labspaceacct.open.ac.uk/theme/oci/images/onlywire.gif" alt="Onlywire" style="position:relative; top:2px" />
<a href="http://www.onlywire.com/submit?u=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654" onclick="return openNewWindow('http://www.onlywire.com/submit?u=http%3A%2F%2Flabspaceacct.open.ac.uk%2Fcourse%2Fview.php%3Fid%3D7654')">Add to OnlyWire</a>&nbsp;&nbsp;
</p>
</div>
<!--Creative Commons License-->
<div id="creativeCommonsFooter">
<p><a href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/" rel="license"><img src="http://labspaceacct.open.ac.uk/theme/oci/images/creativecommons.png" alt="Creative Commons License"/></a>
Except for third party materials and otherwise stated, content on this site is made available<br/> under a <a href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/" rel="license">Creative Commons Attribution-NonCommercial-ShareAlike 2.0 Licence</a>
<br/>OpenLearn is powered by a number of software tools released under the <a href="http://www.gnu.org/licenses/">GNU GPL</a>
</p></div></div>
<div id="ou-footer-links">
            <ul>
            <li class="ou-footleft-links"><a href="http://www.open.ac.uk/privacy">Privacy</a></li>
            <li><a href="http://www.open.ac.uk/conditions">Conditions of Use</a></li>
            <li><a href="http://www.open.ac.uk/copyright">Copyright</a></li>
            <li><a href="http://www3.open.ac.uk/contact/index.aspx?form=true">Email us</a></li>
            </ul>
            </div></div>
</body>
</html>
