<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 9 August 2012.
 * @license
 * @link		https://github.com/IET-OU/trackoer-core
 * @link		http://piwik.org/docs/tracking-api/reference
 * @link		http://snipplr.com/view/37647
 * @since		Version 1.0
 * @filesource
 */


/**
 * Google Analytics tracker
 * A wrapper around GA Javascript, with Track OER extensions.
 */
class Google_Tracker extends Base_Tracker {

  protected $tracker_url;


  public function __construct() {
    parent::__construct();
	$this->CI->load->helper('url');

    $this->tracker_url;
  }


  public function isValid($account) {
    return preg_match('/^UA-\d{4,10}-\d{1,2}$/', $account);
  }


  public function getSiteId($url, $subject = NULL) {
    return NULL;
  }

  /**
  * @return string
  */
  public function getCode($account, $with_trackoer = FALSE, $is_async = TRUE, $property = '_trackoer_content') {

    $view_data = array(
      'account'  => $account,
	  'property' => $property,
	  'with_trackoer' => $with_trackoer,
    );
    return $this->CI->load->view('cc_code/google_analytics_code_async', $view_data, TRUE);
  }

  /**
  * Implementation of track() - used by Track controller.
  * @return void
  */
  public function track($service, $site_id, $image, $source_host, $source_identifier=NULL, $source_path=NULL, $title=NULL, $referer=NULL, $record = 1) {
    return NULL;
  }
  
}
