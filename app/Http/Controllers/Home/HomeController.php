<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $redirectTo = '/home';

    public $restful = true;

    public function index() 
    {
        return View::make('home.index');
    }
	
	public function get_message(Request $request)
	{
		$msg = "This is a simple message.";
        if ($request->isMethod('post')){    
            return response()->json(['response' => 'post' + $msg]); 
        }

        return response()->json(['response' => 'get:' + $msg]);
//		return response()->json(array('msg' => $msg), 200);
	}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
