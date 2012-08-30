<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core constants.
|--------------------------------------------------------------------------
| @link https://github.com/IET-OU/ouplayer/blob/master/application/config/oup_constants.php
*/
// Prevent CI error.
$config['oup_constants'] = 'dummy';


/*
| Separator character for Analytics 'page' URLs.
*/
define('TRACKER_PAGE_URL_SEP', '!');



/**
|--------------------------------------------------------------------------
| Various URLs - mostly for application/views/site_layout/layout_ci.php
*/
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

