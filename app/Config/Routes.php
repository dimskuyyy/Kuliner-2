<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', '\App\Controllers\Front\Home::index');

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
