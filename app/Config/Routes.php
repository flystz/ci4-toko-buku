<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::login', ['filter' => 'dashboard']);
$routes->get('/logout', 'Auth::logout');
$routes->post('/auth/check', 'Auth::user');
$routes->post('/auth/create', 'Auth::createAccount');

// untuk masuk ke dasboard
$routes->get('/dashboard', 'Users::index', ['filter' => 'auth']);

// untuk edit product
$routes->get('/dashboard/edit/(:segment)', 'Users::productEdit/$1', ['filter' => 'auth']);
$routes->post('/admin/update-product', 'Users::updateProduct');


// untuk delete product
$routes->get('/dashboard/delete/(:segment)', 'Users::productDelete/$1');

// untuk menambah produk
$routes->get('/admin/add-product', 'Users::addProduct', ['filter' => 'auth']);
$routes->post('/admin/save-product', 'Users::saveProduct');

// untuk masuk ke create
$routes->get('/user/create/(:segment)', 'Users::create/$1');

// method save create
$routes->post('/user/save', 'Users::save');

// method cetak pdf
$routes->get('/user/cetak', 'Users::cetak');

// untuk masuk detail
$routes->get('/user/detail/(:segment)', 'Users::detail/$1', ['filter' => 'auth']);

//user untuk masuk ke catatan keranjang
$routes->get('/user/histori', 'Users::keranjang', ['filter' => 'auth']);

// pengguna registrasi
$routes->get('/auth/register', 'Auth::register');

// managament superadmin
$routes->get('/superadmin/manage', 'SuperAdmin::index', ['filter' => 'auth']);

// menu untuk me-manage admin / melihat data untuk update
$routes->get('/superadmin/manage-admin', 'SuperAdmin::manage', ['filter' => 'auth']);

// untuk menambahkan admin
$routes->get('/superadmin/add-admin', 'SuperAdmin::create', ['filter' => 'auth']);

// untuk mengedit admin
$routes->get('/superadmin/edit-admin/(:segment)', 'SuperAdmin::editAdmin/$1', ['filter' => 'auth']);

// untuk menjalankan fungsi update
$routes->post('/superadmin/update', 'SuperAdmin::edit');

// untuk menjalankan fungsi tambah
$routes->post('/superadmin/add', 'SuperAdmin::add');

// untuk menjalankan fungsi delete
$routes->get('/superadmin/delete-admin/(:segment)', 'SuperAdmin::deleteAdmin/$1');

// routes untuk pencarian
$routes->post('/product/search', 'Users::search');

// untuk masuk ke halaman kelola office
$routes->get('/superadmin/manage-office', 'SuperAdmin::manageOffice', ['filter' => 'auth']);

// untuk mengedit office
$routes->get('/superadmin/edit-office/(:segment)', 'SuperAdmin::editOffice/$1', ['filter' => 'auth']);

// untuk menjalankan fungsi delete office
$routes->get('/superadmin/delete-office/(:segment)', 'SuperAdmin::deleteOffice/$1');

// update office
$routes->post('/superadmin/update-office', 'SuperAdmin::updateOffice');

// add office
$routes->post('/superadmin/addoffice', 'SuperAdmin::addOffices');

// untuk menambah office
$routes->get('/superadmin/add-office', 'Superadmin::addOffice');





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
