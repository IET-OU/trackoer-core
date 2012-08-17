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
| Set the base URL for a Piwik installation (no trailing slash).
| Base URL to the Piwik Install
| @link  https://github.com/wingdspur/codeigniter-piwik
*/
#$config['piwik_url'] = 'http://stats.example.com';
$config['piwik_url'] = 'http://track.olnet.org/piwik';
#$config['piwik_url'] = 'http://localhost:8888/toer/piwik';


// Google Analytics.
#$config['google_analytics_default_id'] = 'UA-XXXXXXXX-Y';

// Piwik analytics.
#$config['piwik_default_id'] = N;



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

