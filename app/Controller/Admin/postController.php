<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;


class postController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Posts' );
	}

	protected function index() {
		$this->set( [ 'title' => 'List' ] );

	}


	protected function add() {
		$this->set( [ 'title' => 'Add' ] );

	}

}

?>