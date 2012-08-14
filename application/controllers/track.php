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
 * Controller for the tracker-redirection service.
 */
class Track extends MY_Controller {

  const API_TEMPLATE    = '/track/r/{service}/{site_id}/{cc:image|-}/{source_host}/{source_identifier}/?p={source_path}?t={title}';
  const API_TEMPLATE_ALT= '/track/r/{service}/{site_id}/{cc:image|-}/{source_host}/?p={source_path}&t={title}&rec=1&debug=2';
  const API_EXAMPLE     = '/track/r/piwik/2/cc:by-nc-sa/labspace.open.ac.uk/Learning_to_Learn_1.0/?p=mod%2Foucontent%2Fview.php%3Fid%3D471422%26section%3D3&t=Learning+to+Learn';
  const API_EXAMPLE_ALT = '/track/r/piwik/2/-/labspace.open.ac.uk/Learning_to_Learn_1.0?p=course%2Fview.php%3Fid%3D7654&t=Succeed+with+Math+(B2S)';
  const API_EXAMPLE_GA  = '/track/r/ga/UA-12345-1/-/labspace.open.ac.uk/Learning_to_Learn_1.0?t=Learning+to+Learn';


  /**
  * THE tracker(-redirection) end point.
  *
  * @link  http://track.olnet.org/track/r/piwik/2/cc:by-nc-sa/labspace.open.ac.uk/Learning_to_Learn_1.0?t=Learning+to+Learn
  */
  public function r($service = NULL, $site_id=NULL, $image=NULL, $source_host=NULL, $source_identifier=NULL) {

	// Handle missing required parameters.
    $explain = "<p>The template is, <code>". self::API_TEMPLATE ."</code> <p>For example, <code>". self::API_EXAMPLE
              ."</code> <p>Or, <code>". self::API_EXAMPLE_ALT ."</code>";

    if (! $service) {
      $this->_error("Expecting a value for {service}.$explain", 400);
    }
	if (! $site_id) {
      $this->_error("Expecting a value for {site_id}.$explain", 400);
    }
	if (! $image) {
      $this->_error("Expecting a value for {image}.$explain", 400);
    }
	if (! $source_host) {
      $this->_error("Expecting a value for {source_host}.$explain", 400);
    }

	return $this->_do_track($service, $site_id, $image, $source_host, $source_identifier);
  }


  public function index() {
    $this->load->helper('url');
	redirect('track/r');
  }


  protected function _do_track($service, $site_id, $image, $source_host, $source_identifier) {

    // Handle optional parameters.
	$source_path = $this->input->get('p');
	$title  = $this->input->get('t');
	$record = $this->input->get('rec');
	$record = ('0' === $record) ? 0 : 1;

	$this->load->library('user_agent');
	$referer = $this->agent->referrer();


    $this->load->tracker($service);

    return $this->tracker->track($service, $site_id, $image, $source_host, $source_identifier, $source_path, $title, $referer, $record);
  }
}
