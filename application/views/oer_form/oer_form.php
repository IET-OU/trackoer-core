

<h2>OER license-tracker form <em>alpha</em></h2>


<form class="oer-form">


<?php
	$this->load->view('oer_form/oer_form_extension')
?>


	<p class=req title="Required"><label for=url class=blk>Enter the source URL for an OER</label>
	<input id=url name=url type=url required placeholder="http://labspace.open.ac.uk/Learning_to_Learn_1.0" value="<?php echo isset($url) ? $url :'' ?>" maxlength=100
	/><input type=submit />


<?php if (isset($oembed_url)): ?>
	<p id=alt>Alternatives formats:
	<a rel=alternate class=json	href="<?php echo $oembed_url ?>&amp;format=json" title="Javascript Object Notation">JSON-oembed</a>
	| <a rel=alternate class=xml href="<?php echo $oembed_url ?>&amp;format=xml" title="Extensible Markup Language">XML-oembed</a>
	| <a rel=external class=spec href="http://oembed.com/" title="oEmbed Specification">What is oEmbed?</a>
<?php endif; ?>


<?php if (isset($examples)): ?>
	<p id=ex>Examples of valid source URLs
	<small><?php echo $examples ?></small>
<?php endif; ?>


<?php if (isset($cc_code)): ?>
	<hr />
	<h3>Sample output</h3>

	<div id=cc-code><p>
	<?php echo $cc_code ?>
	</div>
<?php endif; ?>


<?php if (isset($cc_code_esc)): ?>
	<p><label for=copy-me class=blk>Copy and paste the following snippet</label>
	<textarea id=copy-me readonly rows=10 cols=85
	><?php echo $cc_code_esc ?></textarea>
<?php endif; ?>


<?php if (isset($status)): ?>
	<div id=log><h3>Status log</h3> <p>
	<?php foreach ($status as $stat): ?>
	<?php echo $stat ?><br>
	<?php endforeach; ?>
	</p></div>
<?php endif; ?>


</form>

