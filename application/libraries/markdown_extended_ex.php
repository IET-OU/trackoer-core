<?php
/**
 * Extending php-markdown-extra-extended, with interwiki links, support for references config..
 *
 * @link https://github.com/egil/php-markdown-extra-extended
 * @link http://michelf.ca/projects/php-markdown/extra/
 *
 * @author N.D.Freear, 26 September 2012.
 */
require_once APPPATH .'/third_party/php-markdown-extra-extended/markdown_extended.php';


function MarkdownExtended_Ex($text, $default_classes = array()){
  $parser = new MarkdownExtraExtended_Ex_Parser($default_classes);
  return $parser->transform($text);
}


class MarkdownExtraExtended_Ex_Parser extends MarkdownExtraExtended_Parser {

	protected $interwikis = array();
	protected $references = NULL;

	function __construct() {
	#
	# Constructor function. Initialize the parser object.
	#
		# Insert extra document, block, and span transformations. 
		# Parent constructor will do the sorting.
		$this->document_gamut += array(
			'stripInterwikis' => 17, #25
			);
		//$this->block_gamut += array(
		//	);
		$this->span_gamut += array(
			'doInterwikis'    => 6, #70, 60
			'processDash'     => 5,
			);

		parent::__construct();

		@header('X-Markdown-extra-extended-version: '. implode('/', $this->getVersions()));
	}


	public function getVersions() {
		return array(
			'MARKDOWN_VERSION' => MARKDOWN_VERSION,
			'MARKDOWNEXTRA_VERSION' => MARKDOWNEXTRA_VERSION,
			'MARKDOWNEXTRAEXTENDED_VERSION' => MARKDOWNEXTRAEXTENDED_VERSION,
		);
	}


	public function getHtmlHead($url = NULL, $base_url = TRACKOER_LIVE_URL, $theme = 'bw') {
		if ($url) {
			@header('Content-Disposition: inline; filename='. basename($url) .'.html');
		}
		$theme = htmlentities($theme);
		return <<<EOF
<!doctype html><html class="md-out $theme"><meta charset=utf-8 />
<link rel=stylesheet href="$base_url/assets/site/css/md.css" />
<link rel=glossary type=text/markdown href="$base_url/api/markdown/references" />
<link rel=alternate type=text/markdown href="$url" />


EOF;
	}


	/** Load an extended Markdown reference config-view (requires CodeIgniter).
	*/
	public function loadReferences($file = '../config/markdown_references') {
		@header('Content-Disposition: inline; filename='. basename($file) .'.md');
		$CI =& get_instance();
		$this->references = $CI->load->view($file, NULL, TRUE);
		return $this->references;
	}


	public function transform($text) {
		return parent::transform($text . $this->references);
	}


	function processDash($text) {
		$text = preg_replace('/ -- /', ' &ndash; ', $text);
		$text = preg_replace('/\.\.\./', '…', $text);
		return $text;
	}

	### Interwiki links ###

	function stripInterwikis($text) {
	#
	# Strips interwikis from text, stores URL prefixes in hash references.
	#
		$less_than_tab = $this->tab_width - 1;

		# Link defs are in the form: [id:*]: url_prefix "optional title"
		$text = preg_replace_callback('{
			^[ ]{0,'.$less_than_tab.'}\[(.+?):\*\][ ]?:	# inter_id = $1
			(.*)					# inter_url = $2 (no blank lines allowed)	
			}xm',
			array(&$this, '_stripInterwikis_callback'),
			$text);
		return $text;
	}
	function _stripInterwikis_callback($matches) {
		$inter_id = $matches[1];
		$inter_url = $matches[2];

		$this->interwikis[$inter_id] = trim($inter_url);

		return ''; # String that will replace the block
	}

	function doInterwikis($text) {

		if (! $this->interwikis) {
			return $text;
		}

		#
		# Turn Markdown interwiki link into XHTML <a> tags.
		#
		if ($this->in_anchor) return $text;
		$this->in_anchor = true;

		#
		# First, handle reference-style links: [link text] [id:term]
		#
		$text = preg_replace_callback('{
			(					# wrap whole match in $1
			  \[
				('.$this->nested_brackets_re.')	# link text = $2
			  \]

			  [ ]?				# one optional space
			  (?:\n[ ]*)?		# one optional newline followed by spaces

			  \[
				([^:]+?)\:(\w.*?)		# id = $3, term = $4
			  \]
			)
			}xs',
			array(&$this, '_doInterwikis_callback'), $text);

		#
		# Next, inline-style links: [link text](url "optional title")
		#...

		$this->in_anchor = false;
		return $text;
	}
	function _doInterwikis_callback($matches) {
		$link_text = $matches[2];
		$link_id = $matches[3];
		$link_term = $matches[4];

		if (isset($this->interwikis[$link_id])) {
			$link_url = $this->interwikis[$link_id];
			if (empty($link_url)) {
			//ERROR?
				return $this->hashPart("<abbr>$abbr</abbr>");
			} else {
				$link_term = $this->encodeAttribute($link_term);
				return $this->hashPart("<a href=\"$link_url$link_term\" rel=\"interwiki\" class=\"$link_id\">$link_text</a>");
			}
		} else {
			return $matches[0];
		}
	}

}
