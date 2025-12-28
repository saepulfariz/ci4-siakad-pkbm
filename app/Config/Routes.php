<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'session']);

$routes->group('/superadmin', ['filter' => 'session'], function ($routes) {
    // $routes->resource('users', ['controller' => '\App\Controllers\Superadmin\Users', 'filter' => 'group:superadmin,admin']);

    $routes->get('users/(:any)/banned', '\App\Controllers\Superadmin\Users::banned/$1');
    $routes->resource('users', ['controller' => '\App\Controllers\Superadmin\Users']);

    $routes->resource('auth-groups', ['controller' => '\App\Controllers\Superadmin\AuthGroups']);
    $routes->resource('auth-permissions', ['controller' => '\App\Controllers\Superadmin\AuthPermissions']);
    $routes->resource('auth-permissions-groups', ['controller' => '\App\Controllers\Superadmin\AuthPermissionsGroups']);
    $routes->resource('auth-groups-users', ['controller' => '\App\Controllers\Superadmin\AuthGroupsUsers']);
    $routes->resource('auth-permissions-users', ['controller' => '\App\Controllers\Superadmin\AuthPermissionsUsers']);

    $routes->get('auth-menus/order', '\App\Controllers\Superadmin\AuthMenus::order');
    $routes->get('auth-menus/(:any)/activate', '\App\Controllers\Superadmin\AuthMenus::activate/$1');
    $routes->get('auth-menus/(:any)/deactivate', '\App\Controllers\Superadmin\AuthMenus::deactivate/$1');
    $routes->post('auth-menus/updateOrder', '\App\Controllers\Superadmin\AuthMenus::updateOrder');
    $routes->resource('auth-menus', ['controller' => '\App\Controllers\Superadmin\AuthMenus']);
});

$routes->get('academic-years/(:any)/activate', '\App\Controllers\AcademicYears::activate/$1');
$routes->get('academic-years/(:any)/deactivate', '\App\Controllers\AcademicYears::deactivate/$1');
$routes->resource('academic-years', ['controller' => '\App\Controllers\AcademicYears', 'filter' => 'session']);

$routes->get('semesters/(:any)/activate', '\App\Controllers\Semesters::activate/$1');
$routes->get('semesters/(:any)/deactivate', '\App\Controllers\Semesters::deactivate/$1');
$routes->resource('semesters', ['controller' => '\App\Controllers\Semesters', 'filter' => 'session']);

$routes->resource('students', ['controller' => '\App\Controllers\Students', 'filter' => 'session']);
$routes->resource('teachers', ['controller' => '\App\Controllers\Teachers', 'filter' => 'session']);

$routes->resource('educations', ['controller' => '\App\Controllers\Educations', 'filter' => 'session']);
$routes->resource('classes', ['controller' => '\App\Controllers\Classes', 'filter' => 'session']);
$routes->resource('subjects', ['controller' => '\App\Controllers\Subjects', 'filter' => 'session']);

service('auth')->routes($routes);
