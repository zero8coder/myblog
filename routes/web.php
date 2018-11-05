<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}/categories/{category?}', 'ArticlesController@show')->name('articles.show');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');