<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 24-26 August 2012
 * @filesource
 */



/**
 * 
 */
class Oercommons_serv extends Oembed_Provider {

  public $regex = 'http://oercommons.org/courses/*';
  public $about = <<<EOT
  Get the tracker-enabled Creative Commons license snippet for an OER.
  Garner meta-data for OERs offered via Oercommons.org
  [For JISC Track OER. Public access.]';
EOT;
  public $displayname = 'OER Commons';
  public $domain = 'oercommons.org';
  public $favicon = 'http://oercommons.org/favicon.ico';
  public $type = 'rich';

  public $_about_url= 'http://oercommons.org/information';
  public $_logo_url = 'http://www.oercommons.org/media/images/logo.png';

  public $_regex_real = 'oercommons\.org\/courses\/([a-z-]+)';

  public $_examples = array(
    'http://oercommons.org/courses/campaigns-and-elections/view',
    '_RSS' => 'http://oercommons.org/search?f.search=law+contemporary&feed=yes'

  );
  public $_access = 'public';


  /**
  * Implementation of call() - used by oEmbed controller.
  * @return object
  */
  public function call($url, $matches) {
    $course_id = $matches[1];

    $search_url = 'http://www.oercommons.org/search?feed=yes&f.search=%22'
        . str_replace('-', '+', $course_id)
        . '%22';
    $iframe_url = "http://www.oercommons.org/courses/$course_id/view";

    $result = $this->_http_request($iframe_url);

    if (! $result->success) {
      $this->_error("Error requesting HTML page, $iframe_url", $result->http_code);
    }

    if (! preg_match('/<iframe.*src="([^"]+)"/', $result->data, $matches_src)) {
      $this->_error("Error finding course URL in page, $iframe_url");
    }
    $course_url = $matches_src[1];

    if (preg_match('/button" +data-identifier="([^"]+)"/', $result->data, $matches_id)) {
      $id = $matches_id[1]; #35.35915
    }

    #$result = $this->_http_request($search_url);

    if (! $result->success) {
      $this->_error("Error requesting search feed XML, $search_url", $result->http_code);
    }


    var_dump($search_url, $matches, $course_url, $id);
    #var_dump($result);
    
    exit;
  }
}
