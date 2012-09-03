

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

