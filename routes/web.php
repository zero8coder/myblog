<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/categories/{category}/articles/{article}', 'ArticlesController@showWithCategory')->name('articles.showWithCategory');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');


Route::get('/admin/login', 'Admin\SessionsController@create')->name('admin.login');
Route::post('/admin/login', 'Admin\SessionsController@store')->name('admin.login');
Route::get('/admin/index', 'Admin\ArticlesController@index')->name('admin.index');

Route::resource('/admin/articles', 'Admin\ArticlesController', [ 'except' => 'show' ])
    ->names([
        'create'  => 'admin.articles.create',
        'index'   => 'admin.articles.index',
        'destroy' => 'admin.articles.destroy',
        'edit'    => 'admin.articles.edit',
        'store'   => 'admin.articles.store',
        'update'  => 'admin.articles.update',
    ]);
Route::post('upload_image', 'Admin\ArticlesController@uploadImage')->name('articles.upload_image');


Route::resource('/admin/categories', 'Admin\CategoriesController', [ 'except' => 'show' ])
    ->names([
        'create'  => 'admin.categories.create',
        'index'   => 'admin.categories.index',
        'destroy' => 'admin.categories.destroy',
        'edit'    => 'admin.categories.edit',
        'store'   => 'admin.categories.store',
        'update'  => 'admin.categories.update',
    ]);

