<?php
namespace App\Controller\Admin;

use App\Controller\baseController as baseController;
use App\Model\adminAuthorize as Authorize;
use Peji\Request as Request;

class appController extends baseController {

	protected function beforeApp() {

		$this->post = Request::post();

		if( ! @$this->noAuthorize && ! Authorize::check() ) {
			
			header("Location: ".baseUrl."admin/login?r=".getPath() );
			exit();
		}

		$this->set('menu', include('../config/menu.php') );		
	}
}

?>