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


  public function __construct() {
    parent::__construct();

    $this->load->tracker('Google', NULL);
    $this->load->library('Creative_Commons');

    $this->load->config('providers');
  }


  /**
  * THE handler for the oEmbed endpoint.
  */
  public function index($cli_args = NULL) {

    // Merge the base and extended request arrays - oEmbed parameters override.
    $this->_request = array_merge(
      $this->request(),
      (array) $this->_parse_oembed_params($cli_args)
    );
    $request = (object) $this->request();


    $providers = $this->config->item('providers');

    $url  = str_replace('/www.', '/', $request->url);
    $host = parse_url($url, PHP_URL_HOST);
    #$host = $p['host'];

    if (! isset($providers[$host])) {
      $this->_error('The hostname in the {url} parameter is not supported, '. $request->url, 400.1);
    }

    $provider = $providers[$host];

    $this->load->oembed_provider($provider);  #'Openlearn_track');
    $re = $this->provider->getInternalRegex();

    if (! preg_match("@$re@", $url, $matches)) {
      $this->_error('Sorry the {url} parameter doesn\'t match the acceptable patterns, '. $request->url, 400);
    }

    $this->_addStatus("Controller: The input 'url' parameter matched a pattern.");


    $this->_addStatus("Controller: Handing to the $provider library...");

    $result = $this->provider->call($request->url, $matches);


    $this->load->tracker($request->tracker);

    $source_host = parse_url($request->url, PHP_URL_HOST);

    $result->_tracker_code = $result->_piwik_site_id = $result->_piwik_site_url = $_beacon_url = NULL;

    $_cc_icon = '_CC_ICON_';
    switch ($request->tracker) {
      case 'Piwik':
        $result = $this->_get_piwik_site_id($result);
        $_beacon_url = $this->tracker->getBeaconUrl($result->_piwik_site_id, $request->lic, $source_host, $result->identifier, $request->url, NULL, $result->_title);
        $result->_beacon_url = $_beacon_url;
        $result->_cc_icon = $_cc_icon = $this->cc->getImageUrl($request->lic);

        $this->_addStatus("Controller: Requesting 'site ID' from Piwik API over the Web... Received OK.");
      break;
      case 'Google':
        $this->_addStatus("Controller: Rendering Google Analytics embed snippet...");

        $ga_code = $this->tracker->getCode($request->ac, $with_trackoer = TRUE, $result->_custom_path);

        $result->_tracker_code = $ga_code;
        $result->_ga_account = $request->ac;
      break;
      default:

      break;
    }


    // Legacy Creative Commons snippet.
    ///$cc_code = $this->cc->getCode($result->_piwik_site_id, $result->original_url, $result->identifier, $result->_title, 'OpenLearn/'. $result->contributor, $result->_piwik_site_url);

    $this->_addStatus('Controller: Requesting license-template from Creative Commons server..');


    $cc_template = $this->cc->requestLicense($request->lic, $request->locale);

    $cc_template->html = str_replace('>_SOURCE_URL_<', '>_SOURCE_TEXT_<', $cc_template->html);
    $result->_cc_template = $cc_template->html;


    $cc_code = strtr(
      $cc_template->html,
      array(
        #'__GA_ID__' => $params->ac,
        #'__CC_TEXT_URL__' => $this->ga->campaignUrl($license_url, $params->mode, TRACKER_RDF_LIC_LINK, $source_host, $result->identifier),
        '_ATTR_NAME_'  => 'OpenLearn-LabSpace - Bridge to Success B2S', #'OpenLearn/ Andrew Studnicky',
        '_ATTR_URL_'   => $this->ga->campaignUrl('http://labspace.open.ac.uk/b2s', $request->mode, TRACKER_RDF_ATTR_LINK, $source_host, $result->identifier),
        '_TITLE_' => $result->_title,
        '_SOURCE_URL_' => $this->ga->campaignUrl($request->url, $request->mode, TRACKER_RDF_SRC_LINK, $source_host, $result->identifier),
        '_SOURCE_TEXT_'=> $request->url,

        $_cc_icon => $_beacon_url,
      )
    );

    $result->html = $cc_code;
    $result->html .= $result->_tracker_code;



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


    // Google Analytics, or Piwik?
    $request->tracker = NULL;
    if (isset($request->ac) && $request->ac) {
      $this->load->tracker('Google', NULL);

      if ($this->ga->isValid($request->ac)) {

        $this->_addStatus("Controller: The input 'ac' parameter seems to be a Google Analytics ID. Proceeding with Google-Tracker..");
        $request->tracker = 'Google';
      } else {
        $this->_error("Unexpected account ID {ac}, $request->ac", 400.10);
      }
    }
    if (! $request->tracker) {
      $this->_addStatus("Controller: Proceeding with Piwik-Tracker..");
      $request->tracker = 'Piwik';
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


  protected function _get_piwik_site_id($rdf) {
    if ('Piwik' == $this->request('tracker')) {
	  $this->load->tracker('Piwik');
      $res = $this->tracker->getSiteId($rdf->original_url);

      $rdf->_piwik_site_url = $res->site_url;
      $rdf->_piwik_site_id  = $res->site_id;
	}
    return $rdf;
  }


  /* $host = $req->host = str_replace('www.', '', strtolower($p['host']));

    if (!isset($providers[$host])) {
      $this->_error("unsupported provider 'http://$req->host'.", 400);
    }
	*/
}

