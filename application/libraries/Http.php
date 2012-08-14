<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * HTTP request library.
 * Code from base_service.php, using cURL.
 *
 * @copyright Copyright 2011 The Open University.
 * @author N.D.Freear, 6 March 2012.
 * @link https://github.com/IET-OU/ouplayer/blob/master/application/libraries/http.php
 * @link http://api.drupal.org/api/drupal/core%21includes%21common.inc/function/drupal_http_request/8
 */


class Http {

  protected $CI;

  const UA_DEFAULT = 'TrackOER/0.1 (PHP/cURL) (+http://track.olnet.org)';
  const UA_BROWSER = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.142 Safari/535.19'; // Updated, April 2012.
  const UA_BROWSER_2 = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.6; en-GB; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3';
  const UA_GOOGLEBOT = 'Googlebot/2.1 (+http://www.googlebot.com/bot.html)';
  const UA_LIKE_BOT = 'TrackOER/0.1 (PHP/cURL like Googlebot/2.1) (+http://track.olnet.org)';
  const UA_LIKE_BOT_2 = 'Mozilla/5.0 (compatible; PHP-trackoer/0.1; Googlebot/2.1)';


  public function request($url, $spoof=TRUE, $options=array()) {
    $use_curl = TRUE;
    if ($use_curl) {
      $result = $this->_prepare_request($url, $spoof, $options);
      return $this->_http_request_curl($url, $spoof, $options, $result);
    }
    else {
      // php.ini: allow_url_fopen
      #ini_set('track_errors', 1);	global $php_errormsg;
      ini_set('user_agent', 'PHP-trackoer/0.1 (+http://track.olnet.org)');

      $result = (object) array(
        'url' => $url,
        'success' => NULL,
        'http_code' => NULL,
        'data' => @ file_get_contents($url),
        '_headers' => $http_response_header,
        #'_er' => error_get_last(), '_e2' => $php_errormsg,
      );
      $result->success = $result->data!==FALSE;
      $result->http_code = (int) substr($result->_headers[0], 9, 3);
      return $result;
    }
  }


  /** Prepare the HTTP request.
  */
  protected function _prepare_request($url, $spoof, &$options) {
    $this->CI =& get_instance();
    $this->CI->load->helper('url');

	$result = new stdClass();

    // Parse the URL and make sure we can handle the schema.
    $uri = @parse_url($url);

    if ($uri == FALSE) {
      $result->error = 'unable to parse URL';
      $result->code = -1001;
      return $result;
    }

    if (!isset($uri['scheme'])) {
      $result->error = 'missing schema';
      $result->code = -1002;
      return $result;
    }

    #timer_start(__FUNCTION__);


    // Bug #1334, Proxy mode to fix VLE caption redirects (Timedtext controller).
    if (isset($options['proxy_cookies'])) {
      $cookie_names =  $this->CI->config->item('httplib_proxy_cookies');
      if (! is_array($cookie_names)) {
        $this->CI->_error('Array expected for $config[httplib_proxy_cookies]', 400);
      }

      $cookies = '';
      foreach ($cookie_names as $cname) {
        $cookies .= "$cname=". $this->CI->input->cookie($cname) .'; ';
      }
      $options['cookie'] = rtrim($cookies, '; ');
    }


    // Merge the default options.
    $options += array(
      'headers' => array(),
      'method' => 'GET',
      'data' => NULL,
      'max_redirects' => 2,  #3,
      'timeout' => 15.0,  #30.0 seconds,
      'context' => NULL,

      'cookie' => NULL,
      'ua' => $this->_get_user_agent($spoof),
      'debug' => FALSE,
      'auth' => NULL, #'[domain\]user:password'
    );

    return $result;
  }


  /** Perform the HTTP request using cURL.
  */
  protected function _http_request_curl($url, $spoof, $options, $result) {
    if (!function_exists('curl_init'))  die('Error, cURL is required.');

    $h_curl = curl_init($url);
    curl_setopt($h_curl, CURLOPT_USERAGENT, $options['ua']);
    if (!$spoof) {
      curl_setopt($h_curl, CURLOPT_REFERER, base_url());
    }

    if ($options['cookie']) {
		curl_setopt($h_curl, CURLOPT_COOKIE, $options['cookie']);
		header('X-Proxy-Cookie: '.$options['cookie']);
    }

    curl_setopt($h_curl, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($h_curl, CURLOPT_MAXREDIRS, $options['max_redirects']);
    curl_setopt($h_curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($h_curl, CURLOPT_TIMEOUT, $options['timeout']);

    if ($options['debug']) {
      curl_setopt($h_curl, CURLOPT_HEADER, TRUE);
      curl_setopt($h_curl, CURLINFO_HEADER_OUT, TRUE);
    }

    if ($options['auth']) {
      //TODO: http://unitstep.net/blog/2009/05/05/using-curl-in-php-to-access-https-ssltls-protected-sites/
      curl_setopt($h_curl, CURLOPT_SSL_VERIFYPEER, FALSE);

      curl_setopt($h_curl, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);
      curl_setopt($h_curl, CURLOPT_USERPWD, $options['auth']);
    }

	$http_proxy = $this->CI->config->item('http_proxy');
	if ($http_proxy) {
	  curl_setopt($h_curl, CURLOPT_PROXY, $http_proxy);
	}
    curl_setopt($h_curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result->data = curl_exec($h_curl);

    $result->_headers = NULL;
    // Fragile: rely on cURL always putting 'Content-Length' last..
    if ($options['debug'] && preg_match('#^(HTTP\/1\..+Content\-Length: \d+\s)(.*)$#ms', $result->data, $matches)) {
      $result->_headers = $matches[1];
      $result->data = trim($matches[2], "\r\n");
    }
    if ($errno = curl_errno($h_curl)) {
      //Error. Quietly log?
      $this->CI->_log('error', "cURL $errno, ".curl_error($h_curl)." GET $url");
      #$this->CI->firephp->fb("cURL $errno", "cURL error", "ERROR");
    }
    $result->info = curl_getinfo($h_curl);
    $result->http_code = $result->info['http_code'];
    $result->success = ($result->info['http_code'] < 300);
    return (object) $result;
  }


  /** Determine a User-Agent string.
  *
  * http://www.installationwiki.org/Moodle#opentogoogle
  *
  https://github.com/moodle/moodle/blob/f49c53615410071d994f636ad687f1dc19b2ea32/lib/sessionlib.php#L209 -- skodak July 25, 2010 MDL-21249 improved php docs and adding direct access prevention in co…
  https://github.com/moodle/moodle/blob/master/lib/sessionlib.php#L257 : check_user_initialised() $CFG->opentogoogle -- 2012-05-06
  https://github.com/moodle/moodle/blob/master/lib/setuplib.php#L1330 : is_web_crawler() -- 2012-07-03
  http://xref.schoolsict.net/moodle/2.2/nav.html?lib/setuplib.php.html#is_web_crawler
  ini_set('user_agent', 'Googlebot/2.1 (+http://www.googlebot.com/bot.html)');
  ini_set('user_agent', 'Mozilla/5.0 (compatible; PHP-trackoer/0.1; Googlebot/2.1');
  */
  protected function _get_user_agent($spoof) {
    switch ($spoof) {
      case 'googlebot':
	    $ua = self::UA_GOOGLEBOT;
		break;
	  case 'like bot':
	    $ua = self::UA_LIKE_BOT;
	    break;
      case 'browser': # Fall-through.
      case TRUE:
        $ua = self::UA_BROWSER;
		break;
	  default:
        $ua = self::UA_DEFAULT;
        break;
    }
	return $ua;
  }

}