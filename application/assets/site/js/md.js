/*!
 (c)N.D.Freear, 2012-10-18.
*/
yepnope({
load: [
//require([
  'http://cdn.enderjs.com/jeesh.min.js',
  'http://cdnjs.cloudflare.com/ajax/libs/pagedown/1.0/Markdown.Converter.js'
  ///cdnjs.cloudflare.com/ajax/libs/require.js/2.0.6/require.min.js
],
//callback: function(u, r, k) {},
complete: function () {
  var id = $('script[src *= "md."]').data('id');
  $('#' + id).after('<textarea readonly id="wmd-out"/>');
  var conv = new Markdown.Converter()
    , cssb = {
        background:'#222', color:'#eee', margin:0
    }
    , csst = {
        background:'#222', color:'#eee', width:'49%', height:'28em', 'font-size':'1em', margin:'1px'
    }
    , abbr = {
        'Track OER':'Track OER'
      , TOER: 'Track OER'
      , GA  : 'Google Analytics'
      , OER : 'Open Educational Resource'
      , OU  : 'Open University' //'The OU'
      , IET : 'Institute of Educational Technology'
      //, '\\\\': ''
    }
    , abk = Object.keys(abbr).join('|')
    , abre = new RegExp('([\\s\\[])('+ abk +')([s\\.,\\s\\]])', 'g')
    , inp = $('#' + id)
    , out = $('#wmd-out')
    ;
  console.log(id, abk, abre); //, cssb.concat(csst));

  conv.hooks.chain('preConversion', function (tx) {
	return tx.replace(abre, function(match, p1, p2, p3, off, str) {
	  return p1 + abbr[p2] + p3;
    });
  })
  conv.hooks.chain('preConversion', function (tx) {
    return tx.replace(/\\/g, '');
  });

  inp.bind('input', function () {
    out.html(conv.makeHtml(inp.attr('value')));
  });

  out
    .html(conv.makeHtml(inp.html()))
    .css(csst);
  inp.css(csst);
  $('body').css(cssb);
}
});

/*
 * http://dillinger.io
 * http://showdown.im
 * http://pagedown.googlecode.com/hg/demo/browser/demo.html
 * http://michelf.ca/projects/php-markdown/dingus/
 * http://cdnjs.com#markd
 * http://ender.no.de/#jeesh
 */