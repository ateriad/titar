<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Advertisement;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;

Route::get('/t', function() {
    Storage::disk('fs1')->put('something.txt', 'conetne...');
});

Route::get('/', [
    'uses' => 'Front\Videos\HomeController@show',
    'as' => 'home',
]);
Route::get('/search', [
    'uses' => 'Front\SearchController@show',
    'as' => 'search.show',
]);
Route::get('/terms', [
    'uses' => 'Front\TermsController@show',
    'as' => 'terms.show',
]);
Route::get('/about', [
    'uses' => 'Front\AboutController@show',
    'as' => 'about.show',
]);
Route::get('/contact', [
    'uses' => 'Front\ContactController@show',
    'as' => 'contact.show',
]);
Route::post('/contact', [
    'uses' => 'Front\ContactController@store',
    'as' => 'contact.store',
]);
Route::post('/newsletter', [
    'uses' => 'Front\NewsletterController@store',
    'as' => 'newsletter.store',
]);
Route::get('/application', [
    'uses' => 'Front\ApplicationController@show',
    'as' => 'application.show',
]);
Route::post('/account/wallet/callback/fcp', [
    'uses' => 'Front\Account\WalletController@callbackFcp',
    'as' => 'account.wallet.callback.fcp',
]);
Route::get('/account/profile/update/email/verify/{token}', [
    'uses' => 'Front\Account\ProfileController@verifyEmail',
    'as' => 'account.profile.email.verify',
]);
// Videos
Route::group(['prefix' => '/videos'], function () {
    Route::get('/videos/categories/{category}', [
        'uses' => 'Front\Videos\CategoriesController@show',
        'as' => 'videos.categories.show',
    ]);
    Route::get('/videos/{video}/preview', [
        'uses' => 'Front\Videos\VideosController@preview',
        'as' => 'videos.preview',
    ]);
});
// Images
Route::group(['prefix' => '/images'], function () {
    Route::get('/images/categories/{category}', [
        'uses' => 'Front\Images\CategoriesController@show',
        'as' => 'images.categories.show',
    ]);
    Route::get('/images/{image}/preview', [
        'uses' => 'Front\Images\ImagesController@preview',
        'as' => 'images.preview',
    ]);
});
// Events
Route::group(['prefix' => '/events'], function () {
    Route::get('/events/categories/{category}', [
        'uses' => 'Front\Events\CategoriesController@show',
        'as' => 'events.categories.show',
    ]);
    Route::get('/events/{event}/preview', [
        'uses' => 'Front\Events\EventsController@preview',
        'as' => 'events.preview',
    ]);
});

// Auth
Route::group(['prefix' => '/auth'], function () {
    Route::get('/sign-in', [
        'uses' => 'Auth\SignInController@show',
        'as' => 'auth.sign-in',
    ]);
    Route::post('/sign-in', [
        'uses' => 'Auth\SignInController@request',
    ]);
    Route::get('/sign-out', [
        'uses' => 'Auth\SignOutController@handle',
        'as' => 'auth.sign-out',
    ]);
    Route::get('/otp', [
        'uses' => 'Auth\OtpController@show',
        'as' => 'auth.otp.show',
    ]);
    Route::post('/otp/submit', [
        'uses' => 'Auth\OtpController@submit',
        'as' => 'auth.otp.submit',
    ]);
});

Route::group(['middleware' => 'auth'], function () {
    // Account
    Route::group(['prefix' => '/account'], function () {
        Route::get('/', [
            'uses' => 'Front\Account\HomeController@show',
            'as' => 'account.home',
        ]);
        Route::get('/subscriptions', [
            'uses' => 'Front\Account\SubscriptionsController@show',
            'as' => 'account.subscriptions',
        ]);
        Route::post('/subscriptions/purchase', [
            'uses' => 'Front\Account\SubscriptionsController@purchase',
            'as' => 'account.subscriptions.purchase',
        ]);
        Route::get('/wallet', [
            'uses' => 'Front\Account\WalletController@show',
            'as' => 'account.wallet',
        ]);
        Route::get('/wallet/invoice/fcp', [
            'uses' => 'Front\Account\WalletController@invoiceFcp',
            'as' => 'account.wallet.invoice.fcp',
        ]);
        Route::get('/profile', [
            'uses' => 'Front\Account\ProfileController@profile',
            'as' => 'account.profile',
        ]);
        Route::patch('/profile/update/basics', [
            'uses' => 'Front\Account\ProfileController@updateBasics',
            'as' => 'account.profile.basics.update',
        ]);
        Route::patch('/profile/update/email', [
            'uses' => 'Front\Account\ProfileController@updateEmail',
            'as' => 'account.profile.email.update',
        ]);
        Route::patch('/profile/update/cellphone', [
            'uses' => 'Front\Account\ProfileController@updateCellphone',
            'as' => 'account.profile.cellphone.update',
        ]);
        Route::get('/profile/update/cellphone/verify', [
            'uses' => 'Front\Account\ProfileController@verifyCellphone',
            'as' => 'account.profile.cellphone.verify',
        ]);
        Route::patch('/profile/update/cellphone/verify/submit/', [
            'uses' => 'Front\Account\ProfileController@submitVerifyCellphone',
            'as' => 'account.profile.cellphone.verify.submit',
        ]);
    });

    // Videos
    Route::group(['prefix' => '/videos'], function () {
        Route::get('/{video}/play', [
            'uses' => 'Front\Videos\VideosController@show',
            'as' => 'videos.show',
        ]);
        Route::post('/{video}/reactions', [
            'uses' => 'Front\Videos\VideosController@react',
            'as' => 'videos.reactions',
        ]);
        Route::post('/{video}/comments', [
            'uses' => 'Front\Videos\VideosController@comment',
            'as' => 'videos.comments',
        ]);
    });

    // Images
    Route::group(['prefix' => '/images'], function () {
        Route::get('/{image}/play', [
            'uses' => 'Front\Images\ImagesController@show',
            'as' => 'images.show',
        ]);
        Route::post('/{image}/reactions', [
            'uses' => 'Front\Images\ImagesController@react',
            'as' => 'images.reactions',
        ]);
        Route::post('/{image}/comments', [
            'uses' => 'Front\Images\ImagesController@comment',
            'as' => 'images.comments',
        ]);
    });

    // Events
    Route::group(['prefix' => '/events'], function () {
        Route::get('/{event}/play', [
            'uses' => 'Front\Events\EventsController@show',
            'as' => 'events.show',
        ]);
        Route::post('/{event}/reactions', [
            'uses' => 'Front\Events\EventsController@react',
            'as' => 'events.reactions',
        ]);
        Route::post('/{event}/comments', [
            'uses' => 'Front\Events\EventsController@comment',
            'as' => 'events.comments',
        ]);
    });

    // Admin
    Route::group(['prefix' => '/admin', 'middleware' => 'auth.admin'], function () {
        // Dashboard
        Route::get('/', [
            'uses' => 'Admin\DashboardController@show',
            'as' => 'admin.dashboard',
        ]);

        // Videos
        Route::group(['prefix' => '/videos'], function () {
            Route::get('/', [
                'uses' => 'Admin\Videos\VideosController@index',
                'as' => 'admin.videos.index',
                'middleware' => 'can:index,' . Video::class,
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Videos\VideosController@create',
                'as' => 'admin.videos.create',
                'middleware' => 'can:create,' . Video::class,
            ]);
            Route::post('/', [
                'uses' => 'Admin\Videos\VideosController@store',
                'as' => 'admin.videos.store',
                'middleware' => 'can:create,' . Video::class,
            ]);
            Route::get('/{video}/edit', [
                'uses' => 'Admin\Videos\VideosController@edit',
                'as' => 'admin.videos.edit',
                'middleware' => 'can:update,video',
            ]);
            Route::put('/{video}', [
                'uses' => 'Admin\Videos\VideosController@update',
                'as' => 'admin.videos.update',
                'middleware' => 'can:update,video',
            ]);
            Route::delete('/{video}', [
                'uses' => 'Admin\Videos\VideosController@destroy',
                'as' => 'admin.videos.destroy',
                'middleware' => 'can:delete,video',
            ]);
        });

        // Videos/Categories
        Route::group(['prefix' => '/videos/categories'], function () {
            Route::get('/', [
                'uses' => 'Admin\Videos\CategoriesController@index',
                'as' => 'admin.videos.categories.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Videos\CategoriesController@create',
                'as' => 'admin.videos.categories.create',
                'middleware' => 'can:super-admin',
            ]);
            Route::post('/', [
                'uses' => 'Admin\Videos\CategoriesController@store',
                'as' => 'admin.videos.categories.store',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/{category}/edit', [
                'uses' => 'Admin\Videos\CategoriesController@edit',
                'as' => 'admin.videos.categories.edit',
                'middleware' => 'can:super-admin',
            ]);
            Route::put('/{category}', [
                'uses' => 'Admin\Videos\CategoriesController@update',
                'as' => 'admin.videos.categories.update',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{category}', [
                'uses' => 'Admin\Videos\CategoriesController@destroy',
                'as' => 'admin.videos.categories.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Images
        Route::group(['prefix' => '/images'], function () {
            Route::get('/', [
                'uses' => 'Admin\Images\ImagesController@index',
                'as' => 'admin.images.index',
                'middleware' => 'can:index,' . Image::class,
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Images\ImagesController@create',
                'as' => 'admin.images.create',
                'middleware' => 'can:create,' . Image::class,
            ]);
            Route::post('/', [
                'uses' => 'Admin\Images\ImagesController@store',
                'as' => 'admin.images.store',
                'middleware' => 'can:create,' . Image::class,
            ]);
            Route::get('/{image}/edit', [
                'uses' => 'Admin\Images\ImagesController@edit',
                'as' => 'admin.images.edit',
                'middleware' => 'can:update,image',
            ]);
            Route::put('/{image}', [
                'uses' => 'Admin\Images\ImagesController@update',
                'as' => 'admin.images.update',
                'middleware' => 'can:update,image',
            ]);
            Route::delete('/{image}', [
                'uses' => 'Admin\Images\ImagesController@destroy',
                'as' => 'admin.images.destroy',
                'middleware' => 'can:delete,image',
            ]);
        });

        // Images/Categories
        Route::group(['prefix' => '/images/categories'], function () {
            Route::get('/', [
                'uses' => 'Admin\Images\CategoriesController@index',
                'as' => 'admin.images.categories.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Images\CategoriesController@create',
                'as' => 'admin.images.categories.create',
                'middleware' => 'can:super-admin',
            ]);
            Route::post('/', [
                'uses' => 'Admin\Images\CategoriesController@store',
                'as' => 'admin.images.categories.store',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/{category}/edit', [
                'uses' => 'Admin\Images\CategoriesController@edit',
                'as' => 'admin.images.categories.edit',
                'middleware' => 'can:super-admin',
            ]);
            Route::put('/{category}', [
                'uses' => 'Admin\Images\CategoriesController@update',
                'as' => 'admin.images.categories.update',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{category}', [
                'uses' => 'Admin\Images\CategoriesController@destroy',
                'as' => 'admin.images.categories.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Events
        Route::group(['prefix' => '/events'], function () {
            Route::get('/', [
                'uses' => 'Admin\Events\EventsController@index',
                'as' => 'admin.events.index',
                'middleware' => 'can:index,' . \App\Models\Event::class,
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Events\EventsController@create',
                'as' => 'admin.events.create',
                'middleware' => 'can:create,' . \App\Models\Event::class,
            ]);
            Route::post('/', [
                'uses' => 'Admin\Events\EventsController@store',
                'as' => 'admin.events.store',
                'middleware' => 'can:create,' . \App\Models\Event::class,
            ]);
            Route::get('/{event}/edit', [
                'uses' => 'Admin\Events\EventsController@edit',
                'as' => 'admin.events.edit',
                'middleware' => 'can:update,event',
            ]);
            Route::put('/{event}', [
                'uses' => 'Admin\Events\EventsController@update',
                'as' => 'admin.events.update',
                'middleware' => 'can:update,event',
            ]);
            Route::delete('/{event}', [
                'uses' => 'Admin\Events\EventsController@destroy',
                'as' => 'admin.events.destroy',
                'middleware' => 'can:delete,event',
            ]);
        });

        // Events/Categories
        Route::group(['prefix' => '/events/categories'], function () {
            Route::get('/', [
                'uses' => 'Admin\Events\CategoriesController@index',
                'as' => 'admin.events.categories.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/create', [
                'uses' => 'Admin\Events\CategoriesController@create',
                'as' => 'admin.events.categories.create',
                'middleware' => 'can:super-admin',
            ]);
            Route::post('/', [
                'uses' => 'Admin\Events\CategoriesController@store',
                'as' => 'admin.events.categories.store',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/{category}/edit', [
                'uses' => 'Admin\Events\CategoriesController@edit',
                'as' => 'admin.events.categories.edit',
                'middleware' => 'can:super-admin',
            ]);
            Route::put('/{category}', [
                'uses' => 'Admin\Events\CategoriesController@update',
                'as' => 'admin.events.categories.update',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{category}', [
                'uses' => 'Admin\Events\CategoriesController@destroy',
                'as' => 'admin.events.categories.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Comments
        Route::group(['prefix' => '/comments'], function () {
            Route::get('/', [
                'uses' => 'Admin\CommentsController@index',
                'as' => 'admin.comments.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::patch('/{comment}/accept', [
                'uses' => 'Admin\CommentsController@accept',
                'as' => 'admin.comments.accept',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{comment}', [
                'uses' => 'Admin\CommentsController@destroy',
                'as' => 'admin.comments.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Slides
        Route::group(['prefix' => '/slides'], function () {
            Route::get('/', [
                'uses' => 'Admin\SlidesController@index',
                'as' => 'admin.slides.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/create', [
                'uses' => 'Admin\SlidesController@create',
                'as' => 'admin.slides.create',
                'middleware' => 'can:super-admin',
            ]);
            Route::post('/', [
                'uses' => 'Admin\SlidesController@store',
                'as' => 'admin.slides.store',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/{slide}/edit', [
                'uses' => 'Admin\SlidesController@edit',
                'as' => 'admin.slides.edit',
                'middleware' => 'can:super-admin',
            ]);
            Route::put('/{slide}', [
                'uses' => 'Admin\SlidesController@update',
                'as' => 'admin.slides.update',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{slide}', [
                'uses' => 'Admin\SlidesController@destroy',
                'as' => 'admin.slides.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Users
        Route::group(['prefix' => '/users'], function () {
            Route::get('/', [
                'uses' => 'Admin\UsersController@index',
                'as' => 'admin.users.index',
                'middleware' => 'can:index,' . User::class,
            ]);
            Route::get('/create', [
                'uses' => 'Admin\UsersController@create',
                'as' => 'admin.users.create',
                'middleware' => 'can:create,' . User::class,
            ]);
            Route::post('/', [
                'uses' => 'Admin\UsersController@store',
                'as' => 'admin.users.store',
                'middleware' => 'can:create,' . User::class,
            ]);
            Route::get('/{user}/edit', [
                'uses' => 'Admin\UsersController@edit',
                'as' => 'admin.users.edit',
                'middleware' => 'can:update,user',
            ]);
            Route::put('/{user}', [
                'uses' => 'Admin\UsersController@update',
                'as' => 'admin.users.update',
                'middleware' => 'can:update,user',
            ]);
            Route::delete('/{user}', [
                'uses' => 'Admin\UsersController@destroy',
                'as' => 'admin.users.destroy',
                'middleware' => 'can:delete,user',
            ]);
        });

        // Roles
        Route::group(['prefix' => '/roles'], function () {
            Route::get('/', [
                'uses' => 'Admin\RolesController@index',
                'as' => 'admin.roles.index',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/create', [
                'uses' => 'Admin\RolesController@create',
                'as' => 'admin.roles.create',
                'middleware' => 'can:super-admin',
            ]);
            Route::post('/', [
                'uses' => 'Admin\RolesController@store',
                'as' => 'admin.roles.store',
                'middleware' => 'can:super-admin',
            ]);
            Route::get('/{role}/edit', [
                'uses' => 'Admin\RolesController@edit',
                'as' => 'admin.roles.edit',
                'middleware' => 'can:super-admin',
            ]);
            Route::put('/{role}', [
                'uses' => 'Admin\RolesController@update',
                'as' => 'admin.roles.update',
                'middleware' => 'can:super-admin',
            ]);
            Route::delete('/{role}', [
                'uses' => 'Admin\RolesController@destroy',
                'as' => 'admin.roles.destroy',
                'middleware' => 'can:super-admin',
            ]);
        });

        // Charts
        Route::group(['prefix' => '/charts' , 'middleware' => 'can:indexReport'], function () {
            Route::get('/', [
                'uses' => 'Admin\ChartsController@index',
                'as' => 'admin.charts.index',
            ]);
            Route::get('/videos/visits', [
                'uses' => 'Admin\ChartsController@showVideosVisits',
                'as' => 'admin.charts.videos.visits',
            ]);
            Route::get('/events/visits', [
                'uses' => 'Admin\ChartsController@showEventsVisits',
                'as' => 'admin.charts.events.visits',
            ]);
            Route::get('/advertisement/visits', [
                'uses' => 'Admin\ChartsController@showAdvertisementsVisits',
                'as' => 'admin.charts.advertisements.visits',
            ]);
            Route::get('/source', [
                'uses' => 'Admin\ChartsController@showSource',
                'as' => 'admin.charts.source',
            ]);
            Route::get('/users/sign-up', [
                'uses' => 'Admin\ChartsController@showUsersSignUp',
                'as' => 'admin.charts.users.sign-up',
            ]);
            Route::get('/users/sign-in', [
                'uses' => 'Admin\ChartsController@showUsersSignIn',
                'as' => 'admin.charts.users.sign-in',
            ]);
        });

        // Reports
        Route::group(['prefix' => '/reports', 'middleware' => 'can:indexReport'], function () {
            Route::get('/videos/popular', [
                'uses' => 'Admin\ReportsController@showPopularVideos',
                'as' => 'admin.reports.videos.popular',
            ]);
        });

        // Advertisements
        Route::group(['prefix' => '/advertisements'], function () {
            Route::get('/', [
                'uses' => 'Admin\AdvertisementsController@index',
                'as' => 'admin.advertisements.index',
                'middleware' => 'can:index,' . Advertisement::class,
            ]);
            Route::get('/create', [
                'uses' => 'Admin\AdvertisementsController@create',
                'as' => 'admin.advertisements.create',
                'middleware' => 'can:create,' . Advertisement::class,
            ]);
            Route::post('/', [
                'uses' => 'Admin\AdvertisementsController@store',
                'as' => 'admin.advertisements.store',
                'middleware' => 'can:create,' . Advertisement::class,
            ]);
            Route::get('/{advertisement}/edit', [
                'uses' => 'Admin\AdvertisementsController@edit',
                'as' => 'admin.advertisements.edit',
                'middleware' => 'can:update,advertisement',
            ]);
            Route::put('/{advertisement}', [
                'uses' => 'Admin\AdvertisementsController@update',
                'as' => 'admin.advertisements.update',
                'middleware' => 'can:update,advertisement',
            ]);
            Route::delete('/{advertisement}', [
                'uses' => 'Admin\AdvertisementsController@destroy',
                'as' => 'admin.advertisements.destroy',
                'middleware' => 'can:delete,advertisement',
            ]);
        });

        // Payments
        Route::group(['prefix' => '/payments'], function () {
            Route::get('/', [
                'uses' => 'Admin\PaymentsController@index',
                'as' => 'admin.payments.index',
                'middleware' => 'can:indexPayment',
            ]);
        });

        // Logs
        Route::group(['prefix' => '/logs'], function () {
            Route::get('/', [
                'uses' => 'Admin\LogsController@index',
                'as' => 'admin.logs.index',
                'middleware' => 'can:indexLogs',
            ]);
        });

        //Upload
        Route::group(['prefix' => '/upload'], function () {
            Route::post('/upload', [
                'uses' => 'Admin\UploadsController@index',
                'as' => 'admin.uploads.index',
/*                'middleware' => 'can:create,' . Advertisement::class,*/
            ]);
        });

    });
});
