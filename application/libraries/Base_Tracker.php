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

  protected $CI;

  public function __construct() {
    $this->CI =& get_instance();  
  }

  abstract public function track($service, $site_id, $image, $source_host, $source_path, $title=NULL, $referer=NULL, $record = 1);
}


abstract class Redirect_Tracker extends Base_Tracker {
}
