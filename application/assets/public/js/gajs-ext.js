/*!
 * Google Analytics JS v1-EXT
 * http://code.google.com/p/google-analytics-js/
 * Copyright (c) 2009 Remy Sharp remysharp.com / MIT License
 * $Date: 2009-02-25 14:25:01 +0000 (Wed, 25 Feb 2009) $
 *
 * Extensions: ©2012 The Open University/ License MIT/ Author N.D.Freear 2012-09-13.
 * http://track.olnet.org
 */
/*jslint browser:true, devel:true, indent:2 */

function gaTrack(urchinCode, domain, url, title, doreturn) {
  'use strict';

  function rand(min, max) {
    return min + Math.floor(Math.random() * (max - min));
  }

  var i = 1000000000,
      utmn = rand(i, 9999999999), //random request number
      cookie = rand(10000000, 99999999), //random cookie number
      random = rand(i, 2147483647), //number under 2147483647
      today = new Date().getTime(),
      win = window.location,
      img = new Image(),
	  enc = encodeURIComponent,
      urchinUrl = 'http://www.google-analytics.com/__utm.gif?utmwv=5.2.5&utmn='
          + utmn+'&utmsr=-&utmsc=-&utmul=-&utmje=0&utmfl=-'
          + '&utmdt=' + (title ? enc(title) : '-')
          + (domain ? '&utmhn=' + domain : '')
          + (url ? '&utmr=' + enc(win) : '')
          + (url ? '&utmp=' + enc(url) : '')
          + '&utmac=' + urchinCode
          + '&utmcc=__utma%3D'
          + cookie + '.' + random + '.' + today + '.' + today + '.'
          + today + '.2%3B%2B__utmb%3D'
          + cookie + '%3B%2B__utmc%3D'
          + cookie + '%3B%2B__utmz%3D'
          + cookie + '.' + today
          + '.2.2.utmccn%3D(referral)%7Cutmcsr%3D' + win.host + '%7Cutmcct%3D' + win.pathname + '%7Cutmcmd%3Dreferral%3B%2B__utmv%3D'
          + cookie + '.-%3B';

  if (typeof doreturn !== 'undefined' && doreturn) {
    return urchinUrl;
  }
  // ELSE, default..

  // trigger the tracking
  img.src = urchinUrl;
}
