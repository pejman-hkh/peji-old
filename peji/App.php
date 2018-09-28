<?
namespace Peji;
use Pejman\Singleton;

class App extends Singleton {

	function call( $class, $method, $args = [] ) {
		if( class_exists( $class ) && method_exists( $class, $method ) ) {
			call_user_func_array( $class.'::'.$method, $args );
			return true;
		}
		return false;
	}

}


?>