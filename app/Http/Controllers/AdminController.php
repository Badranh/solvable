<?php

namespace App\Http\Controllers;

use App\User;
use App\Events\TestEvent;
use Illuminate\Http\Request;

class AdminController extends Controller {
    public function getusers() {
        $users = User::where('email', '!=', auth()->user()->email)->where('approved','!=',true)->get();
        return view('admin/approve',compact('users'));
    }

    public function approve(Request $req) {
        $user = User::where('email',$req->email)->first();
        $user->approved = true;
        $user->save();
        return redirect(route('review'));
    }
}
