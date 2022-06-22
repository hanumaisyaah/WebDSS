<?php

namespace App\Http\Controllers;

use App\Models\alternative;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::User()->level == 1) {
            return view('admin.adminHome');
        } else {
            return view('user.userHome');
        }
    }
}
