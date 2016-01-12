<?php

Route::group(['middleware' => 'web'], function () {
    Route::resource('articles', 'ArticlesController');
    Route::post('articles/draft', 'ArticlesController@draft');
    Route::post('articles/publish', 'ArticlesController@publish');

    Route::auth();

    Route::get('/dashboard', 'HomeController@dashboard');
    Route::get('/', 'PagesController@homePage');
});
