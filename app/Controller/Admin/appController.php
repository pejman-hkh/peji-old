<?php
namespace App\Controller\Admin;

use App\Controller\baseController as baseController;

class appController extends baseController {

	protected function beforeApp() {
		$this->set('menu', include('../config/menu.php') );		
	}
}

?>