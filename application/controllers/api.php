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


class Api extends MY_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->library('PiwikEx');
  }


  /**
  * Call a Piwik API method - echo the result as JSON.
  * How to get optional parameters?  (idSite, url, format, token_auth ..)
  */
  public function piwik($method = NULL) {
    if (! $method) {
      $this->_error('Missing {method}', 400);
    }
    if (! method_exists($this->piwik, $method)) {
      $this->_error('Method not found, '.$method, 404);
    }
    $url = $this->input->get('url');

    $result = $this->piwik->{$method}($url);

    @header('Content-Type: text/plain; charset=utf-8');
    echo json_encode($result);
  }
}

