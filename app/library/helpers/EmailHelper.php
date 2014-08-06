<?php

/**
 * This Helper is used for Emails
 * @author ian_menzies11@hotmail.com
 */
class EmailHelper
{
	/**
	 * Send email to user
	 * @param array $emailDetails 
	 * @param array|string $params
	 * @return void
	 */
	public static function sendEmail($emailDetails, $params, $user)
	{
		//TODO::Add exception if details aren't passed in correctly
		Mail::send($emailDetails['emailSource'], $params, function ($message) use ($user, $emailDetails) {
			$message
			->to($user->email, $user->username)
			->subject($emailDetails['emailSubject']);
		});
		
		//throw error if email isn't sent
	}

	/**
	 * Notify ME ME ME of serious errors occurring on site
	 * @param array $emailSource
	 * @param array $params
	 * @return void
	 */
	public static function sendWebsiteIssueEmail($emailSource = 'emails.error.notifyErrors', $params) 
	{
		Mail::send($emailSource, $params, function($message) {
			$message
			->to('ian_menzies11@hotmail.com')
			->subject('HTTP ERROR ON SITE, URGENT ATTENTION REQUIRED!!');
		});
	}

}