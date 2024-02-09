<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginpage()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role == 'admin' || $user->role == 'petugas') {
                return redirect('/dashboard'); // Redirect to admin page
            } else {
                return redirect('/'); // Redirect to user's page
            }
        }

        return redirect()->back()->with('error', 'Username or Password Are Wrong');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function registerpage()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'fullname' => $request->fullname,
            'alamat' => $request->alamat,
            'role' => 'pengguna',
        ]);

        return redirect('/login')->with('success', 'Account registered successfully.');
    }
}
