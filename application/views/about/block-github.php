

<style>
.X-body{ font:1em sans-serif; }
#commits li img{ width:36px; height:36px; float:left; margin-right:8px; }
#commits li{ clear:left; margin-top:8px; }
#commits li .co{ display:block; }
</style>

<h2>Software coding activity/ Github</h2>

<div id=commits>Loading...</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.3.3/underscore-min.js"></script>
<script>
//<![CDATA[
function github_commits(resp) {
  _.templateSettings.interpolate = /\{\{(.+?)\}\}/g;
  var template = _.template(
  '<li><img src={{a_url}}> <a class=co href={{url}}>{{msg}}</a> <small><a href={{u_url }}>{{user}}</a> authored <time datetime={{date}}>{{h_date}}</time></small></li>'
  )
  , html = []
  , i
  , len = resp.data.length
  ;
  function _url(u) {
    return u.replace(/\/(api\.|repos\/|users\/)/g, '/').replace(/\/commits\//, '/commit/');
  }
  function _date(d) {
    return d.replace(/T/, ' ').replace(/[-+]\d{2}:\d{2}/, '');
  }

  for (i=0; i < len; i++) {
    var da = resp.data[i];
    html += template({
      msg : da.commit.message,
      url : _url(da.url),
      date: da.commit.author.date,
      h_date: _date(da.commit.author.date),
      user: da.author.login,
      u_url:_url(da.author.url),
      a_url:da.author.avatar_url
    });
  }

  document.getElementById('commits').innerHTML = '<ul>'+ html +'</ul>';
}
//]]>
</script>
<script src="https://api.github.com/repos/IET-OU/trackoer-core/commits?callback=github_commits&per_page=4"></script>

