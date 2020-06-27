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

use Illuminate\Support\Facades\Auth;
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/register/service-provider', 'Auth\RegisterController@registerServiceProviderForm');
Route::post('/register/service-provider', 'Auth\RegisterController@registerServiceProvider');

Route::group(['middleware' => 'check-complete-profile' ] , function(){
    Route::get('/', 'PagesController@home');
    Route::get('/service-providers/{service}', 'PagesController@serviceProviderByService');
    Route::get('/service-providers/{city}/{service}', 'PagesController@serviceProviders');
    Route::get('/profile/{serviceProvider}', 'PagesController@serviceProviderProfile')->name('service-provider.profile');
});

Route::middleware('auth')->group(function(){
    Route::get('/orders', 'OrdersController@index');
});


// service provider routes
Route::middleware(['auth', 'user-type:service-provider'])->group(function(){
    Route::get('/complete-profile/step2', 'PagesController@completeProfileStep2');
    Route::post('/complete-profile/step2', 'ServiceProviders\ProfileController@completeProfile');

    Route::get('/complete-profile/step3', 'PagesController@completeProfileStep3');
    Route::get('/subscribe/{package}', 'SubscriptionController@subscribe');

    Route::post('/givequote/project/{project}', 'QuoteController@giveQuote')->name('give-quote');
});


// customer routes
Route::middleware('auth')->middleware('user-type:customer')->group(function(){
    Route::get('/project/c/{}', 'ProjectsController@showForCustomer');
    Route::post('/create-project', 'ProjectsController@create');
    Route::post('/requestquote/{provider}/{project}', 'QuoteController@requestQuote')->name('request-quote');
    Route::post('/create-project/requestquote/{provider}', 'QuoteController@createProjectRequestQuote');

    Route::post('/orders/{quote}', 'OrdersController@orderQuote')->name('order-quote');

    Route::get('/orders/{Order}' , 'OrdersController@show');
    Route::post('/orders/{order}/mark-complete', 'OrdersController@markComplete');
});


// api routes
// complete profile
Route::prefix('/api')->group(function(){
    // cities
    Route::get('/cities', 'CitiesController@index');
    //services
    Route::get('/services/search', 'ServicesController@search');
    Route::get('/service/{service}/questions', 'ServicesController@showQuestions');
    
    // service providers
    Route::get('/service-providers/{city}/{service}', 'ServiceProviders\ServiceProvidersController@search');
    
    // reviews
    Route::get('/reviews/{serviceProvider}', 'ReviewsController@index');

    // projects
    Route::get('/projects/{project}', 'ProjectsController@show');

    // quotes
    Route::get('/quotes/{quote}', 'QuoteController@show');


    // notifications
    Route::get('/notifications/markasread/{notification}', 'NotificationsController@markAsRead');
});
