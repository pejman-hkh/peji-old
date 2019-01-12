<?php
namespace App\Controller\Admin;
use App\Controller\Admin\appController as appController;

class indexController extends appController {

	public function before() {
		$this->set( 'mainTitle', 'Admin' );
	}

	public function index() {
		$this->set( 'title', 'Dashboard' );


	}

	public function after() {
	
	}
}

?>