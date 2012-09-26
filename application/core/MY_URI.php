<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @filesource
 */


/**
* @author N.D.Freear, 18 August 2012.
*/
class MY_URI extends CI_URI {

	public function __construct() {
		parent::__construct();
		log_message('debug', __CLASS__." Class Initialized");
    }

    /**
	 * Parse cli arguments
	 *
	 * Take each command line argument and assume it is a URI segment.
	 *
	 * @access	private
	 * @return	string
	 */
    //NDF: Note 'protected' - requires a mod. in CI_URI :(.
	protected function _parse_cli_args()
	{
		$args = array_slice($_SERVER['argv'], 1);

		foreach ($args as $key => $arg) {
		  if (0==$key) continue;

		  //NDF: allow *nix/Window file-paths in arguments in command-line/CLI mode.
		  $args[$key] = str_replace(array('/', '\\'), '%2F', $arg);
		}

		return $args ? '/' . implode('/', $args) : '';
	}

}
