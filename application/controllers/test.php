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

		$this->load->tracker('Piwik', NULL);
		$piwik_id = $this->piwik->getDefaultId();

		$view_data = array(
			'cc_code' => $this->cc->getCode($piwik_id, 'http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&section=3',
				'Learning_to_Learn_1.0', 'Page: Learning to Learn - 2.3 Gathering Evidence—Your... - B2S on LabSpace'
			),
		);

		$this->layout->view('tests/test-b2s-learn-section', $view_data);
	}


	/**
	* Test page(s) for Google Analytics custom Javascript.
	* Note, originally this used Javascript to parse the License RDFa. We've now simplified it.
	*/
	public function b2s_learn_gajs($with_unit_tests = FALSE, $layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$this->load->tracker('Google', NULL);
		$this->load->tracker('Piwik', NULL);
		$piwik_id = $this->piwik->getDefaultId();

		$custom_arg = NULL;
		if (! $this->input->get('parsedfa')) {
			define('SP', TRACKER_PAGE_URL_SEP);
			$custom_arg = SP. 'labspace.open.ac.uk' .SP. 'Learning_to_Learn_1.0' .SP. 'mod/oucontent/view.php?id=471422&section=3' .SP. 'zip';
		}
		$view_data = array(
			'with_unit_tests' => $with_unit_tests,
			'cc_code' => $this->cc->getCode($piwik_id, 'http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&section=3',
				'Learning_to_Learn_1.0', 'Page: Learning to Learn - 2.3 Gathering Evidence—Your... - B2S on LabSpace'
			)
			.
			$this->ga->getCode(NULL, $with_trackoer = TRUE, $custom_arg),
		);
		$this->layout->view('tests/test-ga-js-learning1', $view_data);
	}


	/**
	* Test page(s) for CaPReT, mocked up from OpenLearn-LabSpace - acceptance test server.
	* @author NDF, 21 August 2012.
	* @link http://labspaceacct.open.ac.uk/course/view.php?id=7654
	*/
	public function capret($course = 'math', $page = 'course-view') {

		$piwik_url = $this->config->item('piwik_url');
		$piwik_idsite = $this->config->item('piwik_capret_id');
		if (! $piwik_idsite) {
			$piwik_idsite = 2;
		}

		$view_data = array(
			'jquery_js_url' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js',
			'capret_js_url' => base_url() .'capret/js/',
			##$capret_js_url = 'http://capret.mitoeit.org/js/';
			'data_piwik_url' => 'http://track.olnet.org/piwik'==$piwik_url ? '': "data-piwik-url='$piwik_url'",
			'piwik_idsite' => $piwik_idsite,
			'debug' => (bool) $this->input->get('debug'),
		);
	
		if ('course-piwik' == $page) {
			$this->_load_layout(self::LAYOUT);
			
			$this->layout->view("capret_test/labspace-acct-b2s-$course-$page-1", $view_data);
		} else {
			$this->load->view("capret_test/labspace-acct-b2s-$course-$page-1", $view_data);
		}
	}


	/**
	* Embedding Piwik widgets
	* @link http://piwik.org/docs/embed-piwik-report
	*/
	public function piwik_widget($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'piwik_url' => $this->config->item('piwik_url'),
			'idsite' => $this->config->item('piwik_default_id'),
		);
		$this->layout->view('tests/piwik-widget-1', $view_data);
	}


	public function index() {
		redirect('test/b2s_learn');
	}
}

