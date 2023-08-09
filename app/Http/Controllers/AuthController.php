<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {

        $credentials = $request->only('email', 'password');

        if (Auth::guard('company')->attempt($credentials)) {
            return redirect()->route('homepage');
        }
        
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect()->route('homepage');
        }

        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid login credentials']);
    }

    public function logout(Request $request) {

        if (Auth::guard('company')->check()) {
            Auth::guard('company')->logout();
        }

        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('homepage');
    }
}
