<?
namespace App\Controller;

use Peji\Controller as Controller;

class baseController extends Controller {

	function flash( $msg, $status = 0, $data = [] ) {
		echo json_encode( [ 'msg' => $msg, 'status' => $status, 'data' => $data ] );
		exit();
	}
}

?>