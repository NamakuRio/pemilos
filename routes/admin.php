<?php

Route::get('/', 'DashboardController@index')->name('admin.dashboard');

Route::group(['prefix' => 'calculation'], function () {
    Route::get('/', 'Calculation@index')->name('admin.calculation.index');
    Route::post('/getCalculation', 'Calculation@getCalculation')->name('admin.index.get.calculation');
});

Route::group(['prefix' => 'candidate'], function () {
    Route::get('/', 'Candidate@index')->name('admin.candidate.index');
    Route::post('/getCandidate', 'Candidate@getCandidate')->name('admin.index.get.candidate');
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'User@index')->name('admin.user.index');
    Route::post('/getUser', 'User@getUser')->name('admin.index.get.user');
});
