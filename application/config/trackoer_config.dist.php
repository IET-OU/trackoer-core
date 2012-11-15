<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core main configuration file.
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Debugging flag (integer).
*/
$config['debug'] = 1;  #OUP_DEBUG_MIN;


/*
|--------------------------------------------------------------------------
| If missing or FALSE, a robots exclusion <meta> tag is set.
*/
#$config['robots'] = TRUE;


/*
|--------------------------------------------------------------------------
| Web proxy.
*/
#putenv('http_proxy=wwwcache.open.ac.uk:80');
$config['http_proxy'] = 'wwwcache.open.ac.uk:80';


/*
|--------------------------------------------------------------------------
| Markdown - enable in views?
*/
#$config['markdown'] = TRUE;

$config['markdown_url_regex'] = '#:\/\/(.*\.ac\.uk\/|.*olnet\.org\/|.*github\.com\/|dl.dropbox\.com\/u\/32)#';


/*
|--------------------------------------------------------------------------
| Test navigation.
*/
$config['test_menu'] = array(
  'Learning to Learn/ B2S' => 'test/b2s_learn',
  'Learning to Learn section/page' => 'test/b2s_learn_section',
  'Google Analytics custom script' => 'test/b2s_learn_gajs?param1=value1#hash',
  'Succeed with Math/ CaPReT 1' => 'test/capret/math/course-view',
  'Maths/ CaPReT-Piwik' => 'test/capret/math/course-piwik',
);


/*
|--------------------------------------------------------------------------
| About page - useful links.
*/
$config['about_links'] = array(
  'Google Analytics/ CaPReT custom report configuration'=> 'https://www.google.com/analytics/web/permalink?uid=5gO2UUPiS6OCk_-vCgE8AA',
);


/*
|--------------------------------------------------------------------------
| Set the base URL for a Piwik installation (no trailing slash).
| Base URL to the Piwik Install
| @link  https://github.com/wingdspur/codeigniter-piwik
*/
#$config['piwik_url'] = 'http://stats.example.com';
$config['piwik_url'] = 'http://track.olnet.org/piwik';
#$config['piwik_url'] = 'http://localhost:8888/toer/piwik';


/*
|--------------------------------------------------------------------------
| Google Analytics accounts.
*/
// GA default ID.
#$config['google_analytics_default_id'] = 'UA-XXXXXXXX-Y';

// CaPReT-GA account ID.
#$config['google_analytics_capret_id'] = 'UA-XXXXXXXX-Z';


/*
|--------------------------------------------------------------------------
| Piwik analytics site IDs.
*/
// Piwik default ID (idSite).
#$config['piwik_default_id'] = N;

// CaPReT-Piwik site ID.
#$config['piwik_capret_id'] = M;


// Optional <H1> font, http://www.google.com/webfonts
#$config['google_font'] = 'Amaranth';  #'Racing Sans One';


/*
|--------------------------------------------------------------------------
| Codeigniter-piwik library configuration.
| Base URL to the Piwik Install
| @link  https://github.com/wingdspur/codeigniter-piwik ..config/piwik.php
*/
// Piwik library - internal.
//( $config['piwik_url'] = 'http://track.olnet.org/piwik'; )


// HTTPS Base URL to the Piwik Install (not required)
$config['piwik_url_ssl'] = 'https://stats.example.com';

// Piwik Site ID for the website you want to retrieve stats for
$config['site_id'] = 1;

// Piwik API token, you can find this on the API page by going to the API link from the Piwik Dashboard
$config['token'] = 'anonymous';
#$config['token'] = '0b3b2sdgsd7e82385avdfgde44dsfgd5g';

// To turn geoip on, you will need to set to TRUE  and GeoLiteCity.dat will need to be in helpers/geoip
$config['geoip_on'] = FALSE;

// Controls whether piwik_tag helper function outputs tracking tag (for production, set to TRUE)
$config['tag_on'] = FALSE;

