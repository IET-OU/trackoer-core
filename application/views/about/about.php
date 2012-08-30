
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
<div id=cloudstream>
<?php /*<script Y-src=
"http://cloudworks.ac.uk/api/users/1040/stream.js?count=4&amp;title=Nick%27s+Cloudstream&amp;api_key=12345"
></script>*/ ?>
<script>
<?php /*if (typeof window.Cloudworks == 'undefined') window.Cloudworks = {}; */ ?>
var Cloudworks = Cloudworks || {};
Cloudworks.Streams_CB_X = function(resp) {
<?php /*Cloudworks.Streams.writeln({
    "item_type":"user",
	"item_id":"1040",
	"related":"stream",
	"html_url":"http:\/\/cloudworks.ac.uk\/event\/user\/1040#cloudstream",
	"count":"4",
	"title":"Nick's Cloudstream",
	"BASE_URL":"http:\/\/cloudworks.ac.uk\/"
  }, resp.items
  );*/ ?>
  Cloudworks.Streams.writeln({
    title:"Track OER project blog",
    style:"none",
    html_url:"<?php echo BLOG_URL ?>"
  }, resp.items
  );
};
</script>
<script src="http://cloudworks.ac.uk/_scripts/api-streams.js"></script>
<script <?php /*Y-src="http://cloudworks.ac.uk/api/users/1040/stream.json?count=8&amp;callback=Cloudworks.Streams_CB_7303&amp;api_key=12345"*/ ?>
src="http://cloudworks.ac.uk/api/tags/trackoer/clouds.json?count=8&amp;callback=Cloudworks.Streams_CB_X&amp;api_key=12345"></script>
<?php /*
<style>
 .cloudworks-posts ul {list-style-type:none; margin:0 0 1em 15px; padding:0}
 .__cloudworks-posts [rel=author],.cloudworks-end {font-size:smaller}
 .cw-item-link{background:url(http://cloudworks.ac.uk/_design/icon-link.gif)top left no-repeat;padding-left:20px}
 .cw-item-cloud{background:url(http://cloudworks.ac.uk/_design/icon-cloud.gif)top left no-repeat;padding-left:20px}
</style>*/ ?>
</div>




<div id=twitter>
<?php /*
 https://twitter.com/about/resources/widgets/widget_search
*/ ?>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '<?php echo TWITTER_SEARCH ?>',
  interval: 30000,
  title: 'Track OER',
  subject: 'A JISC-funded project',
  width: 250,
  height: 300,
  theme: {
    shell: {
      background: '#52879e',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: true,
    loop: true,
    live: true,
    behavior: 'default'
  }
}).render().start();
</script>
</div>



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