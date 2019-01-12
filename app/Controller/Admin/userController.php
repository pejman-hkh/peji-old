<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use App\Model\Users as Users;

class userController extends appController {

	public function before() {
		$this->set( 'mainTitle', 'Users' );
	}

	public function index() {
		$this->set( 'title', 'List' );


	}

	public function add() {
		$this->set( 'title', 'Add' );
	}

	public function search() {
		$this->set( 'title', 'Search' );
	}

}

?>