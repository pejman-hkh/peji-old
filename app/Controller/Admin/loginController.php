<?php

namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use Peji\Request as Request;

class loginController extends appController {

	var $noAuthorize = true;

	protected function getLayout() {
		return 'login';
	}
	
	protected function index() {
		$post = Request::post();

		if( count( $post ) > 0  ) {
			
			if( Authorize::login( $post['username'], $post['password'], $post['remember'] ) ) {
				return $this->flash('Ok', 1 );
			}

			return $this->flash('Fail');

		}
	}
}

?>