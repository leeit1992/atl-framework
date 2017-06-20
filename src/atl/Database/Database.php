<?php 
namespace Atl\Database;

use Medoo\Medoo;

class Database extends Medoo
{	
	public function __construct(){
		return new Medoo($this->pathConfig());
	}

	public function pathConfig(){
		global $app;
		return require_once $app->configPath() . '/database.php';
	}
}