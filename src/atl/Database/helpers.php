<?php 
use Atl\Database\DB;

if (! function_exists('DB')) {
    /**
     * DB query and connect.
     */
    function DB()
    {
        return DB::getInstance()->connect;
    }
}