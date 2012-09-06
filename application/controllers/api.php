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


/**
* Experimental REST API controller.
*/
class Api extends MY_Controller {

  public function __construct() {
    parent::__construct();

  }


  /**
  * Call a Piwik API method - echo the result as JSON.
  * How to get optional parameters?  (idSite, url, format, token_auth ..)
  *
  * @example  /api/piwik/getSitesIdFromSiteUrl?url=http://labspace.open.ac.uk
  * @example  /api/piwik/getVersion
  */
  public function piwik($method = NULL) {
    if (! $method) {
      $this->_error('Piwik API error: Missing {method}', 400);
    }

    $this->load->library('PiwikEx');

    if (! method_exists($this->piwik, $method)) {
      $this->_error('Piwik API error: Method not found, '.$method, 404);
    }
    $params = array(
      'url' => $this->input->get('url'),
    );

    $result = $this->piwik->{$method}($params);

    if (! $result) {
      $this->_error('Piwik API error: Empty result', 400.2);
    }

    $this->_render($result);
  }


  /**
  * Get a Creative Commons license 'simple' chooser form widget.
  *
  * @example  /api/cc_chooser/publicdomain/my-select?locale=fr : 'html' in JSON.
  */
  public function cc_chooser($exclude = 'xx', $select = NULL) {
    $this->load->library('Creative_Commons');
    $result = $this->cc->requestChooser($this->request('locale'), $exclude, $select);

    $this->_render($result);
  }

  /**
  * Get the RDF details for a Creative Commons license.
  *
  * @example  /api/cc_details/cc:by/uk?locale=fr : 'data' RDF/XML in JSON.
  */
  public function cc_details($terms = 'cc:by', $jurisdiction = NULL) {
    $this->load->library('Creative_Commons');

    $license = "$terms/$jurisdiction";
    $result = $this->cc->requestDetails($license, $this->request('locale'));

    $this->_render($result);
  }

  /**
  * Get the full RDF for a Creative Commons license.
  *
  * @example  /api/cc_license/cc:by/uk/standard?locale=fr : 'data' RDF/XML in JSON.
  */
  public function cc_license($terms = 'cc:by', $jurisdiction = NULL, $class = 'standard') {
    $this->load->library('Creative_Commons');

    $license = "$terms/$jurisdiction";
    $result = $this->cc->requestLicense($license, $this->request('locale'), $class);

    $this->_render($result);
  }


  /** Basic JSON rendering.
  */
  protected function _render($data) {
    @header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: inline; filename='
        . str_replace('/', '-', $this->uri->uri_string()) .'.json');
    echo json_encode($data);
  }
}

