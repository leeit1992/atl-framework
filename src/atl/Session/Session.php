<?php

namespace Atl\Session;

use Symfony\Component\HttpFoundation\Session\Session as SymSession;

/**
 * Handle session
 */

class Session{

	private static $getInstance;

	/**
	 * Object session.
	 * @var [type]
	 */
	public $session;

	public static function getInstance(){
        if (!(self::$getInstance instanceof self)) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
    } 

    private function __construct()
	{
		if( $this->sessionStatus() ) {
			$session = new SymSession();
			$session->start();

			$this->session = $session;
		}
	}

	/**
	 * Load config of system.
	 * 
	 * @return array
	 */
	protected function loadConfig(){
		global $app;
		return require_once $app->configPath() . '/app.php';
	}

	/**
	 * Get status of session
	 * 
	 * @return boole
	 */
	public function sessionStatus(){
		$config = $this->loadConfig();

		return $config['session'];
	}
}