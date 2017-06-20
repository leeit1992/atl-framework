<?php

namespace Atl\Container;

use Pimple\Container as Pimple_Container;


class Container extends Pimple_Container
{	

	/**
     * The container's shared instances.
     *
     * @var array
     */
    protected $instances = [];

	/**
     * Register an existing instance as shared in the container.
     *
     * @param  string  $abstract
     * @param  mixed   $instance
     * @return void
     */
    public function instance($abstract, $instance)
    {
    	$this->instances[$abstract] = $instance;
    }

}