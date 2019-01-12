<?php
namespace App\Controller\User;

use App\Controller\baseController as baseController;

class appController extends baseController {

	public function beforeApp() {
		$this->set('menu', include('../config/menu.php') );		
	}

	protected function keyPairParams( $arr ) {
		$ret = [];
		foreach( $arr as $k => $v ) {
			if( $k % 2 !== 0 )
				continue; 

			$ret[$v] = @$arr[$k+1];
		}
		
		return $ret;
	}
}

?>