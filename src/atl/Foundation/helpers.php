<?php

use Atl\Session\Session;

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

if (! function_exists('assets')) {
    
    /**
     * Get library from folder public.
     * @param  string $path Path controller
     * @return string       
     */
    function assets( $path )
    {
        global $app;
        $config = $app->configFile();

        return $config['url']['APP_URL'] . '/public/' . $path;
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

if (! function_exists('redirect')) {
    /**
     * Rdirect to url
     * 
     * @param  string  $url        Url link
     * @param  integer $statusCode Status code
     * @return void
     */
    function redirect($url, $statusCode = 303)
    {
       header('Location: ' . $url, true, $statusCode);
       die();
    } 
}

if (! function_exists('Session')) {
    /**
     * Handle session.
     * 
     * @return void
     */
    function Session()
    {
       return Session::getInstance()->session;
    } 
}

if (! function_exists('pr')) {
    /**
     * Handle show array.
     * 
     * @return void
     */
    function pr( $args )
    {   
        echo "<pre>";
        var_dump($args);
        echo "</pre>";
    } 
}

if (! function_exists('selected')) {
    /**
     * Handle selected form select
     * 
     * @return void
     */
    function selected( $data1, $data2 )
    {   
        if( $data1 == $data2 ) {
            return 'selected';
        }
    } 
}

if (! function_exists('checked')) {
    /**
     * Handle checked form input check box
     * 
     * @return void
     */
    function checked( $data1, $data2 )
    {   
        if( $data1 == $data2 ) {
            return 'checked';
        }
    } 
}

