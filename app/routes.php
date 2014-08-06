<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Route to HomePage
 */
Route::get('/', array(
	'as'   => 'home',
	'uses' => 'HomeController@home'
));


/**
 * Route to CookiesPage
 */
Route::get('cookies', array(
	'as'   => 'cookies',
	'uses' => 'HomeController@cookies'
));


/**
 * Content viewable as guest(not logged in)
 */
Route::group(array('before' => 'guest'), function() {

	/**
	 * CSRF protection for Forms
	 */
	Route::group(array('before' => 'csrf'), function() {
		/**
 		 * Route for posting a create form
 		 */
		Route::post('/account/create', array(
			'as'   => 'account-create-post',
			'uses' => 'AccountController@postCreateAccount'
		));
		
		/**
 		 * Route for a forgotten passwordform
 		 */
		Route::post('/account/forgot-password', array(
			'as'   => 'account-forgot-password-post',
			'uses' => 'AccountController@postForgotPassword'
		));

		/**
 		 * Route for a user attempting to sign In
 		 */
		Route::post('/account/sign-in', array(
			'as'   => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));
	});

	/**
 	 * Route for recovering a lost password
 	 */
	Route::get('/account/recover/{code}', array(
		'as'   => 'account-recover',
		'uses' => 'AccountController@getRecoverPassword'
	));
	
	/**
 	 * Route for recovering a lost password
 	 */
	Route::get('/account/forgot-password', array(
		'as'   => 'account-forgot-password',
		'uses' => 'HomeController@getForgotPassword'
	));
	
	/**
 	 * Route for the create account page
 	 */
	Route::get('/account/create', array(
		'as'   => 'account-create',
		'uses' => 'HomeController@getCreateAccount'
	));
	
	/**
 	 * Route for the sign in page
 	 */
	Route::get('/account/sign-in', array(
		'as'   => 'account-sign-in',
		'uses' => 'HomeController@getSignIn'
	));
	
	/**
 	 * Route toget activate code for account
 	 */
	Route::get('/account/activate/{code}', array(
		'as'   => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));
});

/**
 * Content viewable as a signed in user(logged in)
 */
Route::group(array('before' => 'auth'), function(){
	
	/**
 	 * Route for user to sign out
 	 */
	Route::get('/account/sign-out', array(
		'as'   => 'account-sign-out',
		'uses' => 'HomeController@getSignOut'
	));
	
	/**
	 * CSRF protection for Forms
	 */
	Route::group(array('before' => 'csrf'), function() {
		
		/**
	 	 * Route to handle posted data for the edit details form
	 	 */
		Route::post('/account/edit-details', array(
			'as'   => 'account-edit-details-post',
			'uses' => 'MyAccountController@postEditDetails'
		));
	});
	
	/**
	 * Route to the dashboard page
	 */
	Route::get('/account/dashboard', array(
		'as'   => 'account-dashboard',
		'uses' => 'MyAccountController@getAccountDashboard'
	));
	
	/**
	 * Route to edit user details page
	 */
	Route::get('/account/edit-details', array(
		'as'   => 'account-edit-details',
		'uses' => 'MyAccountController@getEditDetails'
	));
	
	
});
