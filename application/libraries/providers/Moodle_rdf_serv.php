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
 * If individual course activity pages (eg. mod/oucontent/view..) link to the course RDF we can offer fine-grained per-source-page analytics.
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

      $this->_addStatus('Requesting HTML page over the Web... Received OK.');
      $this->_addStatus('Parsing HTML for RDF link...');

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

    }
#var_dump($rdf_url);
    $rdf_result = $this->_http_request_work_rdf($rdf_url);

    $rdf = $rdf_result->rdf;
    $rdf->_page_title = isset($page_title) ? $page_title : NULL;

    $this->_addStatus("Requesting 'Work' RDF over the Web... Received OK.");
    $this->_addStatus("Parsing 'Work' RDF...");


	$rdf->original_url = $url;
	$rdf->_rdf_type = $rdf->type;
	$rdf->type = 'rich';
	$rdf->_title = isset($rdf->_page_title) ? $rdf->_page_title .' (Course)' : $rdf->title .' (Module)';

	$rdf->_custom_path = $this->_get_custom_hash($rdf);
	$rdf = $this->_get_attribution($rdf);

	$this->_addStatus('Returning to controller.');


	return $rdf;
  }


  /**
   * Overridden in Openlearn_track_serv
   */
  protected function _get_attribution($rdf) {
    $rdf->attribution_name = 'unknown / Moodle-RDF';
    $rdf->attribution_url = $rdf->original_url;

    return $rdf;
  }

  /**
  * Create the custom hash fragment.
  * @return string Eg. "!labspace.open.ac.uk!Learning_to_Learn_1.0!mod/oucontent/view.php?id=1422&section=3!plain-zip!Debug!12"
  */
  protected function _get_custom_hash($rdf, $format = 'mode-unknown') {
    define('SP', TRACKER_PAGE_URL_SEP);
    $p = parse_url($rdf->original_url); #, PHP_URL_HOST);
    return $custom_arg = SP. $p['host'] .SP. $rdf->identifier .SP. $p['path']. (isset($p['query']) ? '?'. $p['query'] : '') .SP. $format;
  }

}

