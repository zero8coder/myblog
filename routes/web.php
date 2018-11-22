<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/categories/{category}/articles/{article}', 'ArticlesController@showWithCategory')->name('articles.showWithCategory');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');


Route::get('/admin/login', 'Admin\SessionsController@create')->name('admin.login');
Route::post('/admin/login', 'Admin\SessionsController@store')->name('admin.login');
Route::get('/admin/index', 'Admin\ArticlesController@index')->name('admin.index');

Route::get('/admin/articles', 'Admin\ArticlesController@index')->name('admin.articles.index');
Route::delete('/admin/articles/{article}', 'Admin\ArticlesController@destroy')->name('admin.articles.destroy');
Route::get('/admin/articles/{article}/edit', 'Admin\ArticlesController@edit')->name('admin.articles.edit');
Route::get('/admin/articles/create', 'Admin\ArticlesController@create')->name('admin.articles.create');
Route::post('/admin/articles', 'Admin\ArticlesController@store')->name('admin.articles.store');
Route::patch('/admin/articles/{article}', 'Admin\ArticlesController@update')->name('admin.articles.update');