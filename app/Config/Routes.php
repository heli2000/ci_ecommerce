<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'User\UserController::login');
$routes->get('/register', 'User\UserController::register');
$routes->get('/forget-password', 'User\UserController::forgotPassword');
$routes->post('/addUser', 'User\UserController::createUser');
$routes->post('/loginUser', 'User\UserController::loginUser');
