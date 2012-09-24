<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 20 September 2012.
 * @filesource
 */
require_once APPPATH .'/third_party/php-markdown-extra-extended/markdown_extended.php';
require_once APPPATH .'/libraries/Layout.php';


/**
 * Extend the Layout library to parse views using php-markdown-extra-extended.
 *
 * @see MY_Controller::_load_layout method
 */
class Layout_Markdown extends Layout {

  protected $references;


  public function __construct($layout = "layout_main") {
    parent::__construct($layout);

    // Load markdown references from the pseudo-config view.
    $this->references = $this->obj->load->view('../config/markdown_references', NULL, true);
  }


  public function view($view, $data=null, $return=false) {
    $loadedData = array();
    $loadedData['_raw'] = $this->obj->load->view($view, $data, true);
    $loadedData['content_for_layout'] = MarkdownExtended($loadedData['_raw'] . $this->references);

    return $this->obj->load->view($this->layout, $loadedData, $return);

    /*if($return) {
      $output = $this->obj->load->view($this->layout, $loadedData, true);
      return $output;
    }
    else {
      $this->obj->load->view($this->layout, $loadedData, false);
    }*/
  }

}
