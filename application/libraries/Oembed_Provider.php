<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Base class for all oEmbed service provider libraries.
 *
 * @copyright Copyright 2011 The Open University.
 * @author N.D.Freear, extracted from oem. controller 24 Feb 2011/ extended 4 July 2012.
 * @link
 *http://github.com/IET-OU/ouplayer/../application/libraries/Oembed_Provider.php
 */


interface iService {

  /** call.
  * @return object Return a $meta meta-data object, as inserted in DB.
  */
  public function call($url, $regex_matches);
}


/** Was: Base_service
*/
abstract class Oembed_Provider implements iService {

  public $regex = '';			# array();
  public $about = '';			# Human
  public $displayname = '';		# Human, mixed-case
  public $name = NULL;			# Auto-generate, machine-readable, lower-case.
  public $domain = '';			# HOST
  public $subdomains = array();	# HOSTs
  public $favicon = '';			# URL
  public $type = 'rich';		# photo|video|link|rich (http://oembed.com/#section2.3) NOT 'audio'

  // Variables/methods marked '#' are not applicable to Track OER - to remove.
  #public $_type_x = NULL;
  public $_about_url = NULL;
  public $_regex_real = NULL;
  public $_examples = array();
  #public $_google_analytics = NULL; # 'UA-12345678-0'

  #public $_access = 'public';	# public|private|unpublished|external (Also 'maturity'..?)


  protected $CI;

  /** Constructor: auto-generate 'name' property.
  */
  public function __construct() {
    $this->CI =& get_instance();

    // We use $this - an instance, not a class.
    $this->name = strtolower(preg_replace('#_serv$#i', '', get_class($this)));

    /*
    // Get the Google Analytics ID, if available.
    $this->CI->config->load('providers');
    $ga_analytics_ids = $this->CI->config->item('provider_google_analytics_ids');
    if (isset($ga_analytics_ids[$this->name])) {
      $this->_google_analytics = $ga_analytics_ids[$this->name];
    }
    */
  }


  /** Get the machine-readable name for the Scripts controller.
  * @return string
  */
  public function getName() { return $this->name; }

  /** Get the oEmbed type for the Scripts controller.
  */
  public function getType() { return $this->type; }

  /** Get the path to the view for the Oembed controller (relative to application/views directory, without '.php').
  * @return string
  */
  public function getView() {
    return 'oembed/'. $this->name;
  }

  /** Get the regular expression for the Oembed controller.
  * @return string
  */
  public function getInternalRegex() {
    return $this->_regex_real ? $this->_regex_real : str_replace(array('*', '/'), array('([\w_-]*?)', '\/'), $this->regex);
  }

  /** Get 'published' properties for Services controller (Cf. http://api.embed.ly/1/services)
  * @return object
  */
  public function getProperties() {
    $choose = explode('|', 'regex|about|displayname|name|domain|subdomains|favicon|type');
    $props = (object)array();
    foreach (get_object_vars($this) as $key => $value) {
      if (in_array($key, $choose)) {
        $props->{$key} = $value;
      }
    }
    if (is_string($props->regex)) {
      $props->regex = array($props->regex);
    }
    return $props;
  }


  /** Generate a list of the example links for a provider.
  */
  public function getExampleLinks($sep = ' ', $urlprefix = TRUE, $limit = 5) {
    $links = '';
    $count = 0;
    foreach ($this->_examples as $text => $example_url) {
      if ($count > $limit) break;
      if ($text[0] == '_') continue;
      $actual_url = $example_url;
      if (TRUE===$urlprefix) {
        $actual_url = site_url('oerform') .'?url='. urlencode($example_url);
      }
      $links .= $sep . anchor(htmlentities($actual_url), htmlentities($example_url));
    }
    return $links;
  }


  protected function _error($message, $code=500, $from=null, $obj=null) {
    return $this->CI->_error($message, $code, $from, $obj);
  }

  protected function _log($level='error', $message, $php_error=FALSE) {
    return $this->CI->_log($level, $message, $php_error);
  }


  protected function _http_request($url, $spoof=TRUE, $options=array()) { #_curl
    $this->CI->load->library('http');
    return $this->CI->http->request($url, $spoof, $options);
  }

  protected function _http_request_json($url, $spoof=TRUE, $options=array()) {
    $result = $this->_http_request($url, $spoof, $options);
    if ($result->success) {
      $result->json = json_decode($result->data);
    }
    return $result;
  }

  #protected function _safe_xml($xml) {..}
  #function _mkdir_safe($base, $path, $perm=0777) {..}
  #protected function _embedly_api_key() {..}
  #protected function _embedly_oembed_url($url) {..}
}


//abstract class Moodlebased_Provider extends Oembed_Provider { }

