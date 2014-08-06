<?php
/**
 * This form rules Helper is used to outline validation rules
 * @author ian_menzies11@hotmail.com
 */
class FormRulesHelper
{

	/**
	 * Generic account rules
	 * @return array $rules
	 */
	public static function accountRules() 
	{
		$rules = array(
			'firstname'        => 'required|max:100',
			'lastname'         => 'required|max:100',
			'password'         => 'required|min:6',
			'password_confirm' => 'required|same:password'
		);

		return $rules;
	}

	/**
	 * Create account rules
	 * @return array $rules
	 */
	public static function createAccountRules()
	{
		$rules                 = self::accountRules();
		$rules['username']     = 'required|alpha_dash|max:20|min:3|unique:users';
		$rules['email']        = 'required|max:50|email|unique:users';

		return $rules;  
	}

	/**
	 * Edit details rules
	 * @return array $rules
	 */
	public static function editDetailsRules()
	{
		$rules                 = self::accountRules();
		$rules['old_password'] = 'required';

		return $rules;
	}
	
	/**
	 * Login rules
	 *
	 * @return array $rules 
	 */
	public static function loginRules()
	{
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);
		
		return $rules;
	}
	
	/**
	 * Forgotten password rules
	 *
	 * @return array $rules 
	 */
	public static function forgottenPasswordRules()
	{
		$rules = array(
			'email'    =>  'required|email'
		);
		
		return $rules;
	}

}