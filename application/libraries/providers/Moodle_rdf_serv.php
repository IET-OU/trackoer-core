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

    if ('course' == $resource_type) {

      $rdf_url = $url;
      $rdf_url .= FALSE===strpos($url, '?') ? '?' : '&';
      $rdf_url .= 'format=rdf&_source=trackoer';  

      $result = $this->_http_request($rdf_url);

      var_dump($result, $rdf_url);

    } else { //mod/oucontent/..
    #<link rel="alternate" type="application/rdf+xml" href="http://labspace.open.ac.uk/course/view.php?id=7442&amp;format=rdf"/>
var_dump('mod/oucontent/..');
    }
  }

}

