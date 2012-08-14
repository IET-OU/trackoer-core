<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 11 August 2012 (21:28)
 * @license
 * @filesource
 */



/**
 * Moodle repositories that offer per-OER-course RDF meta-data, eg. OpenLearn.
 * If individual course activity pages link to the course RDF we can offer fine-grained per-source-page analytics.
 */
class Moodle_rdf_serv extends Oembed_Provider {

  public $regex = 'http://moodle-rdf.example.edu/*';
  public $about = <<<EOT
  Get the tracker-enabled Creative Commons license snippet for an OER.
  Moodle repositories that offer per-OER-course RDF meta-data, eg. OpenLearn.
  If individual course activity pages link to the course RDF we can offer fine-grained per-source-page analytics.
  [For JISC Track OER. Public access.]';
EOT;
  public $displayname = 'Moodle-hosted OERs with per-course RDF';
  public $domain = 'example.edu';
  public $favicon = 'http://moodle.org/favicon.ico';
  public $type = 'rich';

  public $_about_url= '';
  public $_logo_url = 'http://moodle.org/..logo.jpg';

  public $_examples = array();
  public $_access = 'public';


  /**
  * Implementation of call() - used by oEmbed controller.
  * @return object
  */
  public function call($url, $matches) {

    $resource_type = $matches[2];
    $rdf = (object) array(
	  'original_url' => $url,
	);

    // A Moodle course by numeric ID, name= (/course/view.php?id=..) or http://moodle.example.edu/Short_name
	// - Get the Work-RDF XML associated with the course..
    if ('course' == $resource_type || FALSE===strpos($url, '?')) {

      $rdf_url = $url;
      $rdf_url .= FALSE===strpos($url, '?') ? '?' : '&';
      $rdf_url .= 'format=rdf&_source=trackoer';

      $result = $this->_http_request_work_rdf($rdf_url);

      $rdf = $result->rdf;

    } else {
      // Moodle activity module page, eg. /mod/oucontent/..
      // - Get the HTML page, look for an 'alternate' <LINK>, and follow it to get the Work RDF.
      //<link rel="alternate" type="application/rdf+xml" href="http://labspace.open.ac.uk/course/view.php?id=7442&amp;format=rdf"/>

      $html_url = $url. '&_source=trackoer';
	  #$html_url = 'http://labspace.open.ac.uk/login/index.php?loginguest=true&path='.urlencode($url).'&testsession=153';

      $result = $this->_http_request($html_url, 'like bot', array('debug'=>0, '_ua'=>0));

      if (! $result->success) {
        $this->_error('HTTP Moodle module HTML page error, '. $html_url, $result->http_code);
      }

      #$xmlo = @ new SimpleXML($result->data);

	  if (! preg_match('@<link[^>]+(alternate|rdf\+xml)[^>]+(http://[^"]+)@', $result->data, $matches_link)) {
	    $this->_error('Error finding RDF link in Moodle activity-module page (RE), '. $html_url);
	  }
	  $rdf_url = html_entity_decode($matches_link[2]) .'&_source=trackoer';

	  if (! preg_match('@title>([^>]+)</title@', $result->data, $matches_title)) {
	    $this->_error('Error finding title in Moodle activity-module page (RE), '. $html_url);
	  }
	  $page_title = html_entity_decode($matches_title[1]);
	  $page_title = trim(str_replace(array('The Open University', '&#x2014;'), array('', '—'), $page_title), '- ');

	  $rdf_result = $this->_http_request_work_rdf($rdf_url);

      $rdf = $rdf_result->rdf;
	  $rdf->_page_title = $page_title;
    }

	$rdf->original_url = $url;
	$rdf->_rdf_type = $rdf->type;
	$rdf->type = 'rich';
	$title = isset($rdf->_page_title) ? $rdf->_page_title .' (Course)' : $rdf->title .' (Module)';


    $rdf = $this->_get_piwik_site_id($rdf);


	//
	$this->CI->load->library('Creative_Commons');
	$cc_code = $this->CI->cc->getCode($rdf->_piwik_site_id, $rdf->original_url, $title, 'OpenLearn/'. $rdf->contributor, $rdf->_piwik_site_url);
	$rdf->html = $cc_code;


	return $rdf;
  }


  /**
  *
  <rdf:RDF xmlns="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
    <Work rdf:about="">
          <dc:title>Learning to Learn</dc:title>
  */
  protected function _http_request_work_rdf($rdf_url) {
    $result = $this->_http_request($rdf_url);

    if (! $result->success) {
      $this->_error('HTTP Work-RDF error.', $result->http_code);
    }

    $xmlo = NULL;
    if ($result->success) {
      $xmlo = @ new SimpleXMLElement($result->data);
    }
    if (! $xmlo) {
      $this->_error('XML Work-RDF error.');
    }
    $xmlo->registerXPathNamespace('_', 'http://creativecommons.org/ns#');
    $xmlo->registerXPathNamespace('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
    $xmlo->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');

    $dc_props = explode('|', 'title|subject|description|publisher|contributor|type|format|identifier|source|rights');
    $rdf = array();
    foreach ($dc_props as $key) {
      $value = $xmlo->xpath("/rdf:RDF/_:Work/dc:$key"); #[1]
      $rdf[$key] = (string) $value[0];
    }
    if (preg_match_all('@http://[^ ]+@', $rdf['rights'], $matches)) {
      $rdf['_license_url'] = $matches[0];
    }
	#var_dump((string) $xmlo->Work[0]->{'dc:title'}, $rdf);
	$result->rdf = (object) $rdf;
    return $result;
  }


  protected function _get_piwik_site_id($rdf) {
    // Form a Piwik analytics site URL.
    $p = parse_url($rdf->original_url);
    $site_url = $p['scheme'] .'://'. $p['host'];

    $this->CI->load->library('PiwikEx');
    $piwik_result = $this->CI->piwik->getSitesIdFromSiteUrl($site_url);
    if (! $piwik_result) {
      $this->_error('Piwik fail, '. $site_url);
    }

	$rdf->_piwik_site_url = $site_url;
    $rdf->_piwik_site_id = $piwik_result[0]['idsite'];

	return $rdf;
  }

}

