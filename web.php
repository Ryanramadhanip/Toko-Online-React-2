<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return str_random(40);
});
// $router->get('/siswa','SiswaController@get');
// $router->post('/siswa','SiswaController@find');
// $router->post('/siswa/save','SiswaController@save');
// $router->delete('/siswa/drop/{id_siswa}','SiswaController@drop');

// $router->get('/pelanggaran','PelanggaranController@get');
// $router->post('/pelanggaran','PelanggaranController@find');
// $router->post('/pelanggaran/save','PelanggaranController@save');
// $router->delete('/pelanggaran/drop/{id_siswa}','PelanggaranController@drop');

// $router->get('/user','UserController@get');
// $router->post('/user','UserController@find');
// $router->post('/user/save','UserController@save');
// $router->delete('/user/drop/{id_user}','UserController@drop');
// $router->post("/user/auth", "UserController@auth");

// $router->get('/pelanggaran_siswa','PelanggaranSiswaController@get');
// $router->post('/pelanggaran_siswa/save','PelanggaranSiswaController@save');
// $router->delete('/pelanggaran_siswa/drop/{id_siswa}','PelanggaranSiswaController@drop');

$router->get('/product','ProductController@get');
$router->post('/product','ProductController@find');
$router->post('/product/save','ProductController@save');
$router->delete('/product/drop/{id}','ProductController@drop');

$router->get('/user','UserController@get');
$router->get('/user/{id}','UserController@getById');
$router->post('/user','UserController@find');
$router->post('/user/save','UserController@save');
$router->delete('/user/drop/{id_user}','UserController@drop');
$router->post("/user/auth", "UserController@auth");
$router->post('/user/save_profil','UserController@save_profil');
$router->post('register','UserController@register');

$router->get('/address/{id_user}','DataPengirimanController@get');
$router->post('/address/save','DataPengirimanController@save');
$router->delete('/address/drop/{id_alamat}','DataPengirimanController@drop');

$router->get("/orders", "OrdersController@get");
$router->post('/orders/save','OrdersController@save');
$router->post("/accept/{id_orders}", "OrdersController@accept");
$router->get('/orders/{id_orders}','OrdersController@getById');
$router->post("/decline/{id_orders}", "OrdersController@decline");
