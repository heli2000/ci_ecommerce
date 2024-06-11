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

$routes->group('category', static function ($routes) {
    $routes->get('viewAll', 'Category\Category::view_all_category');
});


$routes->group('admin', static function ($routes) {
    $routes->group('category', static function ($routes) {
        $routes->get('get', 'Category\Category::category_list', ['filter' => 'adminAuth']);

        $routes->get('export', 'Category\Category::export_category', ['filter' => 'adminAuth']);

        $routes->get('add', 'Category\AddEditCategory::index', ['filter' => 'adminAuth']);
        $routes->post('add', 'Category\AddEditCategory::addEditCategory', ['filter' => 'adminAuth']);

        $routes->get('edit/(:segment)', 'Category\AddEditCategory::index/$1', ['filter' => 'adminAuth']);
        $routes->post('edit/(:segment)', 'Category\AddEditCategory::addEditCategory/$1', ['filter' => 'adminAuth']);

        $routes->post('delete', 'Category\AddEditCategory::deleteCategory', ['filter' => 'adminAuth']);

        $routes->get('arrange', 'Category\ArrangeCategory::index', ['filter' => 'adminAuth']);
        $routes->post('arrange', 'Category\ArrangeCategory::update_category_sequence', ['filter' => 'adminAuth']);
    });

    $routes->group('product', static function ($routes) {
        $routes->group('variant', static function ($routes) {
            $routes->get('get', 'Product\Variant::index', ['filter' => 'adminAuth']);
            $routes->get('add', 'Product\Variant::add_variant', ['filter' => 'adminAuth']);
        });
    });
});


$routes->get('/404', function () {
    return view('404');
});

$routes->group('file/download', static function ($routes) {
    $routes->get('(:any)', 'FileController::download');
});
