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
#error_reporting(E_ALL);


class Oembed extends MY_Controller {

  public function index($url = NULL, $format = NULL, $license_url = NULL) {

    $url = $this->input->get('url');

    $this->load->oembed_provider('Openlearn_track');

    $re = $this->provider->getInternalRegex();

    if (! preg_match("@$re@", $url, $matches)) {
      $this->_error('Woops, bad URL, '.$url, 400);
    }


    $result = $this->provider->call($url, $matches);


    if ('Oembed' == get_class($this)) {
      // Needs more work - security etc.!
      $view_data = array(
        'url' => $url,
        'format' => 'json', #$this->input->get('format'),
        'callback' => $this->input->get('callback'),
        'oembed' => (array) $result,
      );
      $this->load->view('api/oembed_render', $view_data);
    }

    // Else, hand back to the 'Oerform' controller..
    return $result;
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

