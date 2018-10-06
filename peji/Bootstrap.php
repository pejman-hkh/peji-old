<?
namespace Peji;

class Bootstrap extends Singleton {

	function start( $dir, $controller, $action, $id ) {

		$nController = "App\Controller\\".ucfirst($dir)."\\{$controller}Controller";

		$get['dir'] = $dir;
		$get['controller'] = $controller;
		$get['action'] = $action;
		$get['id'] = $id;
		$get['baseUrl'] = baseUrl;
		$get['get'] = Request::get();
		$get['post'] = Request::post();
		$get['server'] = Request::server();

		if( class_exists( $nController ) ) {
			foreach( $get as $k => $v ) {
				$nController::setKey( $k, $v );
			}
		}

		App::call( $nController, 'beforeApp' ) ;
		App::call( $nController, 'before' ) ;

		if( App::call( $nController, $action, [ $id ] ) ) {
	
			$get += (array)$nController::get();

			View::set( $get );
			View::render( $dir.'/base/'.(isset($nController::$layout)?$nController::$layout:'index') );
			App::call( $nController, 'after' ) ;

			return true;
		}

		return false;
	}
}

?>