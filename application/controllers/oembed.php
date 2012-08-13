<?php
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 11 August 2012.
 * @license
 * @filesource
 */
ini_set('display_errors', 1);


class Oembed extends MY_Controller {

  public function index($url = NULL, $format = NULL, $license_url = NULL) {

    $url = $this->input->get('url');

    var_dump($url, $format);

    $this->load->oembed_provider('Openlearn');

    $re = $this->provider->getInternalRegex();

    if (! preg_match("@$re@", $url, $matches)) {
      $this->_error('Woops, bad URL, '.$url, 400);
    }

    $result = $this->provider->call($url, $matches);
    
  }

/*}


// Commandline usage
//   php index.php oerform/cli --format=html --license=cc:by-nc-sa/2.0/uk[/88x31] http://labspace.open.ac.uk/...

class _Oerform extends MY_Controller {
*/
  public function cli($url = NULL, $format = NULL, $license_url = NULL) {

    var_dump($url, $format);
  
  } 
}

