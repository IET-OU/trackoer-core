<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 04 September 2012.
 * @license
 * @link		https://github.com/IET-OU/trackoer-core
 * @since		Version 1.0
 * @filesource
 */


/**
 * CaPReT tracker
 * A wrapper around CaPReT, with Track OER extensions.
 */
class Capret_Tracker extends Base_Tracker {


  public function getJavascripts($clipboard_2 = TRUE, $with_piwik = TRUE, $debug = FALSE) {
    $scripts = array();

    if ($debug) {
      $scripts['[if IE]'] = 'http://getfirebug.com/releases/lite/1.2/firebug-lite-compressed.js';
    }
    if ($clipboard_2) {
      $scripts['[if IE]'] = 'ierange.js';
    }
    $scripts['jquery'] = 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js';

    if ($clipboard_2) {
      $scripts[] = 'jquery.clipboard2.js';
    } else {
      // Original.
      $scripts[] = 'jquery.plugin.clipboard.js';
    }

    $scripts[] = 'oer_license_parser.js';

    if ($with_piwik) {
      $scripts['[if lt IE 8]'] = 'https://cdnjs.cloudflare.com/ajax/libs/json2/20110223/json2.js';
      $scripts['@data'] = 'capret-piwik.js';
    } else {
      // Original.
      $scripts[] = 'capret.js';
    }

    return $scripts;
  }


  public function renderScripts($scripts, $data_attr = array()) {

    $view_data = array(
      'script_url' => base_url() .'/assets/capret/js/',
      'scripts' => $scripts,
      'data_attr' => $data_attr,  
    );

    //return $this->CI->load->view('cc_code/javascripts', $view_data, $return=TRUE);
  }


  public function track($service, $site_id, $image, $source_host, $source_identifier=NULL, $source_path=NULL, $title=NULL, $referer=NULL, $record = 1) {
    return NULL;
  }
}
