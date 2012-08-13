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
 */


/**
 * Extend the CI Loader class, so that it handles Tracker services, and oEmbed providers.
 *
 * @author N.D.Freear, 20 March 2012.
 * @link
 * http://github.com/IET-OU/ouplayer/blob/master/application/core/MY_Loader.php
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


  /** Load a Tracker service library.
  * @return	void
  */
  public function tracker($service, $object_name = 'tracker') {
    $this->file(APPPATH .'/libraries/Base_Tracker.php');
    return parent::library('trackers/'. ucfirst($service) .'_Tracker', NULL, $object_name);
  }


  /** Load an oEmbed provider class.
  * @return	void
  */
  public function oembed_provider($provider, $object_name = 'provider') {
    // Require the base provider class file.
    $this->file(APPPATH .'/libraries/Oembed_Provider.php');

    // If appropriate, include intermediate class file.
    if ('Moodle_rdf' != $provider) {
      $this->file(APPPATH .'/libraries/providers/Moodle_rdf_serv.php');
    }
    // Simplify lines like, $regex = $this->{"{$name}_serv"}->regex;
    return parent::library("providers/{$provider}_serv", NULL, $object_name);
  }
}
