<?php
	declare(strict_types=1);

	use Cake\Routing\Route\DashedRoute;
	use Cake\Routing\RouteBuilder;

	return function (RouteBuilder $routes) {
		$routes->plugin(
			'PDFToolBox',
			['path' => '/pdftoolbox'],
			function (RouteBuilder $routes) {
				// Add custom routes here
				$routes->connect('/', ['controller' => 'App']);
				$routes->connect('/{action}/*', ['controller' => 'App']);

				$routes->fallbacks();
			}
		);
	};
