<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array', 'bindings']
], function($api) {
    // 登录
    $api->post('authorizations', 'AuthorizationsController@store')
        ->name('api.authorizations.store');

    // 刷新token
    $api->put('authorizations/current', 'AuthorizationsController@update')
        ->name('api.authorizations.update');

    // 删除token
    $api->delete('authorizations/current', 'AuthorizationsController@destroy')
        ->name('api.authorizations.destroy');

    // 分类列表
    $api->get('categories', 'CategoriesController@index')
        ->name('api.categories.index');

    // 文章列表
    $api->get('articles', 'ArticlesController@index')
        ->name('api.articles.index');

    // 文章详情
    $api->get('articles/{article}', 'ArticlesController@show')
        ->name('api.articles.show');

    // 需要 token 验证的接口
    $api->group(['middleware' => 'api.auth'], function($api) {

        // 图片资源
        $api->post('images', 'ImagesController@store')
            ->name('api.images.store');

        // 写文章
        $api->post('articles', 'ArticlesController@store')
            ->name('api.articles.store');

        // 修改文章
        $api->patch('articles/{article}', 'ArticlesController@update')
            ->name('api.articles.update');

        // 删除文章
        $api->delete('articles/{article}', 'ArticlesController@destroy')
            ->name('api.article.destroy');
    });
});
