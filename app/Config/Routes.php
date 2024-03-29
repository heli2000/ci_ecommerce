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

$routes->group('admin', static function ($routes) {
    $routes->group('category', static function ($routes) {
        $routes->get('add', 'Category\Category::addCategoryForm', ['filter' => 'adminAuth']);
        $routes->post('add', 'Category\Category::addCategory', ['filter' => 'adminAuth']);
        $routes->get('get', 'Category\Category::category_list', ['filter' => 'adminAuth']);
    });
});


$routes->get('/404', function () {
    return view('404');
});

$routes->group('file/download', static function ($routes) {
    $routes->get('(:any)', 'FileController::download');
});
