<?php
/**
|--------------------------------------------------------------------------
| Configuration: oEmbed providers/ services.
|--------------------------------------------------------------------------
| @copyright Copyright 2011 The Open University.
*/


// Locally-available providers.
//api.embed.ly/1/services (json, Was /api/v1/services)
$config['providers'] = array(

    'openlearn.open.ac.uk' => 'Openlearn_track',
    'labspace.open.ac.uk'  => 'Openlearn_track',

);


// Google Analytics.
$config['provider_google_analytics_ids'] = array(
);



// Other providers.
// IF (!endpoint) endpoint=embedly;
$config['providers_other'] = array(
    // See, http://maltwiki.org/scripts/jquery.oembed.js
    // See, http://iet-embed-acct.open.ac.uk/scripts/jquery.oembed.js
);

