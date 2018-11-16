<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/categories/{category}/articles/{article}', 'ArticlesController@showWithCategory')->name('articles.showWithCategory');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');

Route::get('/admin/login', 'Admin\SessionsController@create')->name('admin.login');
Route::post('/admin/login', 'Admin\SessionsController@store')->name('admin.login');

Route::get('/admin/index', 'Admin\IndexController@index')->name('admin.index');