
<h2>OER license-tracker form <em>alpha</em></h2>


<form class="oer-form">

	<p><label for=url>Enter a source URL</label>
	<input id=url name=url type=url required placeholder="http://labspace.open.ac.uk/Learning_to_Learn_1.0" value="<?php echo isset($url) ? $url :'' ?>"
	/><input type=submit />

	<p id=eg><small>Examples of valid URLs
	<br />http://labspace.open.ac.uk/.. <br />http://openlearn.open.ac.uk/..
	 -- more work needed!</small>

	<hr />
	<p>Sample output

	<div id=cc-code><p>
	<?php echo isset($cc_code) ? $cc_code :'' ?>
	</div>


	<p><label for=out>Copy and paste the following snippet</label>
	<br /><textarea id=out readonly rows=10 cols=85
	><?php echo isset($cc_code_esc) ? $cc_code_esc :'' ?></textarea>
</form>

