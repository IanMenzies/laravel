<?php

class AccountController extends BaseController 
{

	public function postCreateAccount() {
		$usersInput = Input::all();
		$rules      = FormRulesHelper::createAccountRules();
		
		$validator = Validator::make($usersInput, $rules);
		
		if ($validator->fails()) {
			return Redirect::route('account-create')
				->withErrors($validator)
				->withInput();
		} else {
			//Encrypt password with hash algorithm
			$password = PasswordHelper::encryptPassword($usersInput['password']);
			//Create unique activation code
			$code     = str_random(60);
			
			$user = new User();
			$user->email     = $usersInput['email'];
			$user->firstname = $usersInput['firstname'];
			$user->lastname  = $usersInput['lastname'];
			$user->username  = $usersInput['username'];
			$user->password  = $password;
			$user->code      = $code;
			$user->active    = 0;
			
			//Save user to DB
			$userSaved = $user->save();
			
			//check that user was saved
			if ($userSaved) {
				$emailDetails = array(
					'emailSource'    => 'emails.auth.activate',
					'emailSubject'   => 'Activate your account'
				);
				
				$emailParams  = array(
					'link'         => URL::Route('account-activate', $code),
					'username'     => $user->username
				);
				//EmailHelper used to send activation email to user
				EmailHelper::sendEmail($emailDetails, $emailParams, $user);

				return Redirect::route('home')
					->with(
						'global',
						'Your account has been created! Activation email has been sent to you.'
				);
			}
		}
	}
	
	public function getActivate($code)
	{
		$user          = User::where('code', '=', $code)->where('active', '=', 0);
		
		$globalMessage = 'We could not activate your account';
		if ($user->count()) {
			$user      = $user->first();
			
			
			//Update user to active state
			$user->active = 1;
			$user->code   = '';
			
			if ($user->save()) {
				$globalMessage = 'Your account is now activated! Congratulation';
			}
		}
		return Redirect::route('home')
			->with('global', $globalMessage);
	}
	
	public function postSignIn()
	{
		$usersInput = Input::all();
		$rules      = FormRulesHelper::loginRules();

		$validator = Validator::make($usersInput, $rules);
		
		if ($validator->fails()) {
			return Redirect::route('account-sign-in')
				->withErrors($validator)
				->withInput();
		}
		
		$rememberUser = Input::has('remember') ? true : false;
		
		$auth = Auth::attempt(
			array(
				'email'    => $usersInput['email'],
				'password' => $usersInput['password'],
				'active'   => 1
			),
			$rememberUser
		);

		if (!$auth) {
			return Redirect::route('account-sign-in')
				->with('global', 'There was an issue signing you in. Ensure your password and email is correct');
		}
		
		//Everything's good to go, redirect user to his account
		return Redirect::intended('/');
	}

	public function postForgotPassword()
	{
		$usersInput = Input::all();
		$rules      = FormRulesHelper::forgottenPasswordRules();
		$validator  = Validator::make($usersInput, $rules);

		if ($validator->fails()) {
			return Redirect::route('account-forgot-password')
				->withErrors($validator)
				->withInput();
		} else {
			$user = User::where('email','=', $usersInput['email']);

			if ($user->count()) {
				$userDetails = $user->first();

				$code        = str_random(60);
				$password    = str_random(10);

				$userDetails->code = $code;
				$userDetails->password_temp = 
					PasswordHelper::encryptPassword($password);

				if ($userDetails->save()) {
					$emailDetails = $params = array();
					$emailDetails['emailSource']  = 'emails.auth.forgotPassword';
					$emailDetails['emailSubject'] = 'Forgotten Password Email';

					$params['link']               = URL::route('account-recover', $code);
					$params['username']           = $userDetails->username;
					$params['password']           = $password;

					EmailHelper::sendEmail($emailDetails, $params, $userDetails);

					return Redirect::route('home')
						->with('global', 'New password has been sent to your email account provided');
				}
			}
		}

		return Redirect::route('account-forgot-password')
				->with('global', 'Could not resend password! Ensure your email address is correct.');
				
	}

	public function getRecoverPassword($code) {
		$user = User::where('code', '=', $code)
					->where('password_temp', '!=', '');


		if ($user->count()) {
			$userDetails          = $user->first();

			$userDetails->password       = $userDetails->password_temp;
			$userDetails->password_temp  = '';
			$userDetails->code           = '';

			if ($userDetails->save()) {
				return Redirect::route('home')
					->with('global', 'Your password has been reset succesfully!');
			}
		}

		return Redirect::route('home')
				->with('global', 'Could not recover your password');
	}

}