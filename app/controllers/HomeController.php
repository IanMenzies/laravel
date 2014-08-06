<?php
/**
 * HomeController deals with all the basic routes accesible
 * from the homepage
 */
class HomeController extends BaseController {

	public function home()
	{
		return View::make('home');
	}
	
	public function cookies()
	{
		return View::make('cookies');
	}

	public function getSignIn()
	{
		return View::make('account.signin');
	}

	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home');
	}

	public function getForgotPassword()
	{
		return View::make('account.forgot');
	}

	public function getCreateAccount() {
		return View::make('account.create');
	}
	
}