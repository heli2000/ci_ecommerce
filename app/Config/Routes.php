<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'User\UserController::login');
$routes->post('/login', 'User\UserController::login');

$routes->get('/register', 'User\UserController::register');
$routes->post('/register', 'User\UserController::register');

$routes->get('/forget-password', 'User\UserController::forgotPassword');

$routes->get('/logout', 'User\UserController::logout');
