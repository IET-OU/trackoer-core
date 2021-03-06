<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 16 August 2012.
 * @license
 * @link		https://github.com/IET-OU/trackoer-core
 * @link		http://developers.google.com/analytics/resources/articles/gaTrackingTroubleshooting#gifParameters
 * @link		http://snipplr.com/view/37647
 * @since		Version 1.0
 * @filesource
 */


/**
 * Google Analytics tracker
 * A wrapper around GA Javascript, with Track OER extensions.
 */
class Google_Tracker extends Base_Tracker {

  protected $with_campaign = TRUE;

  public function __construct() {
    parent::__construct();
	$this->CI->load->helper('url');

  }

  public function withCampaign($flag) {
    $old = $this->with_campaign;
    $this->with_campaign = $flag;
	return $old;
  }
  
  public function isValid($account) {
    return preg_match('/'. $this->getRegex() .'/', $account);
  }

  public function getRegex() {
    return '^UA-\d{4,10}-\d{1,2}$';
  }


  public function getDefaultId() {
    return $this->CI->config->item('google_analytics_default_id');
  }


  public function getSiteId($url, $subject = NULL) {
    return NULL;
  }

  /**
  * Append campaign tracking parameters to a URL.
  *
  * GA: http://creativecommons.org/licenses/by/3.0/deed.en_GB?utm_source=labspace.open.ac.uk!Learning_to_Learn_1.0&utm_medium=zip!cc-img&utm_term=learning&utm_campaign=oer1
  * (Piwik: http://creativecommons.org/licenses/by/3.0/deed.en_GB?pk_campaign=oer1,zip!cc-img,labspace.open.ac.uk!Learning_to_Learn_1.0&pk_kwd=learning)
  *
  * @link http://support.google.com/analytics/bin/answer.py?hl=en&answer=1033867 URL Builder
  * @link http://piwik.org/docs/tracking-campaigns/url-builder/
  * @link http://piwik.org/faq/general/#faq_119 "Yes, Piwik detects URLs tagged with Google Analytics campaign parameters."
  *
  * @param string $url   The input URL.
  * @param string $mode  The delivery mode, that is, one of 'zip', scorm, ims, rss, atom, pdf..
  * @param string $which Which link in a (Creative Commons License) RDFa snippet? That is, one of 'lic-icon', lic-link, attr-link, src-link..
  * @return string URL with appended parameters.
  */
  public function campaignUrl($url, $mode = TRACKER_MODE_ZIP, $which = TRACKER_RDF_LIC_ICON, $source_host='labspace.open.ac.uk', $source_id='Learning_to_Learn_1.0', $campaign='toer1', $term=NULL, $separator = '&amp;') {
    $campaign_url = '&amp;'==$separator ? htmlentities($url) : $url;
    if (! $this->with_campaign) {
      return $campaign_url;
    }

    // Todo: URLs containing '#fragments' will be messed up.
    $campaign_url .= FALSE===strpos($url, '?') ? '?' : $separator;

    $params = array(
      'utm_source' => $source_host .TRACKER_PAGE_URL_SEP. $source_id,
      'utm_medium' => $mode .TRACKER_PAGE_URL_SEP. $which,
      'utm_campaign' => $campaign,
      'utm_term' => $term,
    );
    // Decode our reserved delimiter '!'
    return $campaign_url . str_replace('%21', '!', http_build_query($params, NULL, $separator));
  }

  /**
  * Get a HTML snippet containing one or more <script>
  * @return string HTML
  */
  public function getScript($account = NULL, $with_trackoer = FALSE, $custom_hash = NULL, $is_async = TRUE, $property = '_trackoer_content') {
    return $this->getCode($account, $with_trackoer, $custom_hash, $is_async, $property);
  }


  /**
  * Get the URL with tracking parameters for the web-beacon/web bug.
  * @return string URL
  */
  public function getBeaconUrl($account = NULL, $domain = NULL, $url = NULL, $referer = NULL, $title = NULL) {

    #$referer = $referer ? $referer : self::NO_REFERER_URL; #'http://noreferer.example.org/';
	$account = $account ? $account : $this->getDefaultId();
    $title = $title ? $title : '-';

    $dest_host = $domain ? $domain : self::REUSER_HOST;
    $dest_path = $url ? $url : '/noscript';

    $i = 1000000000;
    $cookie = rand(10000000, 99999999); //random cookie number
    $random = rand($i, 2147483647); //number under 2147483647
    $today = time() * 1000; //(new Date()).getTime(), Milliseconds.

    // https://developers.google.com/analytics/resources/articles/gaTrackingTroubleshooting#gifParameters
	// http://remysharp.com/2009/10/15/the-missing-stat-noscript/
    $params = array(
      'utmwv' => '3.5.3', #'1.3', // Tracking code version.
      'utmn'  => rand($i, 9999999999), // Random request number
      'utmsr' => '-', // Screen resolution.
      'utmsc' => '-', // Screen colour depth.
      'utmul' => '-', // Browser language.
      'utmje' => 0,   // Java-enabled?
      'utmfl' => '-', // Flash.
      //'utmt' => 'event', // Type of request, default 'page'.
      //'utmdt' => '-',
      'utmdt' => $title, // Page title.
      'utmhn' => $domain, // Hostname.
      'utmr' => $referer,
      'utmp'  => $url, // Path.
      'utmac' => $account, //UA-1234..
      'utme'  => '-', // Extensible: events/ custom variables.

      // Cookie
      'utmcc' => '__utma='. $cookie .'.'. $random .'.'. $today .'.'. $today .'.'. $today
          . '.2;+__utmb='
          . $cookie .';+__utmc='. $cookie .';+__utmz='. $cookie
          . '.'. $today .'.2.2.utmccn=(referral)|utmcsr='
          . $dest_host .'|utmcct='. $dest_path .'|utmcmd=referral;+__utmv='
          . $cookie .'.-;',
    );
    $url = 'http://www.google-analytics.com/__utm.gif?'. http_build_query($params);

    return $url;
  }


  /**
  * Get asynchrous GA HTML snippet (containing <script>).
  * Note, this should appear after the Creative Commons license code.
  *
  * @param string $custom_hash  Hash fragment, example "!labspace.open.ac.uk!Learning_to_Learn_1.0!mod/oucontent/view.php?id=1422&section=3!plain-zip!Debug!12"
  * @param string $property  GA 'property' identifier. We assume there will be at least 2 Google Analytics accounts on a page - prevent conflicts.
  * @link http://stackoverflow.com/questions/2651834/google-analytics-async-tracking-with-two-accounts
  * @return string
  */
  public function getCode($account = NULL, $with_trackoer = FALSE, $custom_hash = NULL, $is_async = TRUE, $property = '_trackoer_content') {

    $view_data = array(
      'account'  => $account ? $account : $this->getDefaultId(),
	  'property' => $property,
	  'with_trackoer' => $with_trackoer,
	  'custom_hash' => $custom_hash,
    );
    return $this->CI->load->view('cc_code/google_analytics_code_async', $view_data, TRUE);
  }

  /**
  * Implementation of track() - used by Track controller.
  * @return void
  */
  public function track($service, $site_id, $image, $source_host, $source_identifier=NULL, $source_path=NULL, $title=NULL, $referer=NULL, $record = 1) {
    return NULL;
  }
  
}
