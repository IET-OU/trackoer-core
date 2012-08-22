<?php
	$piwik_url = $this->config->item('piwik_url');

	$radio_piwik = 'checked';
	$radio_ga = '';
	if (isset($sv) && 'ga' == $sv) {
		$radio_piwik = '';
		$radio_ga = 'checked';
	}
?>

<?php if ($this->input->get('edge')): ?>
<fieldset id=edge><legend>Experimental+</legend>

<?php if (isset($ac)): ?>
<script>
window['ga-disable-<?php echo $ac ?>'] = true;
$.log('Google Analytics disabled on \'oerform\', <?php echo $ac ?>');
</script>
<?php endif; ?>

	<input name=edge value=1 type=hidden />

	<p><input id=sv-pi name=sv type=radio value=piwik <?php echo $radio_piwik ?> /> <label for=sv-pi title="Piwik for Track OER">Piwik <a href="<?php echo $piwik_url ?>">(Piwik)</a></label>
	<span class=sp></span>
	<input id=sv-ga name=sv type=radio value=ga <?php echo $radio_ga ?> /> <label for=sv-ga>Google Analytics <a href="https://google.com/analytics">(GA)</a></label>

	<p id=ga-ac class=hide><label for=ac>Google Analytics account</label>
	<input id=ac name=ac placeholder=UA-12345678-9 title="UA-[numbers]-[numbers]" pattern="UA-\d{4,10}-\d{1,2}" value="<?php echo isset($ac) ? $ac :'' ?>" maxlength=15 />

	<p><label for=file>Offline filename</label>
	<input id=file name=file placeholder="x_learning_to_learn_0_1.html" size=30 value="<?php echo isset($file) ? $file :'' ?>" maxlength=40 />
</fieldset>
<?php endif; ?>
