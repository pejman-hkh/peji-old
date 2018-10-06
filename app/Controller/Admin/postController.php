<?php
namespace App\Controller\Admin;

use App\Controller\Admin\appController as appController;
use App\Model\Posts as Posts;
use Peji\Config as Config;

class postController extends appController {

	protected function before() {
		$this->set( 'mainTitle', 'Posts' );
	}

	protected function index() {
		$this->set( 'title', 'List' );

		$this->set( 'loop', Posts::leftJoin("users", "posts.adminid = users.id")->searchKey([ 
			[ 'title', 'posts.title', '%LIKE%' ] 
		])->search(['posts.title', 'posts.url' ])->paginate(10)->row() );

		$this->set( 'pagination', Posts::getPaginate() );
	}

	private function feature() {
		$this->set('loopKind', Config::file('postKind') );
	}

	protected function add() {
		$this->set( 'title', 'Add' );
		$this->feature();

		if( @count( $this->post ) > 0 ) {

			if( $this->validate( [ 
				'title' => [ 'required', 'Title is required' ],  
				'text' => [ 'required', 'Text is required' ],  				
				'kind' => ['required', 'Kind is required'], 
			] ) ) {
				return $this->flash( $this->error );
			}

			Posts::create([
				'adminid' => $this->admin['id'],
				'title' => $this->post['title'],
				'shorttext' => $this->post['shorttext'],
				'text' => $this->post['text'],
				'kind' => $this->post['kind'],
				'url' => $this->post['url'],
				'curl' => $this->post['curl'],
				'tags' => $this->post['tags'],
				'icon' => $this->post['icon'],
				'active' => $this->post['active'],
				'firstpage' => $this->post['firstpage'],
				'comment' => $this->post['comment'],
				'date' => time(),
			]);

			return $this->flash('Added successfully', 1 );
		}
	}

	protected function edit( $id = '' ) {
		$this->feature();
		$fetch = Posts::find( $id );

		$this->set( 'title', 'Edit '.$fetch['title'] );
		$this->set( 'assign', $fetch );
	}

	protected function search() {
		$this->set( 'title', 'Search' );

	}
	
	protected function remove() {
	}
}

?>