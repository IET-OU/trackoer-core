<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 17 August 2012.
 * @filesource
 */
require_once APPPATH .'/controllers/oembed.php';


/**
 * Controller for command-line interface (CLI) - batch processing.
 */
class Cli extends Oembed { #MY_Controller {

  #public function index($url = NULL, $format = NULL, $license_url = NULL) { }

  protected static $ARGS_ALL = array(
      'url' => 'http://labspace.open.ac.uk%2FLearning_to_Learn_1.0', //Course URL.
      'ac'  => 'UA-1234578-9',
      'mode' => 'plain-zip', // Was 'fmt'
      'lic' => 'cc:by-nc-sa%2F2.0%2Fuk[/88x31]',
      'dir' => '/input/directory',
      'out' => '"C:/output directory"',
      'log' => '%2Flogs%2Ffile.log',
      'e' => '(extended debug)',
      'v' => '(version)',
      'h' => '(help)',
    ); 
  const ARGS = 'url ac fmt lic dir out log e v h'; //All.
  const ARGS_REQ = 'dir out';


  protected function _echo_batch_version() {
    $version = <<<EOF
Track OER batch processor CLI (trackoer-core).

    Copyright 2012-08-18 The Open University.

EOF;
    echo $version;
    exit (1);
  }

  protected function _echo_batch_help() {
    $usage = <<<EOF

Usage:

\$ php index.php cli/batch

EOF;
    foreach (self::$ARGS_ALL as $arg => $val) {
      if (strlen($arg)==1) {
        $usage .= "\t-$arg  $val" .PHP_EOL;
      } else {
        $usage .= "\t--$arg=$val" .PHP_EOL;
      }
    }
    echo $usage;
    exit (1);
  }


  protected function _parse_batch_args($args) {
    if (! $this->input->is_cli_request()) {
      $this->_error('command-line only');
    }
    if (! $args) {
      $this->_cli_error('missing arguments');
    }

    $params = array();
    foreach ($args as $arg) {
      $out;
      parse_str(ltrim($arg, '-'), $out);
      $params += $out;
    }
#var_dump($params);

    /*
    #$arg_str = str_replace(array(' ', '--'), array('&', ''), $args);
    $arg_str = $args;
    #$arg_str = str_replace('~', '%2F', $arg_str);
    $arg_str = preg_replace('/(--?[a-z]{1,8}):/', '$1=', $arg_str);
    $arg_str = preg_replace('/ *--?([a-z])/', '&$1', $arg_str); 

    $param_r;
    parse_str($arg_str, $param_r);
    #$param_r= explode(' ', $args);
    $tests  = array_keys(self::$ARGS_ALL); #explode(' ', self::ARGS);
var_dump($param_r, func_get_args());
	*/

    #$request = array();
    foreach ($params as $key => $value) {
      if (! isset(self::$ARGS_ALL[$key])) { #in_array($key, $tests)) {
        $this->_cli_error("unrecognised CLI argument '--$key' (--name=value)", 400);
      }
    }
    $params = (object) $params;

    if (isset($param->h)) {
      $this->_echo_batch_help();
    }
    if (isset($params->v)) {
      $this->_echo_batch_version();
    }

    if (! isset($params->dir)) {
      $this->_cli_error("parameter '--dir=%2Finput%2Fdir' is required");
    }

    return $params;
  }

  protected function _cli_error($message) {
    echo 'Error, '. $message . PHP_EOL;
    $this->_echo_batch_help();
  }


  public function batch($args = NULL) {
    $params = $this->_parse_batch_args(func_get_args());


    // Make an oEmbed call..
    $result = parent::index($params);


    $this->load->helper('directory');

    $dir_map = directory_map($params->dir);

    var_dump($params); #, $dir_map);

    if (! $dir_map) {
      $this->_cli_error("directory_map failed, $params->dir");
    }

    foreach ($dir_map as $key => $filename) {
      // Filter directories!
      if (is_array($filename)) {
        echo "Skipping directory, $key" .PHP_EOL;
        exit;

        continue;
      }
      // Filter - only HTML/ XML?
      $input = file_get_contents($params->dir .'/'. $filename);

      // Get <title>, <h1>..

      $output = preg_replace('@(</(body|html)>)@', '<!--X-->$1', $input, 1);
      echo $output;
      
    }

    $this->_cli_error('END'); 
  }

}
