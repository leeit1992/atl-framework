<?php 
namespace Atl\Database;

use Medoo\Medoo;

class DB
{	
	private static $getInstance;

	public static function getInstance(){
        if (!(self::$getInstance instanceof self)) {
            self::$getInstance = new self();
        }
        
        return self::$getInstance;
    }

	private function __construct(){
		$this->connect = new Medoo($this->pathConfig());
	}

	/**
	 * Get config database from project
	 * 
	 * @return array
	 */
	public function pathConfig(){
		global $app;
		return require_once $app->configPath() . '/database.php';
	}

}