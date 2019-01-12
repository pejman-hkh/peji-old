<?php
namespace App\Controller\Admin;

use App\Controller\baseController as baseController;
use App\Model\adminAuthorize as Authorize;
use Peji\Request as Request;

class appController extends baseController {

	public function beforeApp() {

		if( ! @$this->noAuthorize ) {
			if(  ! Authorize::check() ) {
				header("Location: ".baseUrl."admin/login?r=".getPath() );
				exit();
			} else {
				$this->afterLogin();				
			}
		}
	}

	private function afterLogin() {

		//\Peji\Lang::set('fa');

		$this->admin = Authorize::getUser();
		$this->set( 'admin', $this->admin );

		$this->set('menu', include('../config/menu.php') );			
	}
}

?>