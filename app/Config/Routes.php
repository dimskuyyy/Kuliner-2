<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/kuliner', 'Kuliner::index');
$routes->get('/kuliner/slug', 'Kuliner::detail');
$routes->get('/user/example','Profile::index');
$routes->get('/post', 'Post::index');
$routes->get('/post/slug', 'Post::detail');

