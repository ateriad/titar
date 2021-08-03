<?php

// Public
Route::get('/config/public', 'Api\V1\ConfigController@public');

// Auth
Route::group(['prefix' => '/auth'], function () {
    // OTP
    Route::group(['prefix' => '/otp'], function () {
        Route::post('/request', 'Api\V1\Auth\OtpController@request')->middleware('throttle:2,1');
        Route::post('/submit', 'Api\V1\Auth\OtpController@submit')->middleware('throttle:5,1');
    });
});

Route::group(['middleware' => 'auth.api'], function () {
    // Profile
    Route::group(['prefix' => '/profile'], function () {
        Route::get('/', 'Api\V1\ProfileController@show');
        Route::put('/', 'Api\V1\ProfileController@update');
        Route::post('/cellphone/request', 'Api\V1\ProfileController@updateCellphoneRequest');
        Route::post('/cellphone/submit', 'Api\V1\ProfileController@updateCellphoneSubmit');
        Route::post('/email/request', 'Api\V1\ProfileController@updateEmailRequest');
        Route::post('/email/submit', 'Api\V1\ProfileController@updateEmailSubmit');
    });

    // Videos
    Route::group(['prefix' => '/videos'], function () {
        Route::get('/', 'Api\V1\VideosController@index');
        Route::get('/search', 'Api\V1\VideosController@search');
        Route::get('/{video}', 'Api\V1\VideosController@show');
        Route::get('/categories' , 'Api\V1\Videos\CategoryController@index');
        Route::get('/categories/{category}' , 'Api\V1\Videos\CategoryController@show');
    });

    // Products
    Route::group(['prefix' => '/products'], function () {
        Route::get('/{product}/reactions', 'Api\V1\Products\ReactionsControllers@index');
        Route::post('/{product}/reactions', 'Api\V1\Products\ReactionsControllers@store');
        Route::get('/{product}/comments', 'Api\V1\Products\CommentsController@index');
        Route::post('/{product}/comments', 'Api\V1\Products\CommentsController@store');
        Route::put('/{product}/comments/{comment}', 'Api\V1\Products\CommentsController@update');
    });

    // Slides
    Route::group(['prefix' => '/slides'], function () {
        Route::get('/', 'Api\V1\SlidesController@index');
    });

    //Events
    Route::group(['prefix' => '/events'], function () {
        Route::get('/', 'Api\V1\EventsController@index');
        Route::get('/{event}', 'Api\V1\EventsController@show');
        Route::get('/categories/{category}' , 'Api\V1\Events\CategoryController@show');
        Route::get('/slider', 'Api\V1\Events\SliderController@index');
    });
});


