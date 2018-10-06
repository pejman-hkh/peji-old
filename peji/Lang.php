<?php
namespace Peji;

class Lang extends Singleton {
	private $lang;

	protected function get() {
		return $this->lang?:'en';
	}

	protected function set( $lang ) {
		$this->lang = $lang;
	}
}

?>