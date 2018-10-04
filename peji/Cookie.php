<?php
namespace Peji;

class Cookie extends Singleton {

	protected function get( $key = '' ) {
		return $key?@$_COOKIE[ $key ]:$_COOKIE;
	}

	protected function set( $key, $val, $day = 1, $path = '/', $domain = '', $secure = false, $httponly = true ) {
		$domain = $domain?:App::domain();
		setcookie($key,$val, $day * 3600 * 24, $path, $domain, $secure, $httponly);
	}
}


?>