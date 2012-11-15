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
require_once APPPATH .'/libraries/markdown_extended_ex.php';
require_once APPPATH .'/libraries/Layout.php';


/**
 * Extend the Layout library to parse views using php-markdown-extra-extended.
 *
 * @see MY_Controller::_load_layout method
 */
class Layout_Markdown extends Layout {

  protected $parser;


  public function __construct($layout = "layout_main") {
    parent::__construct($layout);

    $this->parser = new MarkdownExtraExtended_Ex_Parser();

    // Load markdown references from the pseudo-config view.
    $references = $this->parser->loadReferences();
  }


  public function view($view, $data=null, $return=false) {
    $loadedData = array();
    $loadedData['_raw'] = $this->obj->load->view($view, $data, true);
    $loadedData['content_for_layout']
          = $this->parser->transform($loadedData['_raw']);

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
