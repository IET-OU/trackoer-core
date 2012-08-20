<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 11 August 2012.
 * @license
 * @filesource
 */
ini_set('display_errors', 1);


/**
 * Controller for the oEmbed service/ API
 * @link http://oembed.com
 */
class Oembed extends MY_Controller {

  public function index($url = NULL, $format = NULL, $license_url = NULL) {

    $url = $this->input->get('url');


    $this->load->oembed_provider('Openlearn_track');
    $re = $this->provider->getInternalRegex();

    if (! preg_match("@$re@", $url, $matches)) {
      $this->_error('Sorry the URL doesn\'t match the acceptable patterns, '.$url, 400);
    }

    $this->_addStatus("Controller: The input 'url' parameter matched a pattern.");


    // Google Analytics.
    $account = $this->input->get('ac');
    if ($account) {
      $this->load->tracker('Google', NULL);
    }
    if ($account && $this->ga->isValid($account)) {
      $ga_code = $this->ga->getCode($account, $with_trackoer = TRUE);

      $this->_addStatus("Controller: The input 'ac' parameter seems to be a Google Analytics ID. Getting GA embed snippet..."); 
    }

    $this->_addStatus('Controller: Handing to OpenLearn tracker library...');

    $result = $this->provider->call($url, $matches);

    $this->_addStatus('Controller: response complete.');

    if (isset($ga_code)) {
      $result->html .= $ga_code;
      $result->_ga_account = $account;
    }

    if ('Oembed' == get_class($this)) {
      // Needs more work - security etc.!
      $view_data = array(
        'url' => $url,
        'format' => 'json', #$this->input->get('format'),
        'callback' => $this->input->get('callback'),
        'oembed' => (array) $result,
      );
      $this->load->view('api/oembed_render', $view_data);
    }

    // Else, hand back to the 'Oerform' controller..
    return $result;
  }

}

