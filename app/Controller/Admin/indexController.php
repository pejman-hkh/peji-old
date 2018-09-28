<?php

namespace App\Controller\Admin;

use App\Controller\baseController;

class indexController extends baseController {

	protected function before() {
		$this->set( 'mainTitle', 'Admin' );
	}

	protected function index() {
		$this->set( [ 'title' => 'Dashboard' ] );

	}

	protected function after() {
	
	}
}

?>