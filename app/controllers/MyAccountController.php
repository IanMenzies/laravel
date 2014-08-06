<?php
/**
 * Controller that deals with the users logged in actions
 */
class MyAccountController extends BaseController
{
	/**
	 * returns view for dashboard
	 * @return view dashboard
	 */
	public function getAccountDashboard()
	{
		return View::make('account.dashboard');
	}
	
	/**
	 * returns view for edit details
	 * @return view edit account details page
	 */
	public function getEditDetails()
	{
		return View::make('account.edit');
	}
	
	/**
	 * Handles edit details data posted by user
	 * @return route 
	 */
	public function postEditDetails()
	{
		$usersInput = Input::all();
		$rules      = FormRulesHelper::editDetailsRules();
		$message    = array(
			'old_password.required' => 'Your old password is incorrect'
		);
		$validator  = Validator::make($usersInput, $rules, $message);
		
		if ($validator->fails()) {
			//var_dump($validator->errors()); exit;
			return Redirect::route('account-edit-details')
				->withInput()
				->withErrors($validator);
		}
		
		$user         = User::find(Auth::user()->id);		
		$validAccount = PasswordHelper::checkPassword($usersInput['old_password'], $user);
		
		if (!$validAccount) {
			return Redirect::route('account-edit-details')
				->withInput()
				->with('global', 'Ensure your old password is correct!!!');
		}
		
		$user->password = PasswordHelper::encryptPassword($usersInput['password']);
		
		if ($user->save()) {				
			return Redirect::route('account-dashboard')
				->with('global', 'Your details have now been updated');
		}
	}


}