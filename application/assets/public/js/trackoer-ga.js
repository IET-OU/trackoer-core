/**
 @preserve trackoer.getPageUrl version 2 + Google Analytics asynch.
 (c)2012-08-20 The Open University.
*/
/*jslint browser: true, devel: true, indent: 2 */

var trackoer = trackoer || {};

trackoer.getPageUrl = function (custom_hash) {
  'use strict';

  var debug = true,
    enc = encodeURIComponent,
    M = Math,
    log = function (ob) {if (typeof console !== 'undefined') {console.log(arguments); } },
    sec = function (u) {return u.replace(/(C:\/Users\/|C:\/)/g, '').replace(/file:\/\//, 'http://F'); },
    DL = document.location,
    sp = '!',
    path = /*DL.hostname +*/ sec(DL.pathname) + enc(DL.search + DL.hash);

  path += (path.indexOf('#') === -1 || path.indexOf('%23') === -1 ? '%23' : '');
  path += enc(custom_hash.replace(/&amp;/g, '&'));
  path += sp + enc(DL.protocol); //.replace(/:/, ',')

  path += debug ? sp + 'Debug' + sp + M.floor((M.random() * 100) + 1) : '';
  log(path);
  log(DL);

  //return enc(path);
  return path;
};


var _gaq = _gaq || [];
/*ga-start*/
(function () {
  var s, D = document, ga = D.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' === D.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  s = D.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
/*ga-end*/
