<?php 
namespace Atl\Database;
use ArrayAccess;
use Atl\Database\Database;


abstract class Model implements ArrayAccess
{	

	/**
     * The connection name for the model.
     *
     * @var string
     */
    protected $db;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [];

	protected function __construct( $table )
	{	
		$this->db = DB();
		$this->table = $table;
	}

	/**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {	
        return $this->$offset;
    }

	/**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    public function insert(){

    }

    public function update(){

    }

    public function findbyId(){

    }

    public function count(){

    }

    public function getAll(){

    }

}
