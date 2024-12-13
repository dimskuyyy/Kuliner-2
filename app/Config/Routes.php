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
$routes->get('/kuliner/(:segment)', '\App\Controllers\Front\Kuliner::kategori/$1', ['as' => 'kulinerKategori']);
$routes->get('/kuliner/slug', '\App\Controllers\Front\Kuliner::detail');
$routes->get('/user/example', '\App\Controllers\Front\Profile::index');
$routes->get('/post', '\App\Controllers\Front\Post::index');
$routes->get('/post/slug', '\App\Controllers\Front\Post::detail');

$routes->get('media/(:segment)', '\App\Controllers\Front\MediaAccess::viewMedia/$1', ['as' => 'media']);

$routes->group('wbpanel', ['namespace' => 'App\Controllers\Back'], static function ($routes) {
    $routes->get('logout', 'Auth::logout');
    $routes->get('login', 'Auth::login');
    $routes->post('login-do', 'Auth::doLogin');
    $routes->group('/', ['filter' => ['isLoggedIn'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
        $routes->get('/', 'Dashboard::index');

        $routes->group('media', ['filter' => ['isLoggedIn'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Media::index');
            $routes->post('list', 'Media::list');
            $routes->post('form', 'Media::form');
            $routes->post('save', 'Media::save');
            $routes->post('delete', 'Media::delete');
        });

        $routes->group('membership', ['filter' => ['isSuperAdmin'], 'namespace' => 'App\Controllers\Back'], static function ($routes){
            $routes->get('/', 'Membership::index');
            $routes->post('datatable', 'Membership::getDatatable');
            $routes->post('list', 'Membership::list');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
            $routes->post('info', 'Membership::detail');
            $routes->post('form', 'Membership::form');
            $routes->post('save', 'Membership::save');
            $routes->post('delete', 'Membership::delete');
            $routes->post('add_payment', 'Membership::addPayment');
            $routes->post('save_payment', 'Membership::savePayment');

        });

        $routes->group('user', static function ($routes) {
            $routes->get('/', 'UserController::index', ['filter' => 'isSuperAdmin']);
            // $routes->get('profile', 'UserController::profile');
            $routes->post('list', 'UserController::list', ['filter' => 'isSuperAdmin']);
            $routes->post('form', 'UserController::form', ['filter' => 'isSuperAdmin']);
            $routes->post('save', 'UserController::save', ['filter' => 'isSuperAdmin']);
            $routes->post('delete', 'UserController::delete', ['filter' => 'isSuperAdmin']);
        });

        $routes->group('kuliner', ['filter' => ['isMember'], 'namespace' => 'App\Controllers\Back'], static function ($routes) {
            $routes->get('/', 'Kuliner::index');
            $routes->post('save', 'Kuliner::save');
            $routes->post('media', 'Media::getMedia');
            $routes->post('detail', 'Media::getDetailMedia');
        });

    });
});
