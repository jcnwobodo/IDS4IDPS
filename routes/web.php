<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//------------ Generic App-Page Routes -----------------------------------------
Route::group(['as'=>'app.','namespace'=>'Pages'], function (){
    Route::get('/',['as'=>'home','uses'=>'HomeController@index']);
});

//------------ Admin Panel Routes ----------------------------------------------
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Pages'], function () {
    Route::get('camps', ['as'=>'camps','uses'=>'AdminController@camps']);
});

//-------------Base Routes-----------------------------------------------------
Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'Base'], function () {
    Route::post('add', ['as' => 'add', 'uses' => 'UserController@add']);
    Route::post('update', ['as' => 'update', 'uses' => 'UserController@update']);
    Route::post('remove', ['as' => 'remove', 'uses' => 'UserController@remove']);
});

Route::group(['as' => 'location.', 'prefix' => 'location', 'namespace' => 'Base'], function () {
    Route::post('add', ['as' => 'add', 'uses' => 'LocationController@add']);
    Route::post('update', ['as' => 'update', 'uses' => 'LocationController@update']);
    Route::post('remove', ['as' => 'remove', 'uses' => 'LocationController@remove']);
});

Route::group(['as' => 'camp.', 'prefix' => 'camp', 'namespace' => 'Base'], function () {
    Route::post('add', ['as' => 'add', 'uses' => 'CampController@add']);
    Route::post('update', ['as' => 'update', 'uses' => 'CampController@update']);
    Route::post('remove', ['as' => 'remove', 'uses' => 'CampController@remove']);
});

Route::group(['as' => 'organization.', 'prefix' => 'organization', 'namespace' => 'Base'], function () {
    Route::post('add', ['as' => 'add', 'uses' => 'OrganizationController@add']);
    Route::post('update', ['as' => 'update', 'uses' => 'OrganizationController@update']);
    Route::post('remove', ['as' => 'remove', 'uses' => 'OrganizationController@remove']);
});

Route::group(['as' => 'idp.', 'prefix' => 'idp', 'namespace' => 'Base'], function () {
    Route::post('add', ['as' => 'add', 'uses' => 'PersonController@add']);
    Route::post('update', ['as' => 'update', 'uses' => 'PersonController@update']);
    Route::post('remove', ['as' => 'remove', 'uses' => 'PersonController@remove']);
});

//-------------Authentication, Registration & Password Reset roues-----------------//
Route::group(['as' => 'auth.', 'namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    // Registration Routes...
    /*
    Route::get('signup', ['as' => 'signup', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('signup', ['as' => 'signup', 'uses' => 'RegisterController@register']);
    */

    // Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.form', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.link', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@reset']);

    // Socialite
    Route::get('auth/{service}/{action}', ['as' => 'social.redirect', 'uses' => 'SocialAuthController@redirectToProvider']);
    Route::get('auth/{service}/{action}/callback', ['as' => 'social.callback', 'uses' => 'SocialAuthController@handleProviderCallback']);
});

//------------ For troubleshooting purposes and  testing purposes --------------
if (config('app.env') === 'local' or config('app.debug')) {
    Route::group(['as' => 'debug.', 'prefix' => 't'], function () {

        Route::get('/routes', [
            'as' => 'routes', 'uses' => function () {
                $data['routes'] = \Route::getRoutes();

                return view('debug.routes', $data);
            }
        ]);

        Route::get('phpinfo', [
            'as' => 'phpinfo', 'uses' => function () {
                phpinfo();
            }
        ]);
    });
}
