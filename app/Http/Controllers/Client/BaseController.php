<?php namespace App\Http\Controllers\Client;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use AdminKacana\Util;

class BaseController extends Controller {

	/**
	 * run first
	 *
	 * @return void
	 */
	public function __construct()
	{
		View::share('user', Util::getCurrentUser());
	}
}
