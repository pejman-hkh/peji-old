<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;

class indexController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Admin' );
	}

	protected function index() {
		$this->set( 'title', 'Dashboard' );


	}

	protected function after() {
	
	}
}

?>