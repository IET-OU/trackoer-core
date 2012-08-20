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


  public function __construct() {
    parent::__construct();
	$this->CI->load->helper('url');

  }

  public function isValid($account) {
    return preg_match('/'. $this->getRegex() .'/', $account);
  }

  public function getRegex() {
    return '^UA-\d{4,10}-\d{1,2}$';
  }


  public function getDefaultId() {
    return $this->CI->config->item('google_analytics_default_id');
  }


  public function getSiteId($url, $subject = NULL) {
    return NULL;
  }

  /**
  * Get asynchrous GA HTML snippet (containing <script>).
  * Note, this should appear after the Creative Commons license code.
  *
  * @param string $custom_hash  Hash fragment, example "!labspace.open.ac.uk!Learning_to_Learn_1.0!mod/oucontent/view.php?id=1422&section=3!plain-zip!Debug!12"
  * @param string $property  GA 'property' identifier. We assume there will be at least 2 Google Analytics accounts on a page - prevent conflicts.
  * @link http://stackoverflow.com/questions/2651834/google-analytics-async-tracking-with-two-accounts
  * @return string
  */
  public function getCode($account = NULL, $with_trackoer = FALSE, $custom_hash = NULL, $is_async = TRUE, $property = '_trackoer_content') {

    $view_data = array(
      'account'  => $account ? $account : $this->getDefaultId(),
	  'property' => $property,
	  'with_trackoer' => $with_trackoer,
	  'custom_hash' => $custom_hash,
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
