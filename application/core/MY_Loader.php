<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 20 March 2012.
 * @license
 * @filesource
 *
 * @link  https://github.com/IET-OU/ouplayer/blob/master/application/core/MY_Loader.php
 */


class MY_Loader extends CI_Loader {

  /**
  * Class Loader
  * This function lets users load and instantiate classes.
  * @return	void
  */
  public function library($library = '', $params = NULL, $object_name = NULL) {
   $lib_register = array(
      '_Gitlib' => 'git',
      '_Sams_Auth' => 'auth',
      'Creative_Commons' => 'cc',
      'PiwikEx' => 'piwik',
    );
    if (!$object_name && isset($lib_register[$library])) {
      $object_name = $lib_register[$library];
    }

    return parent::library($library, $params, $object_name);
  }


  /**
  * Load a tracker service.
  */
  public function tracker($service, $obj_name = 'tracker') {
    $this->file(APPPATH .'/libraries/Base_Tracker.php');
    $this->library('trackers/'. ucfirst($service) .'_Tracker', NULL, $obj_name);
  }
}
