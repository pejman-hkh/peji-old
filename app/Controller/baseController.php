<?
namespace App\Controller;

use Pejman\Singleton as Singleton;

class baseController extends Singleton {

	protected $set;

	protected function set( $key, $val = [] ) {
		if( is_array( $key ) ) {
			foreach( $key as $k => $v ) {
				$this->set[ $k ] = $v;
			}
		} else {
			$this->set[ $key ] = $val;
		}
	}

	protected function get() {
		return $this->set;
	}
}

?>