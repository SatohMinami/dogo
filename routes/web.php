<?php

Route::match(['get', 'post'], '/', function () {
    return redirect()->route('auth.login');
});

Route::match(['GET', 'POST'], 'login', 'Admin\AuthController@login')->name('auth.login');
Route::match(['GET', 'POST'], 'create', 'Admin\AuthController@create')->name('auth.create');
Route::match(['GET', 'POST'], 'logout', 'Admin\AuthController@logout')->name('auth.logout');

Route::get('home', 'Admin\HomeController@index')->name('admin.home')->middleware('auth:web');
Route::group(['prefix' => 'product', 'namespace' => 'Admin', 'middleware' => ['auth:web']], function () {
    Route::get('index', 'ProductController@index')->name('admin.product.index');
    Route::get('create', 'ProductController@create')->name('admin.product.create');
    Route::post('create', 'ProductController@store')->name('admin.product.create');
    Route::get('{id}/edit', 'ProductController@edit')->name('admin.product.edit');
    Route::post('update', 'ProductController@update')->name('admin.product.update');
    Route::post('delete/{id}', 'ProductController@destroy')->name('admin.product.delete');
});

