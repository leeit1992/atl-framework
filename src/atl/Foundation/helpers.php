<?php


if (! function_exists('url')) {
    
    /**
     * Get base url.
     * @param  string $path Path controller
     * @return string       
     */
    function url( $path )
    {
    	global $app;
    	$config = $app->configFile();

    	return $config['url']['APP_URL'] . $path;
    }
}

