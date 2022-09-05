<?php


/** @var \Laravel\Lumen\Routing\Router $router */

$router->group(['prefix' => 'user'], function () use ($router) {
    $router->post('/v1/register', 'UserController@register');
    $router->post('/v1/login', 'UserController@login');
});

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->group(['prefix' => 'kategoris'], function () use ($router) {
        $router->get('/v1/kategori', 'KategoriController@getKategori');
        $router->post('/v1/kategori', 'KategoriController@postKategori');
    });

    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->post('/v1/product', 'ProductController@postProduct');
        $router->get('/v1/product', 'ProductController@getProduct');
    });

    $router->group(['prefix' => 'export'], function () use ($router) {
        $router->post('/v1/pengiriman', 'PengirimanController@pengiriman');
        $router->get('/v1/pengiriman', 'PengirimanController@getPengiriman');
    });

    $router->group(['prefix' => 'keterangan'], function () use ($router) {
        $router->post('/v1/country', 'WilayahController@postCountry');
        $router->get('/v1/country', 'WilayahController@getCountry');
        $router->post('/v1/city', 'WilayahController@postCity');
        $router->get('/v1/city/{id}', 'WilayahController@getCityById');
        $router->get('/v1/city', 'WilayahController@getCity');
    });

});
