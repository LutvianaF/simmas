<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::prosesLogin');
$routes->post('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::store');

$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');
    $routes->get('pengguna', 'Admin\PenggunaController::index');
    $routes->get('dudi', 'Admin\DudiController::index');
    $routes->get('pengaturan', 'Admin\PengaturanController::index');
});
$routes->group('guru', function ($routes) {
    $routes->get('dashboard', 'Guru\DashboardController::index');
    $routes->get('dudi', 'Guru\DudiController::index');
    $routes->get('magang', 'Guru\MagangController::index');
    $routes->get('jurnal', 'Guru\JurnalController::index');
});
$routes->group('siswa', function ($routes) {
    $routes->get('dashboard', 'Siswa\DashboardController::index');
    $routes->get('dudi', 'Siswa\DudiController::index');
    $routes->get('magang', 'Siswa\MagangController::index');
    $routes->get('jurnal', 'Siswa\JurnalController::index');
});