<?php

Route::get('/', 'ArticlesController@index')->name('index');
Route::get('/articles/{article}', 'ArticlesController@show')->name('articles.show');