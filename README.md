# atl-framework
The Atl Framework.


## Get Started

``` bash
$ composer install
```

## Load view
```php
View('layout/header')
```

## Use Route

Main index

``` php
$route = Atl\Routing\Route::getInstance();
```

``` php
$route->get('/','MainController@index');
```

Route Get

``` php
$route->get('/id/{id}','MainController@checkRouteGet');
```

Route  Post

``` php
$route->post('/validate','MainController@checkRoutePost');
```


## Use Model

Use model static

``` php
DB()->insert("account", [
	"user_name" => "foo",
	"email"     => "foo@bar.com"
]);
```

[Router](https://symfony.com/doc/current/routing.html).
[Router component](http://symfony.com/doc/current/create_framework/routing.html).


