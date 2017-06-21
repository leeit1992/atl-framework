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

if (! function_exists('parametersExtra')) {
    
    function parametersExtra( $pairs, $atts )
    {
        $atts = (array)$atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if ( array_key_exists($name, $atts) )
                $out[$name] = $atts[$name];
            else
                $out[$name] = $default;
        }

        return $out;
    }
}

