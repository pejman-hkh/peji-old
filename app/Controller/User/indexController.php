<?php

namespace App\Controller\User;

use App\Controller\User\appController as appController;
use App\Model\Users;

class indexController extends appController {

	public function before() {

	}

	public function index() {

		$this->set( [ 'title' => 'Title'] );

		$this->set( 'loop', Users::paginate(10)->row() );

	}

	public function after() {
	
	}

}

?>