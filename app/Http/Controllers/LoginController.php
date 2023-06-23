<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            "username" => 'required',
            "password" => 'required'
        ]);

        $user = User::where('username', $request->username);
        if ($user) {
            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
            return back()->with('loginError', 'Login Failed, Please try again!');
        }else{
            return back()->with('loginError', 'Login Failed, Please try again!');
        }
    }
}
