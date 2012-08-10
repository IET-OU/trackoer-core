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
 * @since		Version 1.0
 * @filesource
 */


class Oerform extends MY_Controller {

	public function __construct() {
      parent::__construct();

      header('Content-Type: text/html; charset=utf-8');
	  $this->load->helper('url');
	  $this->load->library('Creative_Commons');
    }


	public function index($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$source_url = $this->input->get('url');
		#$p = parse_url($url);
		if ($source_url && ! preg_match('@\/(labspace.open.ac.uk|openlearn.open.ac.uk)\/@', $source_url)) {

			$this->_error('Unexpected value for {url} parameter.', 400);
		}

		
		$view_data = array(
			'url' => $source_url,
			'cc_code' => $this->cc->getCode(),
		);
		$view_data['cc_code_esc'] = str_replace(array('<', "\n"), array('&lt;', ''), $view_data['cc_code']);


		$this->layout->view('oer_form/oer_form', $view_data);
	}

}
