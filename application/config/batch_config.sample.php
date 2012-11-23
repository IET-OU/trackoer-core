<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core CLI / command line batch configuration file.
|--------------------------------------------------------------------------
| Basic usage:
|     php index.php cli/batch
|
| Usage with options:
|     php index.php cli/batch --url=http://labspace.. --ac=UA-123..
|
| Get help:
|     php index.php cli/batch -h
*/


$_dir = 'C:/Users/<USER>/workspace/_trackoer/Learning_to_Learn_1.0_plain';

/*
| Command line batch processing -- options will override this configuration.
*/
$config['cli_batch'] = array(
    'url' => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0', //Course URL.
    'ac'  => 'UA-1234578-9',
    'mode' => 'zip',  // Was 'fmt'
    'lic' => 'cc:by',
    #'lic' => 'cc:by-nc-sa/2.0/uk/88x31.png',
    'dir' => "$_dir/Items",
    'out' => "$_dir/../Learning_to_Learn_1.0_plain_wt2/Items",
    #'dir' => '/input/directory',
    #'out' => '"C:/output directory"',
    'log' => '%2Flogs%2Ffile.log',  // Currently unused.
    'jspath' => '../Shared',
    'css' => 'font-size:x-small; margin:2em 0; padding:6px; background:#eee; border:1px solid #ddd;',

   # 'E-test' => '"Error, unrecognised CLI argument.."',
);

