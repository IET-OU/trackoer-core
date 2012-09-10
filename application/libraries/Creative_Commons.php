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
 *
 * @link		https://github.com/IET-OU/trackoer-core
 * @link		http://api.creativecommons.org/docs/readme_15.html
 * @link		http://creativecommons.org/choose/results-one?license_code=by-sa&jurisdiction=&version=3.0&lang=fr
 * @since		Version 1.0
 * @filesource
 */


/**
 * Creative Commons
 * Library to generate Creative Commons License embed code snippets, URLs and so on.
 * (Note, we make use of the Creative Commons API - jurisdiction/locale support)
 * @link http://creativecommons.org/
 */
class Creative_Commons {

  const SOURCE_LEARN = 'http://labspace.open.ac.uk/course/view.php?id=7442';
  const SOURCE_ID = 'Learning_to_Learn_1.0';
  const AUTHOR_URL = 'http://labspace.open.ac.uk/b2s';
  const AUTHOR = 'OpenLearn/Bridge to Success';
  const OL_TERMS  = 'cc:by-nc-sa/2.0/uk'; //Was 'by-nc-sa'
  const B2S_TERMS = 'cc:by/3.0'; //Was 'by'

  protected $CI;

  public function __construct() {
    $this->CI =& get_instance();
  }


  /**
  * Parse a license URL or CURIE into it's component parts.
  * {Namespace}:{Terms}/{Version}/{Jurisdiction}/{Icon size}.{Icon format}
  * @return object
  */
  public function parseUrl($url) {
    $curie = $this->compactUrl($url);
    $RE = '^(cc):([a-z\-]{2,8})(/\d\.\d)?(\/[a-z]{2,})?(\/\d{2}x\d{2})?(.png|.gif)?$';
    if (preg_match('@'. $RE .'@', $curie, $matches)) {
      $license = (object) array(
        '_curie' => $curie,
        '_RE'  => $RE,
        'ns'  => $matches[1],
        'term'=> $matches[2],
        'ver' => isset($matches[3]) ? ltrim($matches[3], '/') : '3.0',
        'jur' => isset($matches[4]) ? ltrim($matches[4], '/') : '', #uk
        'sz'  => isset($matches[5]) ? ltrim($matches[5], '/') : '88x31',
        'fmt' => isset($matches[6]) ? ltrim($matches[6], '.') : 'png',
      );
      $license->_vj = $license->ver . ($license->jur ? '/'.$license->jur :'');
      return $license;
    }
    return NULL;
  }

  /** Return the URL for a PNG Creative Commons license image.
  * @param string $curie A Compact URI (CURIE)
  * @link  http://w3.org/TR/curie
  * @param string $size Image dimensions '88x31' (default) or '80x15' (compact).
  * @return string URL.
  */
  public function getImageUrl($curie = 'cc:by/3.0', $size = '88x31') {
    $lic = $this->parseUrl($curie);
    return 'http://i.creativecommons.org/l/'. $lic->term .'/'. $lic->_vj .'/'. $lic->sz .'.png';
  }

  /** Return a License deed URL.
  */
  public function getLicenseUrl($curie = 'cc:by/3.0', $locale = 'en_GB') {
    $lic = $this->parseUrl($curie);

    return 'http://creativecommons.org/licenses/'
        . $lic->term .'/'. $lic->_vj .'/deed.'. $locale;
  }

  /** Return an expanded Compact URI.
  */
  public function expandUrl($curie = 'cc:by/3.0') {
    $lic = $this->parseUrl($curie);

    return 'http://creativecommons.org/licenses/'. $lic->term .'/'. $lic->_vj .'/';
  }

  public function compactUrl($url = 'http://creativecommons.org/licenses/by/3.0') {
    return str_replace('http://creativecommons.org/licenses/', 'cc:', $url);
  }

  /**
  * Generate a HTML license-tracker snippet (embed code).
  * @return string
  */
  public function getCode($site_id=2, $source_url=self::SOURCE_LEARN, $source_identifier=self::SOURCE_ID, $title='Learning to Learn', $author=self::AUTHOR, $author_url=self::AUTHOR_URL, $cc_terms=self::OL_TERMS) {
    $p = parse_url($source_url);

    $locale = $this->CI->input->get_default('locale', 'en_GB');

    $lic = $this->parseUrl($cc_terms);
    $license = $lic->term .'/'. $lic->_vj;

    $details = $this->requestDetails('cc:'. $license, $locale);

    $view_data = array(
	  'serv' => $site_id ? 'piwik' : NULL,
	  'site_id' => $site_id,
	  'title'   => $title,
	  'source_url' => htmlentities($source_url),
	  'source_host'=> $p['host'],
	  'source_identifier' => htmlentities($source_identifier),
	  'source_path'=> ltrim($p['path'], '/') . (isset($p['query']) ? '?'. $p['query'] :''),
	  'author' => $author,
	  'author_url' => $author_url,
	  'cc_license' => NULL,
	  'cc_terms'=> $lic->term, //$cc_terms,
	  'cc_ver' =>  $lic->ver, //2.0,
	  'cc_jur' => $lic->jur, //'uk',
	  'cc_loc' => $locale,
	  'cc_siz' => $lic->sz, //'88x31', # Or, '80x15'
	  'cc_license' => $license,
	  'cc_label' => $details->_html_hack,
	  'with_tracker' => (bool) $site_id,
	  'explain_tracking_url' => NULL,  //'#!Explain..',
	);

	return $this->CI->load->view('cc_code/cc_code', $view_data, TRUE);
  }


  /** Escape the input embed code, for use in a [textarea].
  */
  public function escape($code) {
    // Note, order matters.
    return str_replace(array('&', '<', "\n"), array('&amp;', '&lt;', ''), $code);
    #return htmlentities($code, ENT_NOQUOTES); (ENT_HTML5);
  }


  /**
  * API request for a Creative Commons license 'simple' chooser form widget.
  * @return object
  */
  public function requestChooser($locale = 'en', $exclude = 'publicdomain', $select = NULL) {

    $result = $this->_requestApi('simple/chooser', array(
        'locale'  => $locale,
        'exclude' => $exclude,
        'select'  => $select,
    ));

    return (object) array(
      'api_url' => $result->info['url'],
      'exclude' => $exclude,
      'locale'  => $locale,
      'select'  => $select,
      'html' => $result->data,
    );
  }

  /**
  * API request for the RDF details for a Creative Commons license.
  *
  * @deprecated  Not very flexible and requires hacks!
  * @see         Use Creative_Commons::requestLicense instead.
  * @return object.
  */
  public function requestDetails($curie = 'cc:by', $locale = 'en') {
    $url = $this->expandUrl($curie);

    $result = $this->_requestApi('details', array(
        'license-uri' => $url,
        'locale' => $locale,
    ));

    $result = self::_parseRdfHtml($result, $curie, $locale);

    // "This work is licensed under a <a ..>..</a>."
    if ($result->html && preg_match('@\/a><br\/>(.+?)$@', $result->html, $match_br)) {
      $result->html_text = $match_br[1];

      // Hack - if the locale is English trim 'This work'
      $result->_html_hack = rtrim(
          str_replace('. This work', '', '. '. $result->html_text), '.');
      $result->_html_hack = self::_localeSpan($result->_html_hack, $locale);
    }

    // ALT text "Creative Commons License"
    if ($result->html && preg_match('@alt="([^"]+)"@', $result->html, $match_alt)) {
      $result->alt_text = $match_alt[1];
    }

    return $result;
  }

  /**
  * API request for the full RDF for a Creative Commons license, including a HTML template.
  * Template placeholders are used, eg. '_TITLE_' for the 'Title of work'.
  * @return object
  */
#./get?commercial=n&derivatives=sa&jurisdiction=&locale=&title=&source-url=S&creator=
  public function requestLicense($curie = 'cc:by', $locale = 'en', $class= 'standard') {
    $lic = $this->parseUrl($curie);

    // Deduce the request parameters from the compact URI.
    $cc_licenses = array(
      'by'      => array('commercial' => 'y', 'derivatives' => 'y'),
      'by-nc'   => array('commercial' => 'n', 'derivatives' => 'y'),
      'by-nc-sa'=> array('commercial' => 'n', 'derivatives' => 'sa'),
      'by-nd'   => array('commercial' => 'y', 'derivatives' => 'n'),
      'by-sa'   => array('commercial' => 'y', 'derivatives' => 'sa'),
    );

    $cc_terms = isset($cc_licenses[$lic->term]) ? $cc_licenses[$lic->term] : array('_e' => 'ERROR');

    $params = array_merge($cc_terms, array(
        'locale' => strtolower(str_replace('_', '-', $locale)),
        'jurisdiction' => $lic->jur,
        'title'  => '_TITLE_',
        'attribution_name'=> '_ATTR_NAME_',
        'attribution_url'  => '_ATTR_URL_',
        'source-url'=> '_SOURCE_URL_',

        #'type' => 'image',
        #'more_permissions_url' => '_MORE_URL_',
    ));

    $result = $this->_requestApi("license/$class/get", $params);

    return self::_parseRdfHtml($result, $curie, $locale);
  }

  /**
  * Utility to extract the license HTML snippet from XML/RDF.
  * (Note, we should fully parse the XML, instead we use a regular expression.)
  * @return object
  */
  protected static function _parseRdfHtml($result, $curie, $locale) {
    if (preg_match('@<html>(.+)<\/html>@', $result->data, $matches)) {
      $result->api_url = $result->info['url'];
      $result->curie = $curie; //original_url
      $result->locale = $locale;
      $result->html = $matches[1];

      $result->html = self::_localizeUrl($result->html, $locale);
    }
    return $result;
  }

  /** Utility to localize the license-URL in a HTML or text snippet.
  */
  protected static function _localizeUrl($text, $locale) {
    if (FALSE === strpos($text, '/deed.')) {
      $locale = str_replace('-', '_', $locale);
      #$text = str_replace('/">', '/deed.'. $locale .'">', $text);
      $text = preg_replace('@(creativecommons.org\/licenses[^"]+)\/@', '$1/deed.'. $locale, $text);
    }
    return $text;
  }

  /** Utility to wrap text in a <span>, with a 'lang' attribute (except for English locales - bias?)
  */
  protected static function _localeSpan($text, $locale) {
    if (0 !== strpos($locale, 'en')) {
      $text = "<span lang='$locale'>$text</span>";
    }
    return $text;
  }

  /**
  * Make a request to the Creative Commons version 1.5 REST API.
  *
  * @link http://api.creativecommons.org/docs/readme_15.html
  * @return object
  */
  protected function _requestApi($api_path, $params = array()) {
    $api_url = 'http://api.creativecommons.org/rest/1.5/'
        . $api_path .'?'. http_build_query($params);

    @header('X-CC-Api-Url: '. $api_url);

    $this->CI->load->library('Http');
    $result = $this->CI->http->request($api_url);

    if (! $result->success) {
      $this->CI->_error('Creative Commons API error -- Web proxy maybe? ', $result->http_code);
    }
    if ($result->success && FALSE !== strpos($result->data, '<error>')) {
      $result->success = FALSE;
      preg_match('@<message>(.+)<\/message>@', $result->data, $matches);
      $this->CI->_error('Creative Commons API error, '. $matches[1] .' '. $api_url);
    }
    return $result;
  }
}
