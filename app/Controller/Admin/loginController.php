<?php
namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use \App\Model\adminAuthorize as Authorize;

class loginController extends appController {

	public $noAuthorize = true;
	public $layout = 'login';

	public function index() {

		//Authorize::create( [ 'username' => 'admin', 'password' => Authorize::encrypt('admin') ] );

		if( @count( $this->post ) > 0  ) {
			
			if( Authorize::login( $this->post['username'], $this->post['password'], @$this->post['remember'] ) ) {
				return $this->flash('Successfully', 1 );
			}

			return $this->flash('Fail to login, username or passwrod wrong !');
		}
	}

	public function logout() {
		Authorize::logout();
	}

	public function forget() {

	}
}

?>