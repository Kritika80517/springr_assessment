<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if(Auth::attempt($credentials)){
            return redirect('dashboard')->with('success', 'Logged in successfully.');
        }else{
            return redirect()->back()->with('failed', 'Somthing went wrong.');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
