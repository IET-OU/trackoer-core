<?php
	$piwik_url = $this->config->item('piwik_url')
?>

<?php if ($this->input->get('edge')): ?>
<fieldset id=edge><legend>Experimental+</legend>
	<input name=edge value=1 type=hidden />

	<p><input id=sv-pi name=sv type=radio value=piwik checked /> <label for=sv-pi title="Piwik for Track OER">Piwik <a href="<?php echo $piwik_url ?>">(Piwik)</a></label>
	<span class=sp></span>
	<input id=sv-ga name=sv type=radio value=ga /> <label for=sv-ga>Google Analytics <a href="https://google.com/analytics">(GA)</a></label>

	<p id=ga-ac class=hide><label for=ac>Google Analytics account</label>
	<input id=ac name=ac placeholder=UA-12345678-9 pattern="UA-\d{4,10}-\d{1,2}" value="<?php echo isset($ga_account) ? $ga_account :'' ?>" maxlength=15 />

	<p><label for=file>Offline filename</label>
	<input id=file name=file placeholder="x_learning_to_learn_0_1.html" size=30 value="<?php echo isset($file) ? $file :'' ?>" maxlength=40 />

<script>
$('input[name=sv]').change(function(){
	console.log('#sv-ga change..');
	$('#ga-ac').attr('class', $('input[name=sv]:checked').val() == 'ga' ? 'show' : 'hide');
});
</script>
</fieldset>
<?php endif; ?>
