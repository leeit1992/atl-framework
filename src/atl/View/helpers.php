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
        return Loader::getInstance()->view($view, $vars, $return = FALSE);
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

if (! function_exists('enqueueStyle')) {
	/**
	 * enqueue_style
	 * Load style file.
	 * 
	 * @param  array $args  List data style file.
	 * @return string
	 */
    function enqueueStyle($args)
    {
        return Loader::getInstance()->enqueueStyle($args);
    }
}


if (! function_exists('registerStyle')) {
	/**
	 * registerStyle
	 * Register style before system load style.
	 * 
	 * @param  array $args  List style register
	 * @return void
	 */
    function registerStyle($args)
    {
        return Loader::getInstance()->registerStyle($args);
    }
}

if (! function_exists('registerScrips')) {
	/**
	 * registerScrips
	 * Register script before system load script.
	 * 
	 * @param  array $args  List script register
	 * @return void
	 */
    function registerScrips($args)
    {
        return Loader::getInstance()->registerScrips($args);
    }
}

