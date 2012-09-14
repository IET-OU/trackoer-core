/**
 * @preserve Google Analytics JS v1-EXT
 * http://code.google.com/p/google-analytics-js/
 * Copyright (c) 2009 Remy Sharp remysharp.com / MIT License
 * $Date: 2009-02-25 14:25:01 +0000 (Wed, 25 Feb 2009) $
 *
 * Extensions: ©2012 The Open University/ License MIT/ Author N.D.Freear 2012-09-13.
 * http://track.olnet.org
 */
/*jslint browser:true, devel:true, indent:2 */

function gaTrack(urchinCode, domain, url, title, direct, event, doreturn) {
  'use strict';

  function rand(min, max) {
	return min + Math.floor(Math.random() * (max - min));
  }

  var i = 1000000000,
      utmn = rand(i, 9999999999), //random request number
	  utmhid = rand(100000000, 999999999), //random: link Analytics GIF requests with AdSense.
      cookie = rand(10000000, 99999999), //random cookie number
      random = rand(i, 2147483647), //number under 2147483647
      today = new Date().getTime(),
      win = window.location,
      img = new Image(),
      enc = encodeURIComponent,
      urchinUrl = 'http://www.google-analytics.com/__utm.gif?utmwv=5.2.5&utmn='
          + utmn + '&utmsr=-&utmsc=-&utmul=-&utmje=0&utmfl=-&utmcs=-&utmhid=' + utmhid
          + '&utms=5' //counter? http://productforums.google.com/forum/#!topic/analytics/xVktsrSt53E
          + '&utmdt=' + (title ? enc(title) : '-')
          + (domain ? '&utmhn=' + domain : '')
          + '&utmr=' + (direct ? '-' : enc(win))
          + (url ? '&utmp=' + enc(url) : '')
		  + (typeof event === 'string' ? '&utmt=event&utme=5' + event : '') //&utmt=event&utme=5(CAT*ACT*LABEL)(999)
          + '&utmac=' + urchinCode
          + '&utmcc='
          + '__utma%3D' + cookie + '.' + random + '.' + today + '.' + today + '.' + today + '.2%3B%2B'
          + (direct
            ? '__utmz%3D' + cookie + '.' + today + '.1.1.utmcsr%3D(direct)%7Cutmccn%3D(direct)%7Cutmcmd%3D(none)%3B'
            : '__utmb%3D' + cookie + '%3B%2B__utmc%3D' + cookie + '%3B%2B__utmz%3D' + cookie + '.' + today
            + '.2.2.utmccn%3D(referral)%7Cutmcsr%3D' + win.host + '%7Cutmcct%3D' + win.pathname + '%7Cutmcmd%3Dreferral%3B%2B__utmv%3D'
            + cookie + '.-%3B'
            )
          + 'utmu=4~';

  if (typeof doreturn !== 'undefined' && doreturn) {
    return urchinUrl;
  }
  // ELSE, default..

  // trigger the tracking
  img.src = urchinUrl;
}
