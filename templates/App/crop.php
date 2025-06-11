<?php
  declare(strict_types=1);

	echo $this->Form->create(null, ['id' => 'form-upload-pdf', 'enctype' => 'multipart/form-data']);
	echo $this->Form->control('pdf', [
		'type' => 'file', 'required', 'label' => false,
		'accept' => '.pdf',
		'button-label' => __('Archivo PDF'),
		'_button' => ['escapeTitle' => false],
		'_input' => ['placeholder' => __('Selecciona un archivo PDF')],
	]);
	//echo $this->Form->control('pass', ['type' => 'text', 'default' => '1234']);
	echo $this->Form->submit();
	echo $this->Form->end();

	$this->append('script');
?>
<script>
	$(function() {
		$('#pdf-input').parent('.input-group');
	});
</script>
<?php
	$this->end();
	$this->append('css');
?>
<style>
</style>
<?php
	$this->end();
