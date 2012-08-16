<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, April 2010-16 August 2012.
 * @filesource
 */


/**
 * Controller for a responder for Uptime Server Monitoring services. 
 *
 * @link http://github.com/IET-OU/ouplayer/blob/master/application/controllers/upt..
 * @link http://uptime.openacs.org/uptime/
 * @link http://uptime.solutiongrove.com/uptime/
 */
class Uptime extends MY_Controller {

  public function index() {

    $this->load->library('PiwikEx');
    $result = $this->piwik->getVersion();

    $this->_debug('Piwik service OK; version='. $result);

    @header('Content-Type: text/plain; charset=UTF-8');
    echo 'success';
  }
}
