trackoer-core
=============

'Track OER' is a JISC and HEFCE-funded project to facilitate Web analytics for Open Educational Resources.

`trackoer-core` is the central web application for the Project, providing clean
URL redirection to no-Javascript web-bugs for Piwik and Google Analytics,
and test/demonstration pages.

## Requirements

 * PHP 5.2+
 * Apache 2.2+
 * (Piwik 1.8+ -- this can be run on a separate server/host.)

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
 * Project blog: [cloudworks.ac.uk/tag/view/trackoer](http://cloudworks.ac.uk/tag/view/trackoer)
 * piwik-trackoer:  [github.com/IET-OU/piwik-trackoer](https://github.com/IET-OU/piwik-trackoer)
 * JISC page: [jisc.ac.uk/whatwedo/programmes/ukoer3/rapidinnovation/trackoer.aspx](http://jisc.ac.uk/whatwedo/programmes/ukoer3/rapidinnovation/trackoer.aspx)


## Todos
14-21 August 2012

* DONE. Implement a status/log feature for oerform,
* DONE. Add &lt;link rel=alternate> to oerform - point to oEmbed service,
* DONE. Add visible links to alternative formats - point to oEmbed service,
* DONE. Example links for oerform,
* DONE. Tidy up oerform UI - minimalist!
* ? Fix the tracking snippet - source-path,
* DONE. Fix "oucontent/view.php?id=471422§ion=3" - &amp; matters!
* LOW. Javascript 'select-all' for oerform,
* Document the proposed oEmbed/oerform API,
* Implement Ga_Tracker,
* About page, donottrack etc.


## License

trackoer-core: Copyright 2012 The Open University.

* License:  [free/open source -- license to be decided]

## Credits

Track OER (trackoer-core) is developed by the [Institute of Educational Technology at The Open University](http://iet.open.ac.uk),
with support from [JISC](http://jisc.ac.uk).

For full credits and licenses see docs/CREDITS.md

