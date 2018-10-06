<?
namespace App\Controller;

use Peji\Controller as Controller;

class baseController extends Controller {

	function flash( $msg, $status = 0, $data = [] ) {
		echo json_encode( [ 'msg' => $msg, 'status' => $status, 'data' => $data ] );
		exit();
	}

	function validate( $arr ) {
		foreach( $arr as $k => $v ) {
			
			if( is_array( $v ) ) {
				$check = $v[0];
				$error = $v[1];
			} else {
				$error = $v.' is required';
				$check = $v;
			}

			if( empty( $this->post[ $k ] ) && $check === 'required' ) {

				$this->error = $error;
				return 1;
			}

		}
	}
}

?>