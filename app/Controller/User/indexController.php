<?php

namespace App\Controller\User;

use App\Controller\baseController;
use App\Model\Users as Users;

class indexController extends baseController {

	protected function index() {

		$this->set( [ 'title' => 'test ast'] );

		$this->set( 'loop', Users::pagination()->row() );
	}
}

?>