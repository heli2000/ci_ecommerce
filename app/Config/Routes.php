<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'UserAuth\UserController::login');
$routes->post('/login', 'UserAuth\UserController::login');

$routes->get('/register', 'UserAuth\UserController::register');
$routes->post('/register', 'UserAuth\UserController::register');

$routes->get('/forget-password', 'UserAuth\UserController::forgotPassword');

$routes->get('/logout', 'UserAuth\UserController::logout');
