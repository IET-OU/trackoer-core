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
 * @since		Version 1.0
 * @filesource
 */


abstract class Base_Tracker {

  const NO_REFERER_URL = 'http://noreferer.example.org/';
  const REUSER_HOST = 'reuser.example.edu';

  protected $CI;

  public function __construct() {
    $this->CI =& get_instance();  
  }

  /**
  * @return boolean
  */
  abstract public function isValid($account_or_site_id);

  /**
  * Get the default account or site ID.
  * @return mixed
  */
  abstract public function getDefaultId();

  /**
  * Get the URL with tracking parameters for a web-beacon/web bug.
  * @return string URL
  */
  //abstract public function getBeaconUrl($account, $domain, $url, $referer = NULL, $title = NULL);

  /**
  * Get a HTML snippet containing one or more <script> tags.
  * @return string HTML
  */
  //abstract public function getScript($account = NULL, $with_trackoer = FALSE, $custom_hash = NULL, $is_async = TRUE, $property = '_trackoer_content');

  /**
  * Track a request by some means, eg. re-direction.
  * @return void
  */
  abstract public function track($service, $site_id, $image, $source_host, $source_path, $title=NULL, $referer=NULL, $record = 1);
}


abstract class Redirect_Tracker extends Base_Tracker {
}
