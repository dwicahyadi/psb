<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Auth::user()->getRoleNames()->toArray();
        if (in_array('calon siswa',$roles))
        {
            $test = Test::where('user_id', Auth::id())->first();
            return view('home',['test'=>$test]);
        }else{
            return redirect(route('dashboard'));
        }
    }
}
