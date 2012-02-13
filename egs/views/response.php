<?php if (isset($success) && $success) : ?>
	<script type="text/javascript">
		$(function() {
			new Notification('<strong>Success</strong> <?php print str_replace(array("\n", "\r"), ' ', nl2br($msg)); ?>', 'success');
		});
	</script>
<?php endif; ?>

<?php if (isset($success) && !($success)) : ?>
	<script type="text/javascript">
		$(function() {
			new Notification('<strong>Error</strong> <?php print str_replace(array("\n", "\r"), ' ', nl2br($msg)); ?>', 'error');
		});
	</script>
<?php endif; ?>

<?php if (validation_errors()) : ?>
	<?php $error_array = explode("\n", trim(validation_errors())); ?>
	
	<script type="text/javascript">
		$(function() {
			<?php foreach ($error_array as $error) : ?>
				new Notification('<strong>Error</strong> <?php print $error; ?>', 'error');
			<?php endforeach; ?>
		});
	</script>
<? endif; ?>