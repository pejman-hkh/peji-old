<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use App\Model\Users as Users;

class userController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Users' );
	}

	protected function index() {
		$this->set( 'title', 'List' );


	}

	protected function add() {
		$this->set( 'title', 'Add' );
	}

	protected function search() {
		$this->set( 'title', 'Search' );
	}

}

?>