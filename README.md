trackoer-core
=============

__Track OER__ is a JISC and HEFCE-funded project to facilitate Web analytics for Open Educational Resources.

`trackoer-core` is the central web application for the Project, providing clean
URL redirection to no-Javascript web-bugs for Piwik, an OER license-tracker embed-code service
for Creative Commons, Piwik and Google Analytics, and test/demonstration pages.

## Requirements

 * Apache 2.2+
   * `mod_rewrite` and `.htaccess` (or access to `httpd.conf`)
 * PHP 5.2+
   * cURL, `json_encode`
 * ([Piwik 1.8+][piwik] -- this can be run on a separate server/host.)

## Installation

    git clone git@github.com:IET-OU/trackoer-core.git
    cd trackoer-core/application
    
    # Copy the default configuration file
    cp config/trackoer_config.dist.php config/trackoer_config.php
    
    # Edit the configuration file.. (see comments in the PHP for now)
    vi config/trackoer_config.php
    
    # (Re-)start Apache
    service httpd restart

## Links

 * Project site: [track.olnet.org](http://track.olnet.org/)
 * Project blog: [Cloudworks: tag/ TrackOER][blog]
 * piwik-trackoer:  [Github: IET-OU/ piwik-trackoer](https://github.com/IET-OU/piwik-trackoer)
 * JISC page: [JISC: whatwedo/ programmes/ ukoer3/ rapidinnovation/ trackoer][jisc-page]


## Todos
14-21 August 2012

* DONE. Implement a status/log feature for oerform,
* DONE. Add &lt;link rel=alternate> to oerform - point to oEmbed service,
* DONE. Add visible links to alternative formats - point to oEmbed service,
* DONE. Example links for oerform,
* DONE. Tidy up oerform UI - minimalist!
* ? Fix the tracking snippet - source-path,
* DONE. Fix "oucontent/view.php?id=471422§ion=3" - &amp; matters!
* DONE. Javascript 'select-all' for oerform,
* Document the proposed oEmbed/oerform API,
* DONE. Implement GA/Google_Tracker,
* PART. About page; Todo - donottrack etc.


## License

trackoer-core: Copyright 2012 The Open University.

* License:  [GNU GPL version 2 or later][gpl2]

## Credits

Track OER (trackoer-core) is developed by the [Institute of Educational Technology at The Open University](http://iet.open.ac.uk),
with support from [JISC](http://jisc.ac.uk).

For full credits and licenses see [docs/CREDITS.md][credit]


[![][piwik-bug]][piwik]

[![Ohloh project report][ohloh-icon]][ohloh]
<!-- [![License: GPL v2 +][gpl-icon]][gpl2]  [![Build Status][travis-icon]][travis] -->


[blog]: http://cloudworks.ac.uk/tag/view/TrackOER
[jisc-page]: http://jisc.ac.uk/whatwedo/programmes/ukoer3/rapidinnovation/trackoer.aspx
[piwik]: http://piwik.org/
[credit]: https://github.com/IET-OU/trackoer-core/tree/master/docs/CREDITS.md
[gpl2]: http://gnu.org/licenses/gpl-2.0.html
[gpl-icon]: http://www.gnu.org/graphics/gnubanner-2.png
[ohloh]: http://www.ohloh.net/p/trackoer-core?ref=github "Ohloh project report for Track OER"
[ohloh-icon]: https://www.ohloh.net/p/trackoer-core/widgets/project_thin_badge.gif
[travis]: http://travis-ci.org/cdnjs/cdnjs
[travis-icon]: https://secure.travis-ci.org/cdnjs/cdnjs.png
[piwik-bug]: http://track.olnet.org/piwik/piwik.php?idsite=1&rec=1
