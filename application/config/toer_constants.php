<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core constants.
|--------------------------------------------------------------------------
| @link https://github.com/IET-OU/ouplayer/blob/master/application/config/oup_constants.php
*/
// Prevent CI error.
$config['_toer_constants'] = 'dummy';


/*
| Separator character for Analytics 'page' URLs.
| "!" is reserved as an application-specific ('sub-delims') URI delimiter in RFC 3986
| @link http://tools.ietf.org/html/rfc3986#section-2.2
*/
define('TRACKER_PAGE_URL_SEP', '!');


/*
|--------------------------------------------------------------------------
| Content delivery modes or methods.
| @link http://labspace.open.ac.uk/blocks/formats/download_unit.php?id=7442&name=Learning_to_Learn_1.0
| @link http://openlearn.open.ac.uk/mod/oucontent/view.php?id=398528&name=S197_1#!Alt
*/
// Feeds: RSS (2.0), Atom, eg. 'NAME_rss.xml'
define('TRACKER_MODE_RSS', 'rss');
define('TRACKER_MODE_ATOM', 'atom');
// OU XML Package, eg. 'NAME_ouxml.zip'
define('TRACKER_MODE_OUXML', 'ouxml');
// IMS Common Cartridge 1.0, eg. 'NAME_imscc.zip'
define('TRACKER_MODE_IMS', 'imscc');
// Sharable Content Object Reference Model/ Package Interchange File, eg. 'NAME_scorm.zip'
define('TRACKER_MODE_SCORM', 'scorm');
// Plain Zip, eg. 'NAME_plain.zip'
define('TRACKER_MODE_ZIP', 'zip');
// Moodle Backup (.zip/ .mbz)
define('TRACKER_MODE_MOODLE', 'moodle');
// Portable Document Format/ Adobe PDF.
define('TRACKER_MODE_PDF', 'pdf');
// ePub open e-boook standard (.epub)
define('TRACKER_MODE_EPUB', 'epub');
// Word document
define('TRACKER_MODE_DOC', 'doc');


/*
|--------------------------------------------------------------------------
| Campaigns. Which link in a (Creative Commons) License RDFa snippet is this?
| @see Google_Tracker::campaignUrl()
*/
// License image-link
define('TRACK_RDF_LIC_ICON', 'lic-icon');
// License text-link
define('TRACK_RDF_LIC_LINK', 'lic-link');
// Source work link/URL
define('TRACK_RDF_SRC_LINK', 'src-link');
// Attribution link
define('TRACK_RDF_ATTR_LINK', 'attr-link');


/*
|--------------------------------------------------------------------------
| XML Nampsaces - oEmbed extensions; OU Player data-feeds.
*/
define('XMLNS_OU_OEMBED_EXTEND', 'http://embed.open.ac.uk/2012/extend#');
define('XMLNS_OU_RSS_PLAYER', 'http://podcast.open.ac.uk/2012');


/**
|--------------------------------------------------------------------------
| Various URLs - mostly for application/views/site_layout/layout_ci.php
*/
define('TRACKOER_LIVE_URL', 'http://track.olnet.org/');

// The project blog.
define('BLOG_URL', 'http://cloudworks.ac.uk/tag/view/TrackOER');

// The public Git repository.
define('CODE_URL', 'https://github.com/IET-OU/trackoer-core');

// Contact/feedback link - email?
define('CONTACT_URL', '#!Contact/todo');

// Bridge to success content.
define('B2S_CONTENT_URL', 'http://labspace.open.ac.uk/b2s');

// OU-OER 'umbrella' site.
define('OU_OER_URL', 'http://www8.open.ac.uk/about/open-educational-resources/');

// OLnet site.
define('_disable_OLNET_URL', 'http://www.olnet.org/');

// Twitter search.
define('TWITTER_SEARCH', '#TrackOER');

