<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core CLI / command line batch configuration file.
|--------------------------------------------------------------------------
*/


/*
| Command line batch processing configuration.
*/
$config['cli_batch'] = array(
    'url' => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0', //Course URL.
    'ac'  => 'UA-1234578-9',
    'mode' => 'zip',  // Was 'fmt'
    'lic' => 'cc:by-nc-sa[/2.0][/uk][/88x31]',
	'dir' => '/input/directory',
    'out' => '"C:/output directory"',
    'log' => '%2Flogs%2Ffile.log',  // Currently unused.
    'jspath' => '../Shared',

   # 'E-test' => '"Error, unrecognised CLI argument.."',
);

