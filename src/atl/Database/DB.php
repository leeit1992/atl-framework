<?php 
namespace Atl\Database;

use Atl\Database\Database;
use test;
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

		$this->connect = new Database();
		test();
	}


}