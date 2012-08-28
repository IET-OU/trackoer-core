<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| TRACKOER-core CLI / command line batch configuration file.
|--------------------------------------------------------------------------
*/


$_dir = 'C:/Users/<USER>/workspace/_trackoer/Learning_to_Learn_1.0_plain';

/*
| Command line batch processing configuration.
*/
$config['cli_batch'] = array(
    'url' => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0', //Course URL.
    'ac'  => 'UA-1234578-9',
    'mode' => 'zip',  // Was 'fmt'
    'lic' => 'cc:by', //-nc-sa[/2.0][/uk][/88x31]',
    'dir' => "$_dir/Items",
    'out' => "$_dir/Out",
    #'dir' => '/input/directory',
    #'out' => '"C:/output directory"',
    'log' => '%2Flogs%2Ffile.log',  // Currently unused.
    'jspath' => '../Shared',
    'css' => 'font-size:x-small; margin:2em 0; padding:6px; background:#eee; border:1px solid #ddd;',

   # 'E-test' => '"Error, unrecognised CLI argument.."',
);

