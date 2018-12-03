<?php

use Illuminate\Http\Request;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'serializer:array'
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

    // 需要 token 验证的接口
    $api->group(['middleware' => 'api.auth'], function($api) {

    });
});
