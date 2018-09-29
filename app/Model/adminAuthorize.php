<?php
namespace App\Model;
session_start();
use Pejman\Singleton;
use Pejman\Model as Model;
use Peji\Session as Session;
use Peji\Cookie as Cookie;

class adminAuthorize extends Model {
	var $table = 'pa_users';

    protected function sessionAgent() {
        return md5( App::key().$this->server['REMOTE_ADDR'].App::key().$this->server['HTTP_USER_AGENT'].App::key() );
    }

	protected function login( $username, $password, $remember = false ) {
		
		$fetch = $this->where( [ 'username = ? ', 'password = ? ', "status = '1'" ] )->findOne([ $username, $password ]);
		if( count( $fetch ) > 0 ) {
			$session = md5( $username.$password );
			$agent = $this->sessionAgent();
	
		
			Session::set('adminId', $fetch['id'] );
			Session::set('adminAgent', $agent );

			if( $remember ) {
				$appKey = App::key();

				$cookie = md5( $agent.$appKey.$username.$appKey.$password );
				Cookie::set('adminLogin', $cookie, 20 );
				$this->where( [ 'id' => $fetch['id'] ] )->update([ 'cookie' => $cookie ]);				
			}

			return true;
		}

		return false;
	}

	protected function check() {
		$agent = Session::get( 'adminAgent' );
		if( ! empty( $agent ) && $agent === $this->sessionAgent() ) {
			$this->User = $this->where( [ 'id = ?', "status = '1'" ] )->findOne([ Session::get('adminId') ]);
			return true;
		}

		$cookie = Cookie::get('adminLogin');
		if( ! empty( $cookie ) ) {
			$this->User = $this->where( [ 'cookie = ?', "status = '1'" ] )->findOne([ $cookie ]);
			return true;
		}

		return false;
	}

	protected function getUser() {
		if( ! $this->User ) {
			$this->User = $this->check();
		}

		return $this->User;
	}

}

?>