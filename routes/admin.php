<?php

Route::get('/', 'DashboardController@index')->name('admin.dashboard');

Route::group(['prefix' => 'calculation'], function () {
    Route::get('/', 'Calculation@index')->name('admin.calculation.index');
    Route::post('/getCalculation', 'Calculation@getCalculation')->name('admin.get.calculation');
});

Route::group(['prefix' => 'candidate'], function () {
    Route::get('/', 'Candidate@index')->name('admin.candidate.index');
    Route::post('/', 'Candidate@store')->name('admin.candidate.store');
    Route::get('/create', 'Candidate@create')->name('admin.candidate.create');
    Route::put('/', 'Candidate@update')->name('admin.candidate.update');
    Route::get('/edit/{candidate}', 'Candidate@edit')->name('admin.candidate.edit');
    Route::delete('/', 'Candidate@destroy')->name('admin.candidate.destroy');

    Route::get('/getCandidate', 'Candidate@getCandidate')->name('admin.get.candidate');
    Route::post('/getCandidate/visi', 'Candidate@getDetailCandidate')->name('admin.get.candidate.visi');
    Route::post('/getCandidate/misi', 'Candidate@getDetailCandidate')->name('admin.get.candidate.misi');
    Route::post('/getCandidate/ketua', 'Candidate@getDetailCandidate')->name('admin.get.candidate.ketua');
    Route::post('/getCandidate/wakil', 'Candidate@getDetailCandidate')->name('admin.get.candidate.wakil');

});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'User@index')->name('admin.user.index');
    Route::post('/', 'User@store')->name('admin.user.store');
    Route::get('/create', 'User@create')->name('admin.user.create');
    Route::put('/', 'User@update')->name('admin.user.update');
    Route::get('/edit/{user}', 'User@edit')->name('admin.user.edit');
    Route::delete('/', 'User@destroy')->name('admin.user.destroy');

    Route::get('/getUser', 'User@getUser')->name('admin.get.user');
    Route::post('/get/code', 'User@getCode')->name('admin.get.user.code');
});
