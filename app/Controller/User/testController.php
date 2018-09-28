<?php

namespace App\Controller\User;

use App\Controller\baseController;
use App\Controller\User\appController as appController;

class testController extends appController {

	function index() {
		echo "In test index method";
	}

	function test() {
		echo "In test test method";
	}
}

?>