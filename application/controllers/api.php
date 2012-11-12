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
* Experimental REST API controller.
*/
class Api extends MY_Controller {

  public function __construct() {
    parent::__construct();

  }


  public function version($return = FALSE) {
    $result = $this->_git_revision($full = TRUE);

    $this->_render($result);
  }


  /**
  * Call a Piwik API method - echo the result as JSON.
  * How to get optional parameters?  (idSite, url, format, token_auth ..)
  *
  * @example  /api/piwik/getSitesIdFromSiteUrl?url=http://labspace.open.ac.uk
  * @example  /api/piwik/getVersion
  */
  public function piwik($method = NULL) {
    if (! $method) {
      $this->_error('Piwik API error: Missing {method}', 400);
    }

    $this->load->library('PiwikEx');

    if (! method_exists($this->piwik, $method)) {
      $this->_error('Piwik API error: Method not found, '.$method, 404);
    }
    $params = array(
      'url' => $this->input->get('url'),
    );

    $result = $this->piwik->{$method}($params);

    if (! $result) {
      $this->_error('Piwik API error: Empty result', 400.2);
    }

    $this->_render($result);
  }


  /**
  * Get a Creative Commons license 'simple' chooser form widget.
  *
  * @example  /api/cc_chooser/publicdomain/my-select?locale=fr : 'html' in JSON.
  */
  public function cc_chooser($exclude = 'xx', $select = NULL) {
    $this->load->library('Creative_Commons');
    $result = $this->cc->requestChooser($this->request('locale'), $exclude, $select);

    $this->_render($result);
  }

  /**
  * Get the RDF details for a Creative Commons license.
  *
  * @example  /api/cc_details/cc:by/uk?locale=fr : 'data' RDF/XML in JSON.
  */
  public function cc_details($terms = 'cc:by', $jurisdiction = NULL) {
    $this->load->library('Creative_Commons');

    $license = "$terms/$jurisdiction";
    $result = $this->cc->requestDetails($license, $this->request('locale'));

    $this->_render($result);
  }

  /**
  * Get the full RDF for a Creative Commons license.
  *
  * @example  /api/cc_license/cc:by/uk/standard?locale=fr : 'data' RDF/XML in JSON.
  */
  public function cc_license($terms = 'cc:by', $jurisdiction = NULL, $class = 'standard') {
    $this->load->library('Creative_Commons');

    $license = "$terms/$jurisdiction";
    $result = $this->cc->requestLicense($license, $this->request('locale'), $class);

    $this->_render($result);
  }



  // ========================================================================

  /** Utility: render a Markdown file provided via {url} as HTML. Optional {theme}
  */
  public function markdown($refs = FALSE) {
    $this->load->library('Http');
    require_once APPPATH .'/libraries/markdown_extended_ex.php';

    $parser = new MarkdownExtraExtended_Ex_Parser();

    $markdown_references = $parser->loadReferences();
    if ($refs) {
      header('Content-Type: text/plain; charset=UTF-8');
      echo $markdown_references;
      exit;
    }

    $url = $this->input->get('url');
    $theme = $this->input->get('theme');
    if (! $url || ! preg_match('#:\/\/(.*\.ac\.uk|.*\.olnet\.org|.*.github\.com)\/#', $url)) {
      $this->_error('Error, the {url} parameter is missing or unsupported.', 400);
    }

    $result = $this->http->request($url);
    if (! $result->success) {
      $this->_error('Error retrieving file over HTTP.', $result->http_code);
    }

    $output = $parser->getHtmlHead($url, base_url(), $theme);
    $output .= $parser->transform($result->data);
    //output .= PHP_EOL . '</html>';
    echo $output;
  }


  /**
  * Utility: a 'myip' information service (JSON).
  * @link http://www.domaintools.com/research/my-ip/myip.xml
  * @author NDF, 25 Sep 2012.
  */
  public function myip() {
	$this->load->library('user_agent');
	$agent = $this->agent;
	$server_vars = 'HTTP_HOST,HTTP_CONNECTION,HTTP_CACHE_CONTROL,HTTP_USER_AGENT,HTTP_ACCEPT,HTTP_ACCEPT_ENCODING,HTTP_ACCEPT_LANGUAGE,HTTP_ACCEPT_CHARSET,HTTP_REFERER,HTTP_VIA,HTTP_X_FORWARDED_FOR,SERVER_PROTOCOL,REMOTE_ADDR,REMOTE_PORT,REQUEST_TIME';
	$http_vars = (object) array(
		'service_provider' => 'IET-OU',
		'provider_url' => TRACKOER_LIVE_URL,
		'date' => NULL,
		'unix_time' => NULL,
		'browser' => $agent->browser(),
		'version' => $agent->version(),
		'mobile' => $agent->mobile(),
		'platform' => $agent->platform(),
		'ip_address' => NULL,
	);
	foreach (explode(',', $server_vars) as $key) {
		$name = strtolower(str_replace('HTTP_', '', $key));
		$http_vars->{$name} = $this->input->server($key);
	}

	$http_vars->date = date('c', $http_vars->request_time);
	$http_vars->unix_time = $http_vars->request_time;
	$http_vars->ip_address = $http_vars->x_forwarded_for ? $http_vars->x_forwarded_for : $http_vars->remote_addr;
	$http_vars->proxy = $http_vars->via ? $http_vars->via : FALSE;
	$http_vars->proxy_ip = $http_vars->via ? $http_vars->remote_addr : NULL;

	$this->_render($http_vars);
  }


  /**
  * Utility: USNO time XML service.
  * @author NDF, 26 Sep 2012.
  */
  public function time($format = 'xml') {
	$param_n = $this->input->get('n');
	if (! $param_n) {
		$this->_error('The parameter {n} (start response unix timestamp) is required.', 400);
	}

	$this->load->library('Http');

	$url = 'http://tycho.usno.navy.mil/cgi-bin/time.pl?n=' . $param_n;

	$result = $this->http->request($url);

	if (! $result->success) {
		$this->_error('Unknown', $this->http_code);
	}

	@header('Content-Type: application/xml; charset=UTF-8');
	echo $result->data;
  }

  public function time_widget() {
    $this->load->view('api/time_widget_usno.php');
  }


  /** Basic JSON rendering.
  */
  protected function _render($data) {
    @header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: inline; filename='
        . str_replace('/', '-', $this->uri->uri_string()) .'.json');
    echo json_encode($data);
  }
}

