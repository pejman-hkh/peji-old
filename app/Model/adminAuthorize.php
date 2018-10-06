<?php
namespace App\Model;

use Peji\App as App;
use Peji\Session as Session;
use Peji\Cookie as Cookie;
use Peji\Request as Request;


class adminAuthorize extends baseModel {
	var $table = 'users';

    protected function sessionAgent() {
    	$server = Request::server();
        return md5( App::key().$server['REMOTE_ADDR'].App::key().$server['HTTP_USER_AGENT'].App::key() );
    }

    protected function encrypt( $str ) {
    	return md5( sha1( $str.App::key().$str ) );
    }

    protected function logout() {
    	Session::unset('adminId');
    	Session::unset('adminAgent');

    	Cookie::unset('adminLogin');
    }

	protected function login( $username, $password, $remember = false ) {
		
		$fetch = $this->where( [ 'username = ? ', 'password = ? ', "active = '1'" ] )->findOne([ $username, $this->encrypt( $password ) ]);
		if( @count( $fetch ) > 0 ) {
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
			$this->User = $this->where( [ 'id = ?', "active = '1'" ] )->findOne([ Session::get('adminId') ]);
			return true;
		}

		$cookie = Cookie::get('adminLogin');
		if( ! empty( $cookie ) ) {
			$this->User = $this->where( [ 'cookie = ?', "active = '1'" ] )->findOne([ $cookie ]);
			return true;
		}

		return false;
	}

	protected function getUser() {
		if( ! @$this->User ) {
			$this->User = $this->check();
		}

		return $this->User;
	}

}

?>