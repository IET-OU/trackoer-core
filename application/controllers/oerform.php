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
require_once APPPATH .'/controllers/oembed.php';


/**
 * The OER Form controller, based on oEmbed.
 */
class Oerform extends Oembed {

	public function __construct() {
      parent::__construct();

      $this->load->helper('url');
	  $this->load->library('Creative_Commons');
    }


	public function index($layout = self::LAYOUT) {
		$this->_load_layout($layout);
        $view_data = array('status'=>array());

        if ($this->input->get('url')) {

          $result = parent::index();

          $view_data = array(
            'url' => $result->original_url,
            'oembed_url' => $this->oembedUrl($result->original_url),
            'cc_code' => $result->html,
            'status'  => $this->_getStatus(),
          );
          $view_data['cc_code_esc'] = $this->cc->escape($result->html);
          #$view_data['oembed'] = (array) $result;

        } else {
          $this->load->oembed_provider('Openlearn_track');
        }
        $view_data['examples'] = $this->provider->getExampleLinks();

        $this->layout->view('oer_form/oer_form', $view_data);
	}

}
