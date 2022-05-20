<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

require_once('media_routes.php');

use App\Offer;

//use VbService;

Route::pattern('customer', '\d+');
Route::pattern('offer', '\d+');
Route::pattern('record', '\d+');

// Route::get('/', function () {
//     return view('welcome', [
//         'offers' => app('App\Repositories\OffersRepository')->all('online'),
//     ]);
// });


Route::get('instructors', function () {
    return view('auth.login');
});

Route::get('page/{slug}.html', [
    'as' => 'static_page',
    'uses' => 'PagesController@show',
]);

Route::group(['prefix' => 'payment'], function () {
    Route::get('qiwi', [
        'as' => 'qiwi.payment',
        'uses' => 'Payment\QiwiController@process',
    ]);

    Route::post('vb', [
        'as' => 'vb.payment',
        'uses' => 'Payment\VbController@process',
    ]);

    Route::any('success', [
        'as' => 'vb.success',
        'uses' => 'Payment\VbController@success',
    ]);

    Route::any('vb-response', [
        'as' => 'vb.response',
        'uses' => 'Payment\VbController@response',
    ]);
});

// Offer landing page
Route::get('purchase-offer/{offer}', [
    // 'middleware' => 'auth',
    'as' => 'order-offer',
    'uses' => function (Offer $offer) {
        Session::set('offer_id', $offer->id);

        return redirect()->route('customer.signup');
    }]);

Route::get('user/redirect', [
    'middleware' => 'auth',
    'as' => 'user.redirect',
    'uses' => 'MainController@userRedirect',
]);

Route::get('home', [
    'middleware' => 'auth',
    function () {
        return view('customer.search');
    },
]);



Route::get('schedule/{driver}', function ($driver) {
    $data = [];
    for ($hour = 7; $hour <= 21; $hour++) {
        $loadScheduler = app('LoadScheduler')->driver($driver);
        $data["{$hour}:00"] = $loadScheduler->schedule("{$hour}:00");
    }

    return view('schedule', ['hours' => $data]);
});

Route::resource('customer', 'CustomerController', [
    'only' => ['create', 'store', 'edit', 'update', 'show', 'destroy'],
]);

Route::group(['prefix' => 'customer', "middleware" => "auth"], function () {

    Route::post('search', [
        'uses' => 'CustomerController@search',
        'as' => 'customer.search',
    ]);

    Route::get('{customer}/download/{record}', [
        'uses' => 'CustomerController@download',
        'as' => 'customer.history.download',
    ]);

    Route::get('{customer}/history', [
        'uses' => 'CustomerController@history',
        'as' => 'customer.history',
    ]);

    Route::get('{customer}/record/{record?}', [
        'uses' => 'CustomerController@record',
        'as' => 'customer.record.create',
        'middleware' => ['can.edit.record'],
    ]);

    Route::post('{customer}/record/{record?}', [
        'uses' => 'CustomerController@persistRecord',
        'as' => 'customer.record.persist',
    ]);

    Route::post('checkout', [
        'uses' => 'OrdersController@store',
        'as' => 'customer.order.checkout',
    ]);

    Route::get('order/{order}/cancel', [
        'uses' => 'OrdersController@destroy',
        'as' => 'customer.order.cancel',
    ]);

    Route::get('signup', [
        'middleware' => 'auth',
        'as' => 'customer.signup',
        'uses' => 'Auth\AuthController@getRegister',
    ]);

    Route::get('health-testing', [
        'uses' => 'CustomerController@form',
        'as' => 'customer.form',
    ]);

    Route::post('health-testing', [
        'uses' => 'CustomerController@persistForm',
        'as' => 'user.record.persist-form',
    ]);

    Route::get('{customer}/health-testing/{record}/{hash}', [
        'uses' => 'CustomerController@downloadUser',
        'as' => 'customer.history.user-download',
    ]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('register', [
        'as' => 'auth.register',
        'uses' => 'Auth\AuthController@getRegister',
    ]);

    Route::post('token', [
        'uses' => 'EmailConfirmationController@token',
        'as' => 'email.token',
    ]);

    Route::any('confirm', [
        'uses' => 'EmailConfirmationController@confirm',
        'as' => 'email.confirm',
    ]);

    Route::post('register', [
        'uses' => 'Auth\AuthController@postRegister',
        'as' => 'auth.register',
    ]);

    Route::get('login', function () {
        return redirect()->to('/');
    });

    Route::post('login', [
        'as' => 'auth.login',
        'uses' => 'Auth\AuthController@postLogin',
    ]);

    Route::get('logout', [
        'as' => 'auth.logout',
        'uses' => 'Auth\AuthController@getLogout',
    ]);
});

Route::get('/pdf/header.html', function () {
    return view('dompdf.header');
});
