<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Workshop;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request) {
        if ($request->user()->workshop != NULL)
            return redirect(route('workshop.view'));

        if ($request->user()->role == 0){
            $ucount = User::where('approved',false)->count();
            return view('admin/admin',compact('ucount'));
        }

        return view('home');
    }

    public function index(Request $request) {
        if ($request->user() != null) return redirect('home');
        return view('index');
    }
}
