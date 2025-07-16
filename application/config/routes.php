<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home'; // Atau controller default Anda
$route['artikel/(:any)'] = 'home/detail/$1';

// --- Routing untuk Otentikasi (AUTH) ---
// Pastikan ini ada jika Anda memiliki halaman login/logout terpisah
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';

// Route khusus untuk ubah password
// Ini akan memetakan URL 'ubah_password' langsung ke Auth controller, method ubah_password
$route['ubah_password'] = 'auth/ubah_password';

// Route umum untuk controller Auth (jika ada method lain di Auth yang diakses dengan slug)
// Jika Anda hanya punya login, logout, ubah_password, ini mungkin tidak terlalu krusial
// Tapi baiknya tetap ada untuk fleksibilitas
$route['auth/(:any)'] = 'auth/$1';

// --- Routing untuk Admin Area ---
// Sesuaikan dengan struktur folder controller Anda
$route['admin'] = 'Admin'; // Mengarah ke Admin controller di root controllers
$route['admin/(:any)'] = 'Admin/$1'; // Untuk method lain di Admin controller

// Jika Kategori_admin.php ada di controllers/admin/
$route['admin/kategori_admin'] = 'admin/Kategori_admin';
$route['admin/kategori_admin/(:any)'] = 'admin/Kategori_admin/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; // Biarkan FALSE kecuali Anda memang menggunakan dash di URI
