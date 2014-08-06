<?php
/**
 * This Helper is used to Encrypt a password
 * @author ian_menzies11@hotmail.com
 */
class PasswordHelper
{
	/**
	 * Hashes a password to make it secure
	 * @param  string $password
	 * @return string $password
	 */
	public static function encryptPassword($password)
	{
		$encryptedPassword = Hash::make($password);
		
		return $encryptedPassword;
	}
	
	/**
	 * Checks users passwords is valid
	 * @param  string $password
	 * @param  obj    $user
	 * @return bool   $valid 
	 */
	public static function checkPassword($password, $user)
	{
		$valid = false;
		
		if (Hash::check($password, $user->getAuthPassword()))
		{
			$valid = true;
		}
		
		return $valid;
	}

}