<?php

Route::get('/', function () {
    return view('templates.master');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'profile'], function () {
   Route::get('/', 'Profile@index')->name('profile.index');
   Route::get('/password-update', 'Profile@editPassword')->name('profile.edit.password');
});

Route::group(['prefix' => 'setting'], function () {
    Route::get('/', 'Setting@index')->name('setting.index');
});
