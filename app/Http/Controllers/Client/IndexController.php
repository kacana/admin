<?php namespace App\Http\Controllers\Client;

class IndexController extends BaseController {

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('client.index.index');
	}

}
