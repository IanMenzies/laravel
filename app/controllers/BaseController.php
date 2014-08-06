<?php

class BaseController extends Controller {

	public function __construct()
	{
		//Pass the current page to the view
		View::share('currentPage', !empty(Route::currentRouteName()) ? Route::currentRouteName() : '');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if (!is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
