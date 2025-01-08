<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login (Request $request) {
        return view('auth.login');
    }

    public function post_login (Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === "user") {
                $request->session()->put('role', Auth::user()->role);
                return redirect()->route('index')->with('success', 'Successfully Login');
            }
            else if (Auth::user()->role === "admin") {
                $request->session()->put('role', Auth::user()->role);
                return redirect()->route('adminDashboard')->with('success', 'Successfully Login');
            }
        }
        return Redirect::back()->withErrors(['msg' => 'Login Failed!']);
    }

    public function logout (Request $request) {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Successfully Logout');
    }

    public function register (Request $request) {
        return view('auth.register');
    }

    public function post_register (Request $request) {
        try {
            $all_customer = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        }
        catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'Something wrong! Please register again!']);
        }
        return redirect()->route('login')->with('success', 'Successfully Registered!');
    }
}
