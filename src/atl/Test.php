<?php 
namespace Atl;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;


class Test 
{
	
	function __construct()
	{	
		$request = Request::createFromGlobals();
		$routes = new RouteCollection();
		$routes->add('hello', new Route('/hello/{name}', array('name' => 'World','name2' => 'World')));
		$routes->add('blog_list', new Route('/blog/{page}/{name}', array(
		    '_controller' => 'AppBundle:Blog:list',
		),array(
		    'page' => '\d+',
		    'name' => 'a-zA-Z',
		    '_method' => 'POST'
		)));

		$routes->add('api_post_show', new Route('/api/posts/{id}', array(
		    '_controller' => 'AppBundle:BlogApi:show',
		), array(), array(), '', array(), array('GET', 'HEAD')));


		$context = new RequestContext();
		$context->fromRequest($request);
		$matcher = new UrlMatcher($routes, $context);

		$attributes = $matcher->match($request->getPathInfo());

		var_dump($matcher);
			
	}
}
