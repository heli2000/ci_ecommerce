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
$routes->post('/verify', 'UserAuth\UserController::otpVerify');

$routes->get('/forget-password', 'UserAuth\UserController::forgotPassword');
$routes->post('/forget-password', 'UserAuth\UserController::forgotPassword');
$routes->post('/set-new-pass', 'UserAuth\UserController::setNewPassword');

$routes->get('/logout', 'UserAuth\UserController::logout');
