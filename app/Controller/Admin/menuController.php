<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;


class menuController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Menu' );
	}

	protected function index() {
		$this->set( [ 'title' => 'List' ] );

	}

	protected function add() {
		$this->set( [ 'title' => 'Add' ] );

	}

}

?>