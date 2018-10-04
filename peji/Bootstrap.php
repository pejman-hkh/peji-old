<?
namespace Peji;

class Bootstrap extends Singleton {

	function start( $dir, $controller, $action, $id ) {

		$nController = "App\Controller\\".ucfirst($dir)."\\{$controller}Controller";

		App::call( $nController, 'beforeApp' ) ;
		App::call( $nController, 'before' ) ;

		if( App::call( $nController, $action, [ $id ] ) ) {
			
			$get = $nController::get();
			$get['dir'] = $dir;
			$get['controller'] = $controller;
			$get['action'] = $action;
			$get['id'] = $id;
			$get['baseUrl'] = baseUrl;

		
			View::setDir( '../view' );
			View::set( $get );
			View::render( $dir.'/base/'.(isset($nController::$layout)?$nController::$layout:'index') );

			App::call( $nController, 'after' ) ;

			return true;
		}

		return false;
	}
}

?>