<?php
namespace Peji;

class ResultSet {
    public function __call($name, $arguments)
    {

    	$this->$name = $arguments[0];
    }
    public function __set( $name, $val ) {
   
    	$this->$name = $val;
    }

    public function __get( $name ) {
    	return $this->$name;
    }
}


?>