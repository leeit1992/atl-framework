<?php

namespace Atl\View;

class Loader
{	

	private static $getInstance;
	
	public static function getInstance(){
		if (!(self::$getInstance instanceof self)) {
			self::$getInstance = new self();
		}

		return self::$getInstance;
	}

	private function __construct()
	{
		# code...
	}

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
	public function view($view, $vars = array(), $return = FALSE)
	{
		global $app;

		$data = $this->prepareViewVars($vars);
		if( null !== $data ) {
			extract( $data );
		}

		$file = $app->path['path.resources'] . '/views/' . $view .'.php';	

		if( file_exists( $file ) ) {
			include $file;
		}
	}

	/**
	 * Prepare variables for _atl_vars, to be later extract()-ed inside views
	 *
	 * Converts objects to associative arrays and filters-out internal
	 * variable names (i.e. keys prefixed with '_atl_').
	 *
	 * @param	mixed	$vars
	 * @return	array
	 */
	protected function prepareViewVars($vars)
	{
		if ( ! is_array($vars))
		{
			$vars = is_object($vars)
				? get_object_vars($vars)
				: array();
		}
		foreach (array_keys($vars) as $key)
		{
			if (strncmp($key, '_atl_', 4) === 0)
			{
				unset($vars[$key]);
			}
		}
		return $vars;
	}
}