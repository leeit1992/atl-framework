<?php 
use Atl\View\Loader;

if (! function_exists('View')) {
    /**
	 * View Loader
	 *
	 * Loads "view" files.
	 *
	 * @param	string	$view	View name
	 * @param	array	$vars	An associative array of data
	 *				to be extracted for use in the view
	 * @param	bool	$return	Whether to return the view output
	 *				or leave it to the Output class
	 * @return	object|string
	 */
    function View($view, $vars = array(), $return = FALSE)
    {
        return Loader::getInstance()->view($view, $vars = array(), $return = FALSE);
    }
}

if (! function_exists('enqueueScripts')) {
	/**
	 * enqueue_scripts
	 * Load script file.
	 * 
	 * @param  array $args  Args data script file.
	 * @return string
	 */
    function enqueueScripts($args)
    {
        return Loader::getInstance()->enqueueScripts($args);
    }
}


