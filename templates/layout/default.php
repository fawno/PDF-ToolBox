<!DOCTYPE html>
<?php
	echo $this->Html->tag('html');
	echo $this->Html->tag('head');

	echo $this->Html->charset();
	echo $this->Html->meta('favicon.png', 'PDFToolBox./img/favicon.png', ['type' => 'icon']);
	//echo $this->Html->tag('title', (string) $this->fetch('title'));
	echo $this->Html->tag('title', 'GN - PDF ToolBox -' . $this->name . ': ' . $this->fetch('title'));
	echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1.0');
	echo $this->Html->meta('description', 'Grupo Noticias PDF-ToolBox');
	echo $this->Html->meta('author', 'Fernando Herrero, 2025');
	echo $this->Html->meta('icon'), "\n";

	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css');
	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.css');
	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css');
	echo $this->Html->css('https://evoluteur.github.io/colorpicker/css/evol-colorpicker.min.css');
	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css');
	//echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css');
	echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.min.css');
	echo $this->Html->css('https://use.fontawesome.com/releases/v5.3.1/css/all.css', ['integrity' => 'sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU', 'crossorigin' => 'anonymous']);
	//echo $this->Html->css('https://fonts.googleapis.com/css?family=Work+Sans:400,700');
	echo $this->Html->css('PDFToolBox.fawno');
	echo $this->Html->css('PDFToolBox.fawno-print');

	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js');
	echo $this->Html->script('https://evoluteur.github.io/colorpicker/js/evol-colorpicker.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.min.js');
	echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/i18n/defaults-es_ES.min.js');
	//echo $this->Html->script('https://markusslima.github.io/bootstrap-filestyle/js/bootstrap-filestyle.min.js');
	echo $this->Html->script('https://creativecouple.github.io/jquery-timing/jquery-timing.min.js');
	//echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.1/clipboard.min.js');

	echo $this->Html->css('FawnoHelpers.styles');
	echo $this->Html->script('FawnoHelpers.scripts');

	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<script>
	$(function() {
		$('li[action="restore"] a').click(function(event) {
			event.preventDefault();
			$(this).blur();
			$('#dialog-restore').modal('show');
			$('#dialog-restore .modal-body > .form-saving').hide();
		});

		$('#form-restore').submit(function() {
			$('#dialog-restore .modal-footer').hide();
			$('#dialog-restore .modal-body > .form-saving').show();
		});

		$('.modal').on('shown.bs.modal', function (event) {
			var minWidth = $(this).attr('min-width');
			if (minWidth == undefined) {
				var minWidth = $(this).find('.modal-content').outerWidth();
				$(this).find('.modal-content').attr('min-width', minWidth);
				$(this).find('.modal-content').resizable('option', 'minWidth', minWidth);
			}

			var minHeight = $(this).attr('min-height');
			if (minHeight == undefined) {
				var minHeight = $(this).find('.modal-content').outerHeight();
				$(this).find('.modal-content').attr('min-height', minHeight);
				$(this).find('.modal-content').resizable('option', 'minHeight', minHeight);
			}
		});

		$('.modal-content').draggable({ handle: '.modal-header', opacity: 0.8 });
		$('.modal-content').resizable({ handles: 'all' });
	});
</script>
<style>
<?php if (!empty($nomenu)) { ?>
	body { padding-top: 10px; }
<?php	} ?>
	#navbar li.dropdown[plugin="<?php echo $this->plugin; ?>"][controller=""][action=""] { color: #555; background-color: #E7E7E7; background-image: unset; }
	#navbar li.dropdown[plugin="<?php echo $this->plugin; ?>"][controller="<?php echo $this->name; ?>"][action=""] { color: #F55; background-color: #E7E7E7; background-image: unset; }
	#OLD_navbar li.dropdown[controller="<?php echo $this->name; ?>"][action=""] { color: #555; background-color: #E7E7E7; background-image: unset; }
</style>
<script>
	$(function() {
		//$('body > nav li[class="active"]:not([controller="<?php echo $this->name; ?>"])').removeClass('active');
	});
</script>
<?php
	echo $this->Html->tag('/head');
	echo $this->Html->tag('body');

	if (empty($nomenu)) {
		$params = empty($this->request->getParam('pass')) ? [] : $this->request->getParam('pass');

		echo $this->Navbar->create($this->Html->image('PDFToolBox.gn.png', ['class' => 'navbar-header-logo']), ['fixed' => 'top', 'responsive' => true, 'role' => 'navigation']) ;
		echo $this->Navbar->beginMenu();

		echo $this->Navbar->link($this->Html->icon('home'), ['plugin' => 'PDFToolBox', 'controller' => '/', 'action' => ''], ['controller' => 'App', 'action' => 'index']);
		echo $this->Navbar->link(__('Cortar'), ['plugin' => 'PDFToolBox', 'controller' => '/', 'action' => 'crop'], ['controller' => 'App', 'action' => 'crop']);


		echo $this->Navbar->endMenu();
			echo $this->Navbar->beginMenu(['class' => 'navbar-right']);
				//echo $this->Navbar->link('PHP Info', ['controller' => '/', 'action' => 'info'], ['controller' => 'App', 'action' => 'info'], ['escape' => false]);
			echo $this->Navbar->endMenu();
		echo $this->Navbar->end() ;
	}

	$modal_restore = [
		$this->Form->button(__('Cancelar'), ['id' => 'button-cancel', 'class' => 'btn-default', 'data-dismiss' => 'modal']),
		$this->Form->button(__('Restaurar'), ['id' => 'button-save', 'class' => 'btn-default']),
	];
	echo $this->Form->create(null, ['id' => 'form-restore', 'enctype' => 'multipart/form-data', 'url' => ['action' => 'restore']]);
	echo $this->Modal->create(__('Restaurar backup:'), ['id' => 'dialog-restore', 'data-backdrop' => 'static', 'close' => false]);
	echo $this->Form->control('backupfile', [
		'type' => 'file', 'required', 'label' => false,
		'accept' => '.zip',
		'button-label' => $this->Html->icon('folder-open') . __('Fichero'),
		'_input' => ['placeholder' => __('Selecciona un archivo')],
		'_button' => ['escapeTitle' => false]
	]);
	$form_saving = '';
	$form_saving .= $this->Html->div('message-icon', $this->Html->icon('cog', ['class' => 'fa-spin']));
	$form_saving .= $this->Html->div('message-text', __('Estamos restaurando el backup. Espera unos momentos..'));
	echo $this->Html->div('form-saving', $form_saving);
	echo $this->Modal->end($modal_restore);
	echo $this->Form->end();

	echo $this->Html->div('container');
	echo $this->Flash->render();
	echo $this->fetch('content');
	echo $this->Html->tag('/div');

	echo $this->Html->div('container-wide');
	echo $this->fetch('content-wide');
	echo $this->Html->tag('/div');

	echo $this->Html->tag('/body');
	echo $this->Html->tag('/html');
