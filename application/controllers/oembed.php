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

  protected $request;

  /**
  * THE handler for the oEmbed endpoint.
  */
  public function index($cli_args = NULL) {

    $this->request =
    $request = $this->_parse_oembed_params($cli_args);

    $this->load->oembed_provider('Openlearn_track');
    $re = $this->provider->getInternalRegex();

    if (! preg_match("@$re@", $request->url, $matches)) {
      $this->_error('Sorry the {url} parameter doesn\'t match the acceptable patterns, '.$request->url, 400);
    }

    $this->_addStatus("Controller: The input 'url' parameter matched a pattern.");


    $this->_addStatus('Controller: Handing to OpenLearn tracker library...');

    $result = $this->provider->call($request->url, $matches);


    // Google Analytics.
    if (isset($request->ac) && $request->ac) {
      $this->load->tracker('Google', NULL);

      if ($this->ga->isValid($request->ac)) {

        $this->_addStatus("Controller: The input 'ac' parameter seems to be a Google Analytics ID. Getting GA embed snippet...");

        $ga_code = $this->ga->getCode($request->ac, $with_trackoer = TRUE, $result->_custom_path);

        $result->html .= $ga_code;
        $result->_ga_account = $request->ac;
      } else {
        $this->_error("Unexpected account ID {ac}, $request->ac", 400.10);
      }
    }

    $this->_addStatus('Controller: response complete.');

    if ('Oembed' == get_class($this)) {
      $view_data = array(
        'url' => $request->url,
        'format' => $request->format,
        'callback' => $request->callback,
        'oembed' => (array) $result,
      );
      $this->load->view('api/oembed_render', $view_data);
    }

    // Else, hand back to the 'Oerform' controller..
    return $result;
  }


  /**
  * Parse the oEmbed request for standard and extended oEmbed HTTP parameters.
  */
  protected function _parse_oembed_params($cli_args = NULL) {
    if ($this->input->is_cli_request()) {
       $request = $cli_args;
    } else {
	  $request = (object) array(
        // oEmbed specification.
        'url' => $this->input->get('url'),
        'format' => $this->input->get_default('format', 'json'),
        // JSON-P - a common oEmbed extension.
        'callback'=> $this->input->get('callback', $xs_clean=TRUE),
        // Extended - track OER-specific.
        'mode' => $this->input->get_default('mode', 'online'), #Was 'fmt'
        'lic' => $this->input->get_default('lic', 'cc:by/3.0'),
        // An analytics account ID.
        'ac'  => $this->input->get('ac'),
      );
	}
    if (!isset($request->url) || !$request->url) {
      $this->_error('The URL parameter {url} is required', 400);
    }
    $p = parse_url($request->url);
    if (!isset($p['host'])) {
      $this->_error("The URL parameter {url} is invalid - missing host", 400);
    }

    if (! $this->input->is_cli_request()) {
      if ('json'!=$request->format && 'xml'!=$request->format) {
        $this->_error("The output format {format} '$request->format' is not recognised.", 400.5);
      }

      // Security. Only allow eg. 'Object.func_CB_1234'
      if ($request->callback && !preg_match('/^[a-zA-Z][\w_\.]*$/', $request->callback)) {
        $this->_error("The callback parameter {callback} must start with a letter, and contain only letters, numbers, underscore and '.'", 400.6);
      }
    }

    return $request;
  }

  /* $host = $req->host = str_replace('www.', '', strtolower($p['host']));

    if (!isset($providers[$host])) {
      $this->_error("unsupported provider 'http://$req->host'.", 400);
    }
	*/
}

