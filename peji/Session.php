<?php
namespace Peji;

class Session extends Singleton {

	protected function get( $key = '' ) {
		return $key?@$_SESSION[$key]:$_SESSION;
	}

	protected function set( $key, $val ) {
		$_SESSION[ $key ] = $val;
	}
}


?>