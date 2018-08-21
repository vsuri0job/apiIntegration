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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/', function () {
    return view('auth.login');
});

Route::get('demo','WidgetsController@mail');
Route::get('web-widget/{slug}', 'WidgetsController@index');
Route::get('web-widget/{slug}/thank-you', 'WidgetsController@thankyou');
Route::post('web-widget/{slug}/rating', 'WidgetsController@rating');
Route::get('wigets', 'WidgetsController@wigets');

Route::get('register-beta', 'Auth\RegisterController@register_beta'); //TEST ROUTE

Route::get('payment-beta', 'Auth\RegisterController@payment_beta'); //TEST PAYMENT ROUTE
Route::post('payment-beta', 'Auth\RegisterController@payment_beta'); //TEST PAYMENT ROUTE
 
Route::get('reviewwidget/{slug}', 'WidgetsController@reviewwidget');
Route::get('{slug}/reviews', 'SitereviewController@index');
Route::get('web-widget/{slug}/json', 'WidgetsController@json');

Route::get('cron', 'CronController@index');

//Payment
Route::group(['middleware' => 'auth'], function(){
	Route::get('payment', 'PaymentController@index');
	Route::post('setpayment', 'PaymentController@setpayment');
	Route::get('resubscribe', 'PaymentController@resubscribe');
	Route::post('reset_subscription', 'PaymentController@reset_subscription');
});

Route::group(['middleware' => ['auth','active', 'checksubscribed']], function()
{	
	//Users
	Route::get('user', 'UserController@index');
	Route::get('user/edit/{id}', 'UserController@edit');
	Route::post('user/update/{id}', 'UserController@update');
	Route::get('user/delete/{id}', 'UserController@delete');
	Route::get('user/add', 'UserController@add');
	Route::post('insert', 'UserController@insert');
	Route::get('user/active/{id}', 'UserController@active');
	Route::get('user/inactive/{id}', 'UserController@inactive');
	Route::get('user/show/{id}', 'UserController@show');

	//View Profile
	Route::get('viewprofile', 'UserController@viewprofile');
	Route::get('cancelSubscription', 'UserController@cancelSubscription');	
	Route::post('editprofile/{id}', 'UserController@editprofile');
	Route::post('header/{id}', 'UserController@header');
	Route::get('user/widget', 'UserController@widgets');
 
	//settings
	Route::get('settings', 'SettingsController@index');
	Route::post('settings/title', 'SettingsController@title');
	Route::post('settings/headertitle', 'SettingsController@headertitle');
	Route::post('settings/logo', 'SettingsController@logo');

	//Reviews
	Route::get('review/{social?}', 'ReviewController@index');
	Route::post('showreview/','ReviewController@showreview');
	//Customers List
	Route::get('customer', 'ReviewController@customers');
	Route::get('customer/demo', 'ReviewController@demo');
	Route::get('customer/import', 'ReviewController@import');
	Route::post('customer/importdata/', 'ReviewController@importdata');
	Route::get('active/{id}', 'ReviewController@active');
	Route::get('inactive/{id}', 'ReviewController@inactive');
	
	//Manage Review Site
	Route::get('manage_site/mTest', 'ManageSiteController@mTest'); //TEST ROUTE
	Route::get('manage/connect-social-pages', 'ManageSiteController@mTest'); //TEST ROUTE
	
	Route::post('manage/add-facebook-page-manually', 'ManageSiteController@add_facebook_page'); //TEST ROUTE
	Route::post('manage/add-google-page-manually', 'ManageSiteController@add_google_page'); //TEST ROUTE
	Route::post('manage/add-google-page-location', 'ManageSiteController@add_google_location'); //TEST ROUTE
	Route::post('manage/update-google-reviews', 'ManageSiteController@updateGoogleLocationReviews'); //TEST ROUTE
	
	Route::get('manage_site', 'ManageSiteController@index');
	Route::get('login_google', 'ManageSiteController@login_google')->name( 'login_google' );
	Route::get('verify_google', 'ManageSiteController@verify_google')->name( 'verify_google' );
	Route::get('google_business_list', 'ManageSiteController@google_business_list')->name( 'google_blist' );

	Route::get('manage_site/add', 'ManageSiteController@add');
	Route::get('manage_site/add_social_page', 'ManageSiteController@add_social_page'); //TEST ROUTE

	Route::post('manage_site/create', 'ManageSiteController@create');
	Route::post('manage_site/create_social_page', 'ManageSiteController@create_social_page'); //TEST ROUTE

	Route::get('manage_site/show/{id}', 'ManageSiteController@show');
	Route::get('manage_site/edit/{id}', 'ManageSiteController@edit');
	Route::post('manage_site/update/{id}', 'ManageSiteController@update');
	Route::get('manage_site/delete/{id}', 'ManageSiteController@delete');
	Route::get('manage_site/active/{id}', 'ManageSiteController@active');
	Route::get('manage_site/inactive/{id}', 'ManageSiteController@inactive');
	Route::get('facebook', 'ManageSiteController@facebook');
	Route::get('facebook/edit', 'ManageSiteController@facebook_edit');
	
	//Design Email Template
	Route::get('mail', 'EmailController@index');
	Route::post('mail/create', 'EmailController@create');
	Route::get('mail/add', 'EmailController@add');
	Route::get('mail/edit/{id}', 'EmailController@edit');
	Route::post('mail/update/{id}', 'EmailController@update');
	
	//Request Feedback
	Route::get('request-feedback','FeedbackController@index');
	Route::get('list-feedback','FeedbackController@list');
	Route::get('ask-feedback/{smedia}/{rating}','FeedbackController@ask_feedback');
	Route::get('feedback','FeedbackController@feedback');
	Route::post('feedback/send','FeedbackController@send');	
	Route::get('gettemplate/{id}', 'FeedbackController@gettemplate');

	Route::get('facebookReview/{id}', 'ReviewController@reviews');
	Route::get('googlereview', 'ReviewController@googlereview');
	Route::get('yelpreview', 'ReviewController@yelpreview');

	Route::post('yelp-fusion-api', 'ReviewController@yelp_fusion_api');	
	Route::get('send', 'CronController@send');
	Route::get('/home', 'HomeController@index')->name('home');
});
