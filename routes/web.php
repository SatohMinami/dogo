<?php

Route::match(['get', 'post'], '/', function () {
    return redirect()->route('auth.login');
});

Route::match(['GET', 'POST'], 'login', 'Admin\AuthController@login')->name('auth.login');
Route::match(['GET', 'POST'], 'create', 'Admin\AuthController@create')->name('auth.create');
Route::match(['GET', 'POST'], 'logout', 'Admin\AuthController@logout')->name('auth.logout');

Route::get('home', 'Admin\HomeController@index')->name('admin.home')->middleware('auth:web');
Route::group(['prefix' => 'product', 'namespace' => 'Admin', 'middleware' => ['auth:web']], function () {
    Route::get('index', 'ProductController@getIndex')->name('admin.product.index');
    Route::get('create', 'ProductController@getCreate')->name('admin.product.create');
    Route::post('create', 'ProductController@postCreate')->name('admin.product.create');
    Route::get('edit', 'ProductController@getEdit')->name('admin.product.edit');
//    Route::post('delete', 'StaffController@postDelete')->name('staff.delete');
//    Route::post('edit', 'StaffController@postEdit')->name('staff.edit');
});

//
//Route::group(['prefix' => 'category', 'namespace' => 'Admin', 'middleware' => ['auth:web']], function () {
//    Route::get('index', 'CategoryController@getIndex')->name('admin.category.index');
//    Route::get('create', 'CategoryController@getCreate')->name('admin.category.create');
//    Route::get('edit', 'CategoryController@getEdit')->name('admin.category.edit');
//    Route::post('create', 'CategoryController@postCreate')->name('admin.category.create');
//    Route::post('delete', 'StaffController@postDelete')->name('staff.delete');
//    Route::post('edit', 'StaffController@postEdit')->name('staff.edit');
//});


//Route::group(['prefix' => 'brand', 'namespace' => 'Admin', 'middleware' => ['auth:web']], function () {
//    Route::get('index', 'BrandController@getIndex')->name('admin.brand.index');
//    Route::get('create', 'BrandController@getCreate')->name('admin.brand.create');
//    Route::get('edit', 'BrandController@getEdit')->name('admin.brand.edit');
//    Route::post('create', 'ShopCategoryController@postCreate')->name('staff.create');
//    Route::post('delete', 'StaffController@postDelete')->name('staff.delete');
//    Route::post('edit', 'StaffController@postEdit')->name('staff.edit');
//});
