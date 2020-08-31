<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['registro'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'registro'
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'indexController',
			'action' => 'registrar'
		);

		$this->setRoutes($routes);
	}

}

?>