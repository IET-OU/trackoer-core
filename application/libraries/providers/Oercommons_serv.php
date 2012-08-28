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

  public $_examples = array(
    'http://oercommons.org/courses/campaigns-and-elections/view',
    'http://oercommons.org/search?f.search=law+contemporary&feed=yes'

  );
  public $_access = 'public';


  /**
  * Implementation of call() - used by oEmbed controller.
  * @return object
  */
  public function call($url, $matches) {
    $course_id = $matches[1];

    $search_url = 'http://www.oercommons.org/search?feed=yes&f.search='
        . str_replace('-', '+', $course_id);
    
    var_dump($search_url);
    exit;
  }
}
