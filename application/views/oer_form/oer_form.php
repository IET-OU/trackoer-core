

<h2>OER license-tracker form <em>alpha</em></h2>


<form class="oer-form">

	<p><label for=url>Enter the source URL for an OER</label>
	<input id=url name=url type=url required placeholder="http://labspace.open.ac.uk/Learning_to_Learn_1.0" value="<?php echo isset($url) ? $url :'' ?>"
	/><input type=submit />

<?php if (isset($oembed_url)): ?>
	<p id=alt>Alternatives:
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
	<p>Sample output

	<div id=cc-code><p>
	<?php echo $cc_code ?>
	</div>
<?php endif; ?>


<?php if (isset($cc_code_esc)): ?>
	<p><label for=copy-me>Copy and paste the following snippet</label>
	<textarea id=copy-me readonly rows=10 cols=85
	><?php echo $cc_code_esc ?></textarea>
<?php endif; ?>

</form>

