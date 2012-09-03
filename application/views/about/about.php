
<h2 id=problem>The problem</h2>
<p>
 Open educational resources have been published by many higher education institutions around the world.
 They are released under licenses that typically allow download, copying and reuse of the content.
 However, once the content leaves the publisher's server it becomes very hard to find out who is using it, and what they are doing with it.
<p>
 The Universities, funding bodies and individuals who invest time and effort in developing OER content need to find out more.

<h2 id=solutions>Solutions</h2>
<p>
 <strong>Track OER</strong> is a <abbr title="Joint Information Systems Committee">JISC</abbr> and
 <abbr title="Higher Education Funding Council for England">HEFCE</abbr>-funded project to facilitate Web analytics for Open Educational Resources.
 It is a rapid innovation project to demonstrate technical solutions, based around software like
 <a href="http://piwik.org/">Piwik</a>, Google Analytics and <a href="http://capret.mitoeit.org/"><abbr title="Cut and Paste Reuse Tracking">CaPRéT</abbr></a>.
<p>
 Find out more on the <a href="<?php echo BLOG_URL ?>" title="Track OER blog, on Cloudworks">Project blog</a>.



<hr />
<?php

  $this->load->view('about/block-cloudworks');
  $this->load->view('about/block-twitter');
?>


<style>
.X-body{ font:1em sans-serif; }
#commits li img{ width:36px; height:36px; float:left; margin-right:8px; }
#commits li{ clear:left; margin-top:8px; }
#commits li .co{ display:block; }
</style>

<h2><a href="<?php echo CODE_URL ?>">Software coding activity on Github</a></h2>

<div id=commits>Loading...</div>




<hr /><div id=site-licenses>
<p id=site-cc>
<a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_GB"><img
 alt="Creative Commons Licence" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/88x31.png" /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Track OER & Bridge to Success <em>content</em></span>
 by <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.open.ac.uk/" property="cc:attributionName" rel="cc:attributionURL">The Open University</a>
 is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_GB">Creative Commons Attribution 3.0 Unported License</a>.
 <br />
 Based on a work at <a xmlns:dct="http://purl.org/dc/terms/" href="http://track.olnet.org/" rel="dct:source">http://track.olnet.org</a>.

<p id=free-code>
<?php /*
 http://gnu.org/graphics/heckert_gnu.html
 http://gnu.org/graphics/gnubanner.html
 http://opensource.org/logo-usage-guidelines
 x-osi-src="http://opensource.org/files/garland_logo.png" x-gpl-src="http://www.gnu.org/graphics/gnu-head-sm.png"
*/ ?>
 <a rel="license" href="http://gnu.org/licenses/gpl-2.0.html"><img
 alt="GNU General Public License v2 or later" src="http://www.gnu.org/graphics/gnubanner-2.png" /></a>
 <br />
 <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">Track OER <em>code</em></span>
 by <a xmlns:cc="http://creativecommons.org/ns#" href="http://iet.open.ac.uk/" property="cc:attributionName" rel="cc:attributionURL">The Institute of Educational Technology</a>
 is <em>mostly</em> licensed under a <a rel="license" href="http://gnu.org/licenses/gpl-2.0.html">GNU General Public License v2 or later</a>.
 <br />
 See the <a href="<?php echo CODE_URL ?>/tree/master/docs/CREDITS.md#readme">full credits</a>
 and <a href="http://cloudworks.ac.uk/cloud/view/6442">list of outputs</a>.
</div>



<?php $this->load->view('about/block-github') ?>

