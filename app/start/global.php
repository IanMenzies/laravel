<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/library/helpers'

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

/**
 * Error Log Handler, deals with HTTP codes and notify's admin of any 
 * issues occurring on the site.
 * @param object $exception error occurred
 * @param const  $code (404, 403...etc)
 * @return view error page 
 */
App::error(function(Exception $exception, $code)
{
	$errorMessage = $exception;
	$statusCodes  = array(
		'401' => 'Unauthorized attempted access!',
		'403' => 'Tut Tut! You should not be accessing here!',
		'404' => 'The page requested could not be found!',
		'500' => 'Whoops! Something went wrong, our team has been notified!'
	);

	if (!array_key_exists($code, $statusCodes)) {
		$errorMessage             = $exception . ":: error code ::" . $code;

		// Send an email to me notifying of the error
		$emailParams['error']     = $code;
		$emailParams['exception'] = $exception;
		EmailHelper::sendWebsiteIssueEmail('emails.error.notifyErrors', $emailParams);

		return;
	}
	// Log detailed error message
	Log::error($errorMessage);

	$error["message"] = "$code : " . $statusCodes[$code];
	return Response::view('errors/error', $error, $code);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/


/*App::error(function(Exception $exception)
{
    Response::view('home');
});*/

require app_path().'/filters.php';
