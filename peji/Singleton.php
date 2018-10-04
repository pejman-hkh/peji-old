<?php
namespace Peji;

class Singleton {

	private static $Classes;

	public static function getInstance( $className ) {
		return ( self::$Classes[ $className ] = @self::$Classes[ $className ]?:( class_exists( $className ) ? new $className() : false ) );

	}

	public static function __callStatic($method, $args) {
    	return call_user_func_array( array( Singleton::getInstance( get_called_class() ), $method ), $args );
    }
}