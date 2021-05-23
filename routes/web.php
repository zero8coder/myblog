<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/categories', 'ArticlesController@index')->name('categories');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::post('/articles/{article}/replies', 'RepliesController@store')->name('reply.store');
Route::get('/categories/{category}/articles/{article}', 'ArticlesController@showWithCategory')->name('articles.showWithCategory');


Route::group(['namespace' => 'Admin', 'prefix' => env('ADMIN_PREFIX')], function() {

    Route::get('login', 'SessionsController@create')->name('login');
    Route::post('login', 'SessionsController@store')->name('admin.login');
    Route::get('logout', 'SessionsController@destroy')->name('logout');

    Route::get('index', 'ArticlesController@index')->name('admin.index');
    Route::get('/', 'ArticlesController@index')->name('admin');

    Route::resource('articles', 'ArticlesController', [ 'except' => 'show' ])
    ->names([
        'create'  => 'admin.articles.create',
        'index'   => 'admin.articles.index',
        'destroy' => 'admin.articles.destroy',
        'edit'    => 'admin.articles.edit',
        'store'   => 'admin.articles.store',
        'update'  => 'admin.articles.update',
    ]);
    Route::post('upload_image', 'ArticlesController@uploadImage')->name('admin.articles.upload_image');
    Route::get('articles/{article}/replies', 'ArticlesController@replies')->name('admin.articles.replies');

    Route::resource('categories', 'CategoriesController', [ 'except' => 'show' ])
    ->names([
        'create'  => 'admin.categories.create',
        'index'   => 'admin.categories.index',
        'destroy' => 'admin.categories.destroy',
        'edit'    => 'admin.categories.edit',
        'store'   => 'admin.categories.store',
        'update'  => 'admin.categories.update',
    ]);

     Route::resource('replies', 'RepliesController')
    ->names([
        'index'   => 'admin.replies.index',
        'show'    => 'admin.replies.show',
        'destroy' => 'admin.replies.destroy',
    ]);

    Route::get('password', 'PasswordController@edit')->name('admin.password.edit');
    Route::post('password', 'PasswordController@update')->name('admin.password.update');
});