<?php

namespace App\Controller\User;

use App\Controller\User\appController as appController;
use App\Model\Users as Users;

class indexController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Admin' );
	}

	protected function index() {

		$this->set( [ 'title' => 'Dashboard'] );

		$this->set( 'loop', Users::paginate(10)->row() );
	}

	protected function after() {
	
	}

}

?>