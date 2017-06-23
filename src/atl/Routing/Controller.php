<?php

namespace Atl\Routing;
use Atl\Routing\Route;
use Atl\Session\Session;

class Controller
{	
	public function __construct(){

	}

	/**
	 * Get info route.
	 * 
	 * @param  string $type Get method or controller
	 * @return stirng
	 */
	protected function getRoute( $type = null ){

		switch ( $type ) {
			case 'controller':
				return Route::getInstance()->getController();
				break;
			case 'method':
				return Route::getInstance()->getMethod();
				break;

			default:
				return Route::getInstance()->getRoute();
				break;
		}
	}

	/**
     * Handle session.
     * 
     * @return void
     */
	protected function session(){
		return Session::getInstance()->session;
	}

}
