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
 * @since		Version 1.0
 * @filesource
 */


/**
 * Library to generate Creative Commons License embed code snippets.
 * (Note, we could use the Creative Commons API - jurisdiction/locale support)
 * @link http://creativecommons.org/
 */
class Creative_Commons {

  const SOURCE_LEARN = 'http://labspace.open.ac.uk/course/view.php?id=7442';
  const SOURCE_ID = 'Learning_to_Learn_1.0';
  const AUTHOR_URL = 'http://labspace.open.ac.uk/b2s';

  protected $CI;

  public function __construct() {
    $this->CI =& get_instance();
  }


  /** Generate a HTML license-tracker snippet (embed code).
  */
  public function getCode($site_id=2, $source_url=self::SOURCE_LEARN, $source_identifier=self::SOURCE_ID, $title='Learning to Learn', $author='OpenLearn/Bridge to Success', $author_url=self::AUTHOR_URL, $cc_terms='by-nc-sa') {
    $p = parse_url($source_url);

    $view = array(
      'serv' => 'piwik',
	  'site_id' => $site_id,
	  'title'   => $title,
	  'source_url' => $source_url,
	  'source_host'=> $p['host'],
	  'source_identifier' => $source_identifier,
	  'source_path'=> ltrim($p['path'], '/') .'?'. $p['query'],
	  'author' => $author,
	  'author_url' => $author_url,
	  'cc_license' => NULL,
	  'cc_terms'=> $cc_terms,
	  'cc_ver' => '2.0',
	  'cc_jur' => 'uk',
	  'cc_loc' => 'en_GB',
	  'cc_siz' => '88x31', # Or, '80x15'
	  'with_tracker' => TRUE,
	  'explain_tracking_url' => '#!Explain..',
	);
	$view['cc_license'] = $view['cc_terms'] .'/'. $view['cc_ver'] .'/' .$view['cc_jur'];

	return $this->CI->load->view('cc_code/cc_code', $view, TRUE);
  }


  /** Escape the input embed code, for use in a [textarea].
  */
  public function escape($code) {
    return str_replace(array('<', "\n"), array('&lt;', ''), $code);
  }
}
