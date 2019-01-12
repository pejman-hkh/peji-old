<?php
namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use App\Model\Menus as Menus;


class menuController extends appController {

	public function before() {
		$this->set( 'mainTitle', 'Menu' );
	}

	public function index() {
		$this->set( 'title', 'List' );

		$this->set( 'loop', Menus::paginate(10)->row() );
		$this->set( 'pagination', Menus::getPaginate() );

	}

	public function add() {
		$this->set( 'title', 'Add' );

	}

}

?>