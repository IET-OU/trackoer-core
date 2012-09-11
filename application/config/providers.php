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

    // Live OpenLearn servers.
    'openlearn.open.ac.uk' => 'Openlearn_track',
    'labspace.open.ac.uk'  => 'Openlearn_track',

    // Test OpenLearn servers.
    'openlearnacct.open.ac.uk' => 'Openlearn_track',
    'labspaceacct.open.ac.uk'  => 'Openlearn_track',


    // OER Commons.
    'oercommons.org' => 'Oercommons',
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

