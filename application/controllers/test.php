<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Test and demonstration controller.
 */
class Test extends MY_Controller {

    public function __construct() {
      parent::__construct();

      header('Content-Type: text/html; charset=utf-8');
	  $this->load->helper('url');
	  $this->load->library('Creative_Commons');
    }


	public function b2s_learn($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'cc_code' => $this->cc->getCode(),
		);

		$this->layout->view('tests/test-b2s-learn', $view_data);
	}


	public function b2s_learn_section($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'cc_code' => $this->cc->getCode(2, 'http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&section=3',
				'Learning_to_Learn_1.0', 'Page: Learning to Learn - 2.3 Gathering Evidence—Your... - B2S on LabSpace'
			),
		);

		$this->layout->view('tests/test-b2s-learn-section', $view_data);
	}


	public function index() {
		redirect('test/b2s_learn');
	}
}

