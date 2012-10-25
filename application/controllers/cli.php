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
 * Controller for command-line interface (CLI) - batch processing and Markdown rendering.
 */
class Cli extends Oembed { #MY_Controller {

  protected static $ARGS_ALL = array(
      'url' => 'http://labspace.open.ac.uk%2FLearning_to_Learn_1.0', //Course URL.
      'ac'  => 'UA-1234578-9',
      'mode' => 'plain-zip', // Was 'fmt'
      'lic' => 'cc:by-nc-sa%2F2.0%2Fuk[/88x31]',
      'dir' => '/input/directory',
      'out' => '"C:/output directory"',
      'log' => '%2Flogs%2Ffile.log',
      'jspath' => '../Shared',
      'css' => 'font-size:small',
      'e' => '(extended debug)',
      'v' => '(version)',
      'h' => '(help)',
    );
  const ARGS = 'url ac fmt lic dir out log jspath css e v h'; //All.
  const ARGS_REQ = 'dir out';


  public function __construct() {
    parent::__construct();

    if (! $this->input->is_cli_request()) {
      $this->_error('command-line only');
    }

    $this->load->tracker('Google', NULL);
    $this->load->library('Creative_Commons');

    $this->load->helper('directory');
    $this->load->config('batch_config');
  }


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
      $args = array();
    }

    // Process '--X=Y' into key-value pairs -- $params['X'] = 'Y';
    $params = array();
    foreach ($args as $arg) {
      $out;
      parse_str(ltrim($arg, '-'), $out);
      $params += $out;
    }

    // Merge array from configuration file.
	$config = $this->config->item('cli_batch');
    if ($config) {
      echo "Found 'cli_batch' configuration. Merging.. (command line overrides config.)". PHP_EOL;
	  $params += $config;
    }

	if (! $params) {
      $this->_cli_error('missing arguments');
    }

    if (! isset($params['css'])) {
      $params['css'] = '';
    }


    // Parameter validation..
    foreach ($params as $key => $value) {
      if (! isset(self::$ARGS_ALL[$key])) { #in_array($key, $tests)) {
        $this->_cli_error("unrecognised CLI argument '--$key' (--name=value)", 400);
      }
    }
    $params = (object) $params;


    // Output help or version info.
    if (isset($param->h)) {
      $this->_echo_batch_help();
    }
    if (isset($params->v)) {
      $this->_echo_batch_version();
    }

    // Check for required arguments.
    if (! isset($params->dir)) {
      $this->_cli_error("parameter '--dir=%2Finput%2Fdir' is required");
    }

    return $params;
  }


  protected function _cli_error($message) {
    echo 'Error, '. $message . PHP_EOL;
    $this->_echo_batch_help();
  }



  /**
  * THE cli/batch public method.
  */
  public function batch($args = NULL) {
    $params = $this->_parse_batch_args(func_get_args());


    // Make an oEmbed call..
    $result = parent::index($params);


    $dir_map = directory_map($params->dir);

    var_dump($params); #, $dir_map);

    if (! $dir_map) {
      $this->_cli_error("directory_map failed, $params->dir");
    }

    $batch_template = $this->load->view('cc_code/batch_template', $view_data = NULL, $return = TRUE);

    $src_host = parse_url($params->url, PHP_URL_HOST);
    $license_url = $this->cc->getLicenseUrl($params->lic);


    // We'll record some 'counts'
    $cn_proc = $cn_dir = $cn_nohtml = 0;

    foreach ($dir_map as $key => $filename) {
      // Filter directories!
      if (is_array($filename)) {
        echo "Skipping directory, $key" .PHP_EOL;
        $cn_dir++;

        continue;
      }
      if (! preg_match('/.+\.html?$/', $filename)) {
        echo "Skipping non-HTML file, $filename" .PHP_EOL;
        $cn_nohtml++;

        continue;
      }
      // Filter - only HTML/ XML?
      $input = file_get_contents($params->dir .'/'. $filename);
      if (! $input) {
        $this->_cli_error("reading file, $filename");
      }

      $title = $result->title;

      // Get <title>, <h1>..
      if (preg_match('@<h1[^>]*>(.+)</h1@i', $input, $matches)) {
        $title .= '/ '. $matches[1];
      }


      $embed_code = strtr(
        $batch_template,
        array(
          '__GA_ID__' => $params->ac,
          '__CC_TEXT_URL__' => $this->ga->campaignUrl($license_url,
            $params->mode, TRACK_RDF_LIC_LINK, $src_host, $result->identifier),
          '__CC_ICON_URL__' => $this->ga->campaignUrl($license_url,
            $params->mode, TRACK_RDF_LIC_ICON, $src_host, $result->identifier),
          '__CC_ICON_SRC__' => $this->cc->getImageUrl($params->lic),
          #'__CC_TERMS__' => str_replace('cc:', '', $params->lic),   # License terms, eg. 'by', 'by-nc-sa'
          #'__CC_VJ__'    => '3.0',     # License version[/jurisdiction], eg. '2.0/uk' or '3.0'
          '__CC_LABEL__' => 'Creative Commons Attribution 3.0 Unported License',
          '_ATTR_NAME_'  => $result->attribution_name,  #'OpenLearn/ Andrew Studnicky',
          '_ATTR_URL_'   => $this->ga->campaignUrl($result->attribution_url, 
            $params->mode, TRACK_RDF_ATTR_LINK, $src_host, $result->identifier),
          '_TITLE_' => $title,
          '_SOURCE_URL_' => $this->ga->campaignUrl($params->url,
            $params->mode, TRACK_RDF_SRC_LINK, $src_host, $result->identifier),
          '_SOURCE_TEXT_'=> htmlentities($params->url),
          '__COURSE_HOST__'=> $src_host,
          '__COURSE_ID__'  => $result->identifier,
          '__WORK_ID__'    => $filename,
          '__MODE__'       => $params->mode,  	# 'scorm', 'ims' etc.
          '__SCRIPT_PATH__'=> $params->jspath, # Relative path.
          '__SCRIPT_ARG__' => 'type="text/javascript"', # HTML5 ''.
          '__STYLE__' => $params->css,
        )
      );

      // Initially try to inject code before the last closing </div>..
      $cn_inject = 0;
      $output = preg_replace('@(</div>\s+</body>)@ms', $embed_code .PHP_EOL. '$1', $input, 1, $cn_inject);

      //..Fallback to injecting before </body>.
      if (! $cn_inject) {
        $output = preg_replace('@(</(body|html)>)@i', $embed_code .PHP_EOL. '$1', $input, 1, $cn_inject);
      }

	  $out_file = $params->out .'/'. $filename;
      $bytes = @file_put_contents($out_file, $output);
      if (! $bytes) {
        $this->_cli_error("writing file, $out_file");
      }

	  echo "> File out, $bytes : $out_file" .PHP_EOL;

	  $cn_proc++;

	  //break;
    }


    echo "$cn_proc files processed, OK" .PHP_EOL;
    echo "$cn_dir/$cn_nohtml directories/no-HTML files skipped." .PHP_EOL;
    exit (0);
  }



  /**
  * THE cli/md - Markdown public method.
  */
  public function md($args = NULL) {
    #$params = $this->_parse_batch_args(func_get_args());
    #var_dump($_SERVER['argv'], $_SERVER['_']);

    $output = '';

    if (! $args) {
      $this->_cli_error("cli/md requires a file-path argument.");
    }
    $args = str_replace('%2F', '/', $args);
    $args = 0 === strpos($args, '..') ? getcwd() .'/'. $args : $args;

    $file = @file_get_contents($args);
    if (! $file) {
      $this->_cli_error("cli/md problem reading file, $args"); #. $php_errormsg );
    }

    require_once APPPATH .'/libraries/markdown_extended_ex.php';

    $markdown_references = $this->load->view('../config/markdown_references', NULL, true);


    // Some pre-processing.
    $file = preg_replace('/ -- /', ' &ndash; ', $file);
    $file = preg_replace('/\.\.\./', '…', $file);


    $cmd = implode(' ', $_SERVER['argv']);
    $output .= <<<EOF
<!doctype html><meta charset=utf-8 />
<!-- -*- markdown -*- -->
<!--
  \$ php $cmd  ..
-->


EOF;

    $output .= MarkdownExtended_Ex($file . $markdown_references);

    echo $output;
    exit (0);
  }

}
