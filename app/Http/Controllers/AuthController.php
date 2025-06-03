<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request -> validate
        (
            [
                'email' => 'required|email',
                'password' => 'required|min:5'
            ]
         );
         if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')-> with ('success', 'Selamat Datang di Website '. Auth::user()->name);
         }
         return back()->withErrors(
            [
                'email' => 'Email not found!'
            ]
         )->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')-> with ('success', 'Anda telah Logout dari Website ');
    }
}
