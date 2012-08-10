
<h2>OpenLearn OER form-tool</h2>


<form class="oer-form">

	<p><label for=url>Enter a source URL</label>
	<input id=url name=url type=url placeholder="http://labspace.open.ac.uk/Learning_to_Learn_1.0" value="<?php echo $source_url ?>" />
	<input type=submit />


	<hr />
	<p>Sample output

	<div id=cc-code><p>
	<?php echo $cc_code ?>
	</div>


	<p><label for=out>Copy and paste the following</label>
	<br /><textarea id=out readonly rows=10 cols=85
	><?php echo $cc_code_esc ?></textarea>
</form>

