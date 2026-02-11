<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::prosesLogin');
$routes->get('logout', 'AuthController::logout');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::store');

$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('pengguna', 'Admin\PenggunaController::index');
    $routes->get('pengguna/create', 'Admin\PenggunaController::create');
    $routes->post('pengguna/store', 'Admin\PenggunaController::store');
    $routes->get('pengguna/edit/(:num)', 'Admin\PenggunaController::edit/$1');
    $routes->post('pengguna/update/(:num)', 'Admin\PenggunaController::update/$1');
    $routes->get('pengguna/delete/(:num)', 'Admin\PenggunaController::delete/$1');

    $routes->get('dudi', 'Admin\DudiController::index');
    $routes->post('dudi/store', 'Admin\DudiController::store');
    $routes->post('dudi/update/(:num)', 'Admin\DudiController::update/$1');
    $routes->get('dudi/delete/(:num)', 'Admin\DudiController::delete/$1');

    $routes->get('pengaturan', 'Admin\PengaturanController::index');
    $routes->post('pengaturan/update/(:num)', 'Admin\PengaturanController::update/$1');
});
$routes->group('guru', function ($routes) {
    $routes->get('dashboard', 'Guru\DashboardController::index');

    $routes->get('dudi', 'Guru\DudiController::index');

    $routes->get('magang', 'Guru\MagangController::index');
    $routes->get('magang/create', 'Guru\MagangController::create');
    $routes->post('magang/store', 'Guru\MagangController::store');
    $routes->get('magang/edit/(:num)', 'Guru\MagangController::edit/$1');
    $routes->post('magang/update/(:num)', 'Guru\MagangController::update/$1');
    $routes->get('magang/delete/(:num)', 'Guru\MagangController::delete/$1');

    $routes->get('jurnal', 'Guru\JurnalController::index');
    $routes->post('jurnal/verifikasi/(:num)', 'Guru\JurnalController::verifikasi/$1');
});
$routes->group('siswa', function ($routes) {
    $routes->get('dashboard', 'Siswa\DashboardController::index');

    $routes->get('dudi', 'Siswa\DudiController::index');
    $routes->get('dudi/detail/(:num)', 'Siswa\DudiController::detail/$1');
    $routes->get('dudi/daftar/(:num)', 'Siswa\DudiController::daftar/$1');

    $routes->get('magang', 'Siswa\MagangController::index');

    $routes->get('jurnal', 'Siswa\JurnalController::index');
    $routes->get('jurnal/create', 'Siswa\JurnalController::create');
    $routes->post('jurnal/store', 'Siswa\JurnalController::store');
    $routes->get('jurnal/edit/(:num)', 'Siswa\JurnalController::edit/$1');
    $routes->post('jurnal/update/(:num)', 'Siswa\JurnalController::update/$1');
    $routes->get('jurnal/delete/(:num)', 'Siswa\JurnalController::delete/$1');
    $routes->get('jurnal/detail/(:num)', 'Siswa\JurnalController::detail/$1');
});
