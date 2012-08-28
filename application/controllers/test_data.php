<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 28 August 2012 (10:05)
 * @filesource
 */


/**
 * Controller to output test/ offline data.
 */
class Test_data extends MY_Controller {

  public function rdf($file) {
    $path = dirname(__FILE__) .'/../assets/test_data/'. $file .'.xml';

    $xml = @file_get_contents($path);
    if (! $xml) {
      $this->_error("File not found, test_data/$file.xml", 404);
    }

    @header('X-content-type: application/rdf+xml');
    @header('Content-Type: text/xml; charset=utf-8');
    @header('Content-Disposition: inline; filename='. $file .'-rdf.xml');

    echo $xml;
  }
}

