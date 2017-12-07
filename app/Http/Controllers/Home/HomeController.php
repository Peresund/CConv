<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

/**
 * Controller for handling the views for the home page
 */
class HomeController extends Controller
{

	/**
	 * Get the home index view
	 * 
	 * @return \Illuminate\Contracts\View\View A view containing the home index page
	 */
    public function index()
    {
        return View::make('home.index');
    }
}
