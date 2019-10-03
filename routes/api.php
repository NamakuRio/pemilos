<?php

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@login')->name('api.auth.login');
    Route::get('/me', 'AuthController@me')->name('api.auth.me')->middleware('auth:api');
    // Route::post('/logout', 'Auth@logout')->nalogout('api.auth.me');
});

Route::group([ 'prefix' => 'candidate'], function () {

    Route::get('/getCandidate', 'CandidateController@getCandidate')->name('api.candidate.get');
    Route::post('/your-choice', 'CandidateController@yourChoice')->name('api.candidate.input');

});
