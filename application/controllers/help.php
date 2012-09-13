<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 13 September 2012
 * @filesource
 */


/**
 * Help and support controller.
 */
class Help extends MY_Controller {

	const HELP_URL = 'https://docs.google.com/document/d/1687Lejn4z10sbQtLk-e7xasA8WFw6KDIybeBX8OjxUk/edit#heading=h.3ain78xagbs6';

    public function __construct() {
		parent::__construct();

		$this->load->helper('url');
		header('Content-Type: text/html; charset=utf-8');
    }


	public function capret($heading = 'ie') {
		// For the moment redirect to our draft Google Doc.
		redirect(self::HELP_URL);
	}
}
	