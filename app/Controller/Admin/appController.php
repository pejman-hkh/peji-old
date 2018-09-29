<?php
namespace App\Controller\Admin;

use App\Controller\baseController as baseController;
use App\Model\adminAuthorize as Authorize;

class appController extends baseController {

	protected function beforeApp() {

		if( ! $this->noAuthorize && ! Authorize::check() ) {
			
			header("Location: login");
			exit();
		}

		$this->set('menu', include('../config/menu.php') );		
	}
}

?>