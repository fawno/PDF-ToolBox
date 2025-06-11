<?php
	declare(strict_types=1);

	namespace PDFToolBox\View;

	use Cake\View\View;

	class AppView extends View {
		public function initialize(): void {
			parent::initialize();

			$this->loadHelper('Html', [
				'className' => 'FawnoHelpers.Html',
			]);
			$this->loadHelper('Form', [
				'className' => 'FawnoHelpers.Form',
				'useCustomFileInput' => true,
			]);
			$this->loadHelper('Paginator', [
				'className' => 'FawnoHelpers.Paginator',
			]);
			$this->loadHelper('Modal', [
				'className' => 'FawnoHelpers.Modal',
			]);
			$this->loadHelper('Flash', [
				'className' => 'FawnoHelpers.Flash',
			]);
			$this->loadHelper('Navbar', [
				'className' => 'FawnoHelpers.Navbar',
			]);
			$this->loadHelper('Panel', [
				'className' => 'FawnoHelpers.Panel',
			]);
		}
	}
