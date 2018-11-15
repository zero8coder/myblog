<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');
Route::get('/categories/{category}/articles/{article}', 'ArticlesController@showWithCategory')->name('articles.showWithCategory');
Route::get('/categories/{category}', 'CategoriesController@index')->name('categories.index');