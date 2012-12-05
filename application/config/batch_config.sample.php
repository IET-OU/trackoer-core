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


$mode = 'plain';  #TRACKER_MODE_SCORM; #'scorm' 'imscc' 'plain'
$account = 'UA-1234578-9';
$course = 'Learning_to_Learn_1.0';
$course_NEXT = 'Succeed_with_Math_1.0';
$_dir = 'C:/Users/<USER>/workspace/_trackoer_b2s_zips';


/*
| Command line batch processing -- options will override this configuration.
*/
$config['cli_batch'] = array(
    'url' => "http://labspace.open.ac.uk/$course", //Course URL.
    'ac'  => $account,
    'mode' => $mode,  // Was 'fmt'
    'lic' => 'cc:by',
    #'lic' => 'cc:by-nc-sa/2.0/uk/88x31.png',
    'dir' => "$_dir/{$course}_$mode/Items",
    'out' => "$_dir/{$course}_{$mode}_wt2/Items"
    'log' => '%2Flogs%2Ffile.log',  // Currently unused.
    'jspath' => '../Shared',
    'css' => 'font-size:x-small; margin:2em 0; padding:6px; background:#eee; border:1px solid #ddd;',
);

