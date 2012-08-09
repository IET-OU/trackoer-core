<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct() {
      parent::__construct();

      header('Content-Type: text/html; charset=utf-8');
	  $this->load->helper('url');
    }

	public function b2s_learn($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'cc_code' => $this->_get_cc_code(),
		);

		$this->layout->view('tests/test-b2s-learn', $view_data);
	}
	
	public function index() {
		redirect('test/b2s_learn');
	}
}

