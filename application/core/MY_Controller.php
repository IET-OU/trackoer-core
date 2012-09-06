<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 9 August 2012.
 * @license		[free/open source -- license to be decided]
 *
 * @link		https://github.com/IET-OU/trackoer-core
 * @since		Version 1.0
 * @filesource
 */



/**
* Based on,
*  @link  https://github.com/IET-OU/ouplayer/blob/master/application/core/MY_Controller.php
*  @link  https://bitbucket.org/cloudengine/cloudengine/src/tip/system/application/libraries/MY_Controller.php
*/
class MY_Controller extends CI_Controller {

  // Default layout/template.
  const LAYOUT = 'ci'; #'bare';

  protected $status = array();
  protected $_request = array();


  public function __construct() {
    parent::__construct();

    $this->_prepare();

    // Enable Cross-Origin Resource Sharing (CORS), http://enable-cors.org | http://w3.org/TR/cors
    @header('Access-Control-Allow-Origin: *');
    @header('Content-Type: text/html; charset=UTF-8');
    #@header("X-Powered-By:");

    log_message('debug', __CLASS__." Class Initialized");
  }


  /** Initialize the application, including the request array.
  */
  protected function _prepare() {
    $this->_request = array(
      'locale' => $this->input->get_default('locale', 'en'),
      'format' => $this->input->get_default('format', 'html'),
	);
  }


  /**
  * Get a request variable, or the whole array.
  * @return mixed
  */
  public function request($key = NULL) {
    if (! $key) {
      return $this->_request;
    }
    return isset($this->_request[$key]) ? $this->_request[$key] : FALSE;
  }



  /** Load the layout library with a 'bare' or OUICE template.
  */
  protected function _load_layout($layout = self::LAYOUT) {
    $layout = 'ci'==$layout ? 'ci' : 'ouice_2';
    $this->load->library('Layout', array('layout'=>"site_layout/layout_$layout"));
	$this->load->helper('url');
  }


  protected function oembedUrl($url, $service = 'oembed', $format = NULL) {
    return site_url($service) .'?url='. urlencode($url);
  }

  /** Add a message to the status queue.
  */
  public function _addStatus($message) {
    $this->status[] = $message;
  }

  /** Get the status-message array.
  */
  protected function _getStatus() {
    return $this->status;
  }

  public function _is_debug($threshold = 0) {
    $is_debug = 0;
	$is_debug += (int) $this->input->get('debug');
	$is_debug += (int) $this->config->item('debug');
	#var_dump(__FUNCTION__, $is_debug, $threshold);
	return $is_debug > $threshold;
  }


  /**
  * Based on @link  https://gist.github.com/1712707
  */
  public function _debug($exp) {
    static $where, $count = 0;
    if ($this->_is_debug()) {
      # $where could be based on __FUNCTION__ or debug_stacktrace().
      if(!$where) $where = str_replace(array('_', '.'), '-', basename(__FILE__));
      @header("X-D-$where-".sprintf('%02d', $count).': '.json_encode($exp));

      foreach (func_get_args() as $c => $arg) {
        if($c > 0) $this->_debug($arg); #Recurse.
      }
      $count++;
    }
  }

  /** Handle fatal errors.
  */
  public function _error($message, $code=500, $from=null, $obj=null) { #Was: protected.
    if ($this->input->is_cli_request()) {
        echo "Error, $message, $code, $from".PHP_EOL;
        #return;

        exit (2);
    }
    /*NDF: needs work!
	elseif ((integer) $code == 400 && 'Oerform' == get_class($this)) {
        if (preg_match('/\{(.+)\}/', $message, $matches)) {
          $this->form_validation->set_message($matches[1], $message);
          return;
        }
    }*/
    #$this->firephp->fb("$code: $message", $from, 'ERROR');
    $this->_log('error', "$from: $code, $message");
    #@header('HTTP/1.1 '. (integer) $code);

    $ex =& load_class('Exceptions', 'core');
    echo $ex->show_error('Track OER error', "$message ($code)", 'error_general', (integer) $code);
    exit;
  }


  public function _log($level='error', $message, $php_error=FALSE) {
    $_CI = $this;
    $_CI->load->library('user_agent');
    $ip = $_CI->input->server('REMOTE_ADDR');
    $ref= $_CI->agent->referrer();
    $ua = $_CI->agent->agent_string();
    $request = $_CI->uri->uri_string().'?'.$_CI->input->server('QUERY_STRING');
    $msg = "$message, $request -- $ip, $ref, $ua";
    log_message($level, $msg);  #, $php_error);


    $fp_level = 'error'==$level ? 'ERROR' : 'INFO';
    $fp_label = 'error'==$level ? 'Error log' : 'Log';
    #$this->firephp->fb($msg, $fp_label, $fp_level);
  }
}


/* Placeholder for translate text function.
 * See: cloudengine/libs./MY_Language; Drupal.
 * @link https://github.com/IET-OU/ouplayer/blob/master/application/core/MY_Lang.php
 */
if (!function_exists('t')) {
  function t($s, $args=null) {
	if (is_array($args)) {
      $s = vsprintf($s, $args);
    }
	// Important: accept empty string!
    elseif ($args || ''==$args) {
      $s = sprintf($s, $args);
    }
    return $s;
  }
}

