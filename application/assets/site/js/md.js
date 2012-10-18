/*!
 (c)N.D.Freear, 2012-10-18.
*/
(function () {
  var conv = new Markdown.Converter()
    , D = document
    , inp = D.getElementById('wmd-input')
    , out = D.getElementById('wmd-preview')
	, abbr = {
        'Track OER':'Track OER'
      , OER : 'Open Educational Resource'
      , OU  : 'The Open University'
      , IET : 'Inst of Educational Technology'
    }
	, abk = Object.keys(abbr).join('|')
	, abre = new RegExp('(\\s)('+ abk +')([s\\.,\\s])', 'g') ///(\s)(OER)([s\.,\s])/g
    ;
  console.log(abk, abre);

  conv.hooks.chain('preConversion', function (tx) {
	return tx.replace(abre, function(match, p1, p2, p3, off, str) {
	  return p1 + abbr[p2] + p3;
    });//'$1' + abbr['$2'] + '$3');
  })
  conv.hooks.chain('preConversion', function (tx) {
    return tx.replace(/\\/g, '');
  });
  inp.oninput = function() {
    out.value = conv.makeHtml(inp.value);
  };
  out.value = conv.makeHtml(inp.value);
})();
