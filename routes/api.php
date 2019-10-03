<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'auth'], function ($api) {
        $api->POST('login',  'App\Http\Controllers\Api\Auth@login');
    });
    $api->GET('me',  'App\Http\Controllers\Api\Auth@me');
});
