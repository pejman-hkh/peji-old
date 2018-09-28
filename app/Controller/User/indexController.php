<?php

namespace App\Controller\User;

use App\Controller\baseController;
use App\Model\Users as Users;

class indexController extends baseController {

	protected function before() {
		$this->set( 'mainTitle', 'Admin' );
	}

	protected function index() {

		$this->set( [ 'title' => 'Dashboard'] );

		$this->set( 'loop', Users::pagination()->row() );
	}

	protected function after() {
	
	}

}

?>