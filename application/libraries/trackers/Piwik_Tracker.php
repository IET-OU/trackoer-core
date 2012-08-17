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
 * @link		http://piwik.org/docs/tracking-api/reference
 * @link		http://snipplr.com/view/37647
 * @since		Version 1.0
 * @filesource
 */


/**
 * PIWIK tracker
 * It works server-side and redirects to a Piwik installation.
 */
class Piwik_Tracker extends Redirect_Tracker {

  protected $tracker_url;


  public function __construct() {
    parent::__construct();
	$this->CI->load->helper('url');

    $this->tracker_url = $this->CI->config->item('piwik_url') .'/piwik.php?';
  }


  public function isValid($site_id) {
    return is_int($site_id) && $site_id > 0 && $site_id < 100;
  }

  public function getDefaultId() {
    return $this->CI->config->item('piwik_default_id');
  }


  public function getBaseUrl() {
    return $this->CI->config->item('piwik_url');
  }

  public function getSiteId($url, $subject = NULL) {
    // Form a Piwik-analytics site URL.
    $p = parse_url($url);
    $site_url = $p['scheme'] .'://'. $p['host'];

    $this->CI->load->library('PiwikEx');
    $piwik_result = $this->CI->piwik->getSitesIdFromSiteUrl($site_url);
    if (! $piwik_result) {
      $this->_error('Piwik get site_id fail, '. $site_url);
    }

    $result = (object) array(
      'site_id'  => $piwik_result[0]['idsite'],
      'site_url' => $site_url,
    );
    if (! $this->isValid($result->site_id)) {
      $this->_error("Piwik site_id not valid, $result->site_id, $site_url");
    }
    return $result;
  }

  /**
  * Implementation of track() - used by Track controller.
  * @return void
  */
  public function track($service, $site_id, $image, $source_host, $source_identifier=NULL, $source_path=NULL, $title=NULL, $referer=NULL, $record = 1) {
    $CI = $this->CI;
	$CI->_debug(__CLASS__);

	$referer = $referer ? $referer : 'http://noreferer.example.org/';

	// See, http://piwik.org/docs/tracking-api/reference
	$request = (object) array(
	  // An integer: 1, 2..
	  'idsite' => $site_id,
	  'rec' => $record,
	  // 'AlternateImage' plugin for Piwik uses 'img'.
	  'img' => $image,
	  // For the no-Javascript web-bug image, the OER's destination URL is the referrer.
	  'url' => $referer .'#!'. $source_identifier .'!'. $source_path,
	  // The custom Page title..
	  'action_name' => $title,
	  // We don't have a user '_id'...

	  // A random number, to avoid the tracking request being cached by the browser or a proxy.
	  'rand' => rand(101, 999),
	  // Piwik API version.
	  'apiv' => 1,
	  // And we put the OER's source URL in the 'referer' slot.
	  'urlref' => 'http://'. $source_host .'/'. $source_path,
	  // Visit-scope custom variables - JSON encoded.
	  // {"0":["KEY","VALUE"]}
	  // {"0":["license","cc:by-nc-sa/2.0/uk"]}
	  '_cvar' => (object) array(
	    #'0' => array('Via', __CLASS__),
		'0' => array('Image', $image),
	  ),
	);
	if ($CI->_is_debug(1)) {
	  $request->url .= '!Debug!'. $request->rand;
	  #$request->action_name .= '!Debug!'. $request->rand;

	  $request->_cvar->{'1'} = array('Via', site_url('track/'. $service) .'/..');
	  #$request->_cvar->{'2'} = array('Debug', $request->rand);
	}
	$CI->_debug($request);

	$request->_cvar = json_encode($request->_cvar);

	$redirect_url = $this->tracker_url . http_build_query($request);

	if ($CI->_is_debug(3)) {
	  echo 'DEBUG (redirect) -- '. $redirect_url;
	} else {
	  redirect($redirect_url);
	}
  }
  
}
