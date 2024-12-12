<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Non member or admin authentication
$routes->get('/register', '\App\Controllers\Front\Auth::register', ['as' => 'front.auth.register', 'filter' => ['guest']]);
$routes->post('/register', '\App\Controllers\Front\Auth::storeUser', ['as' => 'front.auth.storeUser', 'filter' => ['guest']]);
$routes->get('/login', '\App\Controllers\Front\Auth::login', ['as' => 'front.auth.login', 'filter' => ['guest']]);
$routes->post('/login', '\App\Controllers\Front\Auth::auth', ['as' => 'front.auth.storeAuth', 'filter' => ['guest']]);

$routes->get('/', '\App\Controllers\Front\Home::index', ['as' => 'front.index']);

$routes->get('/kuliner', '\App\Controllers\Front\Kuliner::index');
$routes->get('/kuliner/slug', '\App\Controllers\Front\Kuliner::detail');
$routes->get('/user/example', '\App\Controllers\Front\Profile::index');
$routes->get('/post', '\App\Controllers\Front\Post::index');
$routes->get('/post/slug', '\App\Controllers\Front\Post::detail');


$routes->group('wbpanel', ['namespace' => 'App\Controllers\Back'], static function ($routes) {

    $routes->get('logout', 'Auth::logout');
    $routes->get('login', 'Auth::login');
    $routes->post('login-do', 'Auth::doLogin');
    $routes->group('/', ['filter' => ['isLoggedIn'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');
    });
});
