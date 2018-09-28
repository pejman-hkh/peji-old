<?
namespace Peji;
use Pejman\Singleton;

class Bootstrap extends Singleton {

	function start( $dir, $controller, $action, $id ) {

		$nController = "App\Controller\\".ucfirst($dir)."\\{$controller}Controller";

		if( App::call( $nController, $action, [ $id ] ) ) {
			
			$get = $nController::get();
			$get['controller'] = $controller;
			$get['action'] = $action;
			$get['id'] = $id;

			View::setDir( '../view' );
			View::set( $get );
			View::render( $dir.'/base/index' );

			return true;
		}

		return false;

	}

}


?>