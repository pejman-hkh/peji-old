<?php
namespace Peji;
use Pejman\Singleton;

class View extends Singleton {
	private $set = [];
	private $dir;

	protected function setDir( $dir ) {
		$this->dir = $dir;
	}

	private function resetAll() {
		$this->dir = '';
		$this->set = [];
	}

	protected function render( $layout ) {
	

		if( @count( $this->set ) > 0 ) foreach( $this->set as $k => $v ) {
			$this->$k = $v;
		}

		include( $this->dir.'/'.$layout.'.html' );

		$this->resetAll();
	}

	protected function set( $set ) {
		$this->set = $set;
	}

	protected function get() {
		return $this->set;
	}

	protected function fetch( $dir ) {
		include( $this->dir.'/'.$dir.'.html' );
	}
}