<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Was: Welcome
 */
class About extends MY_Controller {

    public function __construct() {
      parent::__construct();

      header('Content-Type: text/html; charset=utf-8');
      @header('Last-Modified: '. date('r', $this->request('revision')->timestamp));
    }

	/**
	 * Was: index
	 *
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function welcome($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'rev' => $this->request('revision'),
		);
		$this->layout->view('welcome_message', $view_data);
	}

	/**
	* Was: about
	*/
	public function index($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'rev' => $this->request('revision'),
			'page_title'  => t('About'),
			'about_links' => $this->config->item('about_links'),
		);

		$this->layout->view('about/about', $view_data);
	}


	/** CaPReT: explain the different variants.
	*/
	public function capret($layout = self::LAYOUT) {
		$this->_load_layout($layout);
		$this->load->file(APPPATH . 'controllers/help.php');

		$view_data = array(
			'rev' => $this->request('revision'),
			'page_title'  => t('CaPRéT: Cut and Paste Reuse Tracking'),
			#'capret_help_url' => Help::HELP_URL,
		);

		$this->layout->view('about/capret', $view_data);
	}

	/** Google custom search for OERRI.
	*/
	public function search($layout = self::LAYOUT) {
		$this->_load_layout($layout);

		$view_data = array(
			'page_title'  => t('Search OERRI'),
		);

		$this->layout->view('about/search', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */