<?php
namespace Peji;
use Pejman\Singleton;

class Request extends Singleton {

	protected function get( $key = '' ) {
		return $key ? $_GET[$key] : $_GET;
	}

	protected function post( $key = '' ) {
		return $key ? $_POST[$key] : $_POST;
	}

	protected function server( $key = '' ) {
		return $key ? $_SERVER[$key] : $_SERVER;
	}

}

?>