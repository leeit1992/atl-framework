<?php

namespace Atl\View;

class Loader
{	

	private static $getInstance;

	/**
	 * List register script
	 * @var null
	 */
	public $registerScrips = null;

	/**
	 * List register style
	 * @var null
	 */
	public $registerStyle = null;

	
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

	/**
	 * enqueue_scripts
	 * Load script file.
	 * 
	 * @param  array $args  Args data script file.
	 * @return string
	 */
	public function enqueueScripts( $args ){
		$out = '';

		foreach ($args as $key => $value) {
			$out .= '<script id=' . $key . ' src="' . $value . '"></script>' . PHP_EOL;
		}

		if( $this->registerScrips ) {
			foreach ($this->registerScrips as $key => $value) {
				$out .= '<script id=' . $key . ' src="' . $value . '"></script>' . PHP_EOL;
			}
		}
		echo $out;
	}

	/**
	 * registerScrips
	 * Register script before system load script.
	 * 
	 * @param  array $args  List script register
	 * @return void
	 */
	public function registerScrips( $args ){
		$this->registerScrips = $args;
	}

	/**
	 * enqueue_style
	 * Load style file.
	 * 
	 * @param  array $args  List data style file.
	 * @return string
	 */
	public function enqueueStyle( $args ){
		$out = '';
		foreach ($args as $key => $value) {
			$out .= '<link id=' . $key . ' href="' . $value . '" rel="stylesheet">'  . PHP_EOL;
		}
		if( $this->registerStyle ) {
			foreach ($this->registerStyle as $key => $value) {
				$out .= '<link id=' . $key . ' rel="stylesheet" type="text/css" href="' . $value . '">' . PHP_EOL;
			}
		}
		echo $out;
	}

	/**
	 * registerStyle
	 * Register style before system load style.
	 * 
	 * @param  array $args  List style register
	 * @return void
	 */
	public function registerStyle( $args ){
		$this->registerStyle = $args;
	}
}