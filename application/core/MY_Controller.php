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


  protected function _get_cc_code($site_id=2, $source_url=self::SOURCE_LEARN, $title='Learning to Learn', $author='OpenLearn/Bridge to Success', $author_url=self::AUTHOR_URL, $cc_license='by-nc-sa') {
    $p = parse_url($source_url);

    $view_data = array(
      'site_id' => $site_id,
	  'title'   => $title,
	  'source_url' => $source_url,
	  'source_host'=> $p['host'],
	  'source_path'=> ltrim($p['path'], '/'),
	  'author' => $author,
	  'author_url' => $author_url,
	  'cc_license' => $cc_license,
	);

	return $this->load->view('cc_code/cc_code', $view_data, TRUE);
  }

  /** Load the layout library with a 'bare' or OUICE template.
  */
  protected function _load_layout($layout = self::LAYOUT) {
    $layout = 'ci'==$layout ? 'ci' : 'ouice_2';
    $this->load->library('Layout', array('layout'=>"site_layout/layout_$layout"));
	$this->load->helper('url');
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
      header("X-D-$where-".sprintf('%02d', $count).': '.json_encode($exp));

      foreach (func_get_args() as $c => $arg) {
        if($c > 0) $this->_debug($arg); #Recurse.
      }
      $count++;
    }
  }

  /** Handle fatal errors.
  */
  public function _error($message, $code=500, $from=null, $obj=null) { #Was: protected.
    #$this->firephp->fb("$code: $message", $from, 'ERROR');
    $this->_log('error', "$from: $code, $message");
    @header('HTTP/1.1 '. (integer) $code);

    $ex =& load_class('Exceptions', 'core');
    echo $ex->show_error('Track OER error', $message, 'error_general', $code);
    exit;
  }


  public function _log($level='error', $message, $php_error=FALSE) {
    $_CI = $this;
    $_CI->load->library('user_agent');
    $ip = $_SERVER['REMOTE_ADDR'];
    $ref= $_CI->agent->referrer();
    $ua = $_CI->agent->agent_string();
    $request = $_CI->uri->uri_string().'?'.$_SERVER['QUERY_STRING'];
    $msg = "$message, $request -- $ip, $ref, $ua";
    log_message($level, $msg);  #, $php_error);


    $fp_level = 'error'==$level ? 'ERROR' : 'INFO';
    $fp_label = 'error'==$level ? 'Error log' : 'Log';
    #$this->firephp->fb($msg, $fp_label, $fp_level);
  }
}
