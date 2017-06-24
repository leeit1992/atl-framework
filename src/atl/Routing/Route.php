<?php

namespace Atl\Routing;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route as symRoute;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;

use Atl\Routing\UrlMatcher as AtlUrlMatcher;

class Route
{

    private static $getInstance;

    /**
     * The object route.
     * @var object
     */
    protected $routes;

    /**
     * current route
     * @var array
     */
    public $getRoute;

    /**
     * The default values for the route.
     *
     * @var array
     */
    protected $routesList = [];

    /**
     * Auto-load in-accessible properties on demand.
     *
     * @param mixed $key
     * @return mixed
     */
    public function __get( $key ) {
        if ( in_array( $key, array( 'getRoute', 'getController', 'getMethod' ) ) ) {
            return $this->$key();
        }
    }

	private function __construct()
	{
        $this->routes = new RouteCollection();
	}
    
    public static function getInstance(){
        if (!(self::$getInstance instanceof self)) {
            self::$getInstance = new self();
        }

        return self::$getInstance;
    } 

    /**
     * Send display for client.
     * 
     * @return void
     */
    public function send(){
        $this->createFromGlobals();
    }

    /**
     * createFromGlobals
     * Handle route request to system.
     * 
     * @return void
     */
    public function createFromGlobals(){
        global $app;

        $route = $this;

        require_once $app->path() . '/Http/routes.php';

        $request = Request::createFromGlobals();

        $this->getMetthod();

        $context = new RequestContext();
        $context->fromRequest($request);
        $matcher = new UrlMatcher($this->routes, $context);

        $this->getRoute = $attributes = $matcher->match($request->getPathInfo());

        // Call function run controller.
        call_user_func_array(
            'atlBeginAction', 
            array(
                'App\Http\Controllers\\' . $attributes['_controller'], 
                $attributes['_action'],
                $this->getParameters($attributes)
            )
        );
    }

    /**
     * Add to list method GET.
     * 
     * @param  string $rw         Link was rewrite 
     * @param  String $handle     Controller handle for link.
     * @param  array  $parameters Data send to method of controller.
     * @return void
     */
    public function get( $rw, $handle, $parameters = array() ){
        $this->routesList['GET'][] = array( 'rw' => $rw, 'handle' => $handle, 'parameters' => $parameters );
    }

    /**
     * Add to list method POST.
     * 
     * @param  string $rw         Link was rewrite 
     * @param  String $handle     Controller handle for link.
     * @param  array  $parameters Data send to method of controller.
     * @return void
     */
    public function post( $rw, $handle, $parameters = array() ){
        $this->routesList['POST'][] = array( 'rw' => $rw, 'handle' => $handle, 'parameters' => $parameters );
    }

    /**
     * Check method for client to system.
     * 
     * @return void
     */
    public function getMetthod(){

        switch ( $_SERVER['REQUEST_METHOD'] ) {
            case 'GET':
                $this->addRoute('GET');
                break;

            case 'POST':
                $this->addRoute('POST');
                break;
        }        
    }

    /**
     * Add link route to system.
     * 
     * @param void
     */
    public function addRoute( $method ){
        foreach ($this->routesList[$method] as $value) {
            $control = explode( '@', $value['handle'] );

            $this->routes->add(
                $value['rw'], 
                    new symRoute(
                        $value['rw'], 
                        array(
                            '_controller'   => $control[0],
                            '_action'       => $control[1],
                        ), 
                        $value['parameters'], 
                        array(), 
                        '', 
                        array(), 
                        array($method, 'HEAD')
                    )
                );  

        } 
    }

    /**
     * Get parameters for method of class controller.
     * 
     * @param  array $args   Data router.
     * @return array
     */
    public function getParameters( $args ){
        unset($args['_controller'], $args['_action'], $args['_route']);
        return $args;
    }

    /**
     * Get info route current.
     * 
     * @return array
     */
    public function getRoute(){
        return $this->getRoute;
    }

    /**
     * Get name controller handle.
     * 
     * @return string
     */
    public function getController(){
        return $this->getRoute['_controller'];
    }

    /**
     * Get method of controller handle.
     * 
     * @return [type] [description]
     */
    public function getMethod(){

        if( empty( $this->getRoute['_action'] ) ) {
            return false;
        }

        return $this->getRoute['_action'];
    }
}

