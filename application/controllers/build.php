<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 17 April-20 September 2012.
 * @license
 * @filesource
 */


/**
* Track OER Javascript builder.
*
* (Based on: OU player Javascript/ CSS builder.)
*
* In Web mode creates a Closure Compiler build script.
* (In cli mode builds using YUI Compressor.)
*
*     Usage: $ \xampp\php\php index.php build/revision
*
* @link http://github.com/IET-OU/ouplayer/blob/master/application/controllers/bui..
* @link http://closure-compiler.appspot.com/home
* (http://www.minifyjs.com/javascript-compressor/)
* (http://www.lotterypost.com/css-compress.aspx)
*
* @copyright 2012 The Open University.
* @author N.D.Freear, 17 April 2012, -04-25.
*/

class Build extends MY_Controller {

  protected $_closure_template = <<<EOF
<h2><a href="/__OUTPUT__">__OUTPUT__</a></h2>
<pre>
// ==ClosureCompiler==
// @output_file_name __OUTPUT__
// @compilation_level __LEVEL__
//__URLS__// ==/ClosureCompiler==

</pre>

EOF;


  /** Build a 'revision' file (CLI).
  */
  public function revision() {
    if ($this->input->is_cli_request()) {
      $this->load->library('Gitlib', null, 'git');

      $result = $this->git->put_revision();

	} else {
	  $this->_error('The page you requested was not found.', 404);
	}
  }


  /** Build a theme (Web/CLI).
  */
  public function capret($optimizations = 'whitespace', $jquery_version = NULL, $capret_mode = NULL, $output = '') {	
    #$optimizations = strtoupper($optimizations);

    #$this->load->theme($theme_name);
    $this->load->tracker('Capret');

    if ($this->input->is_cli_request()) {
      $this->load->library('Gitlib', null, 'git');
      $result = $this->git->put_revision();

      $this->_cli_builder();
    } else {
      $this->_web_closure($optimizations, $jquery_version);
    }
  }


  /** Print all theme Closure scripts in a Web page.
  */
  protected function _web_closure($optimizations, $jquery_version = NULL) {

    $capret_modes = array('classic', 'piwik', 'ga');
?>
<!doctype html><title>*Closure compiler script | Track OER</title>
<a href="http://closure-compiler.appspot.com/home">closure-compiler.appspot.com/home</a>

<?php foreach ($capret_modes as $mode): ?>
<p id=<?php echo $mode ?> >CaPReT mode: <?php echo $mode ?>

<?php
    $scripts = $this->tracker->getJavascripts($mode, $jquery_version);
    $js_min = str_replace('-classic', '', 'capret-'. $mode) .'.min.js';

    // Build script for minified Javascripts.
    echo $this->_closure($scripts, $js_min, $optimizations);
?>
<?php endforeach;
  }


  /** Return a Closure build script for a given file array.
  */
  protected function _closure($file_array, $output, $comp_level = 'simple') {

    $base_url = base_url(); //.'application/';
    $rand = rand(0, 100);

    $levels = array(
      0 => 'WHITESPACE_ONLY',
      'whitespace' => 'WHITESPACE_ONLY',
      'simple' => 'SIMPLE_OPTIMIZATIONS',
      'advanced' => 'ADVANCED_OPTIMIZATIONS',
    );
    $comp_level = $levels[$comp_level];
    $output = basename($output);

    $url_list = '';
    foreach ($file_array as $script) {
      $asset_url = FALSE===strpos($script, 'http') ? $base_url : '';
	  $url_list .= "// @code_url $asset_url$script?r=$rand".PHP_EOL;
    }

    $closure = str_replace(
      array('//__URLS__', '__OUTPUT__', '__LEVEL__', 'href="/'),
      array($url_list, $output, $comp_level, 'href="'. $base_url .'capret/build/'),
      $this->_closure_template);

    return $closure;
  }

  /** Build the theme CSS & Javascript at the commandline.
  */
  protected function _cli_builder() {

    $this->_build($this->theme->styles, $this->theme->css_min);

  }

  /** Build (join) and minify a given array of files.
  */
  protected function _build($file_array, $output) {
    echo "Building... $output".PHP_EOL;
  
    $app_path = dirname(__DIR__) .'/';
    $temp_file = $app_path. str_replace('.min', '', $output);

    $buffer = '';
    foreach ($file_array as $script) {
      $buffer .= file_get_contents($app_path. $script);
    }
    $res = file_put_contents($temp_file, $buffer);

    return $this->_yui_compress($temp_file, $app_path. $output);
  }

  /** Run YUI Compressor on a CSS or Javascript file. 
  */
  protected function _yui_compress($input, $output) {
    define('YUI_COMPRESSOR', APPPATH .'libraries/yuicompressor/yuicompressor-2.4.6.jar');

    $cmd = "java -jar ".YUI_COMPRESSOR." $input -o $output -v --charset utf-8 ";
    $result = system($cmd);
    return $result;
  } 
}
