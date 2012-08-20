<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 20 August 2012.
 * @filesource
 */


/**
 * Input Class - extended.
 *
 * Pre-processes global input data for security
 */
class MY_Input extends CI_Input {

	/**
	* Fetch an item from the GET array, optional with a default.
	*
	* @access	public
	* @param	string
	* @param	bool
	* @return	string
	*/
    function get_default($index = NULL, $default, $xss_clean = FALSE) {
        $get = $this->get($index, $xss_clean);
        return $get ? $get : $default;
    }

}
