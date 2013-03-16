<?php $with_unit_tests = isset($with_unit_tests) && $with_unit_tests; ?>

<?php if ($with_unit_tests): ?>
<!-- Unit tests - with Buster.js -->

<?php /*<script src="http://busterjs.org/releases/latest/buster-test.js"></script>*/ ?>
<script src="<?php echo BUSTER_JS_URL ?>"></script>
<script src="<?php echo base_url() ?>application/tests/test-trackoer.js"></script>

<p id=test-result><hr /></p>

<?php endif; ?>
