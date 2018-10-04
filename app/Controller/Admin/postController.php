<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use App\Model\Posts as Posts;

class postController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Posts' );
	}

	protected function index() {
		$this->set( [ 'title' => 'List' ] );

		$this->set( 'loop', Posts::paginate(10)->row() );

	}


	protected function add() {
		$this->set( [ 'title' => 'Add' ] );

	}

}

?>