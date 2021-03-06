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
	* Testing no-Javascript web-beacons.
	* @author NDF, 29 August 2012.
	*/
	public function noscript($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$this->load->tracker('Google', NULL);
		$this->load->tracker('Piwik', NULL);
		$source_url = 'http://labspace.open.ac.uk/Learning_to_Learn_1.0#!REF';
		$p = parse_url($source_url);

		$view_data = array(
			'_OLD_ga_beacon_url' => $this->ga->getBeaconUrl(NULL, NULL, NULL, $source_url, 'Learning_to_Learn_1.0/ No-script test'),
			'ga_beacon_url' => $this->ga->getBeaconUrl(NULL, $p['host'], $p['path'].'#!REF', 'Learning_to_Learn_1.0/ No-script test'),
		);
		$this->layout->view('tests/test-noscript-b2s-learn-1', $view_data);
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
		$google_ac = $this->config->item('google_analytics_capret_id');

		$jquery_version = $this->input->get_default('jquery', TRACK_JQUERY_DEFAULT_VERSION);
		if (preg_match('/d(rupal)?6?/i', $jquery_version)) {
			$jquery_version = TRACK_JQUERY_DRUPAL_VERSION;
		}
		//$this->view_data += array(
		$view_data = array(
			'page_title' => 'CaPRéT test/demonstration',
			'jquery_js_url' => "//ajax.googleapis.com/ajax/libs/jquery/$jquery_version/jquery.min.js",
			'capret_js_url' => base_url() .'capret/js/',
			'public_js_url' => base_url() .'public/js/',
			'build_js_url' => base_url() .'capret/build/',
			##$capret_js_url = 'http://capret.mitoeit.org/js/';
			'data_piwik_url' => 'http://track.olnet.org/piwik'==$piwik_url ? '': "data-piwik-url='$piwik_url'",
			'piwik_idsite' => $piwik_idsite,
			'ga_ac' => $google_ac,
			'debug' => $this->_is_debug(NULL, TRUE),
			//'debug' => (bool) $this->input->get('debug'),
		);

		if ('course-view' != $page) {
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

