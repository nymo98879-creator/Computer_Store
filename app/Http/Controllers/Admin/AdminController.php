<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Controller;
class AdminController extends Controller
{
    public function customerHome()
    {
        return view('FrontEnd.Home'); // your customer page view
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registered successfully! You can now log in.');
    }


    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1️⃣ Try Admin login
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {

            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_name', $admin->name);
            return redirect('/admin/dashboard');
        }

        // 2️⃣ Try User login
        $user = Customer::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_logged_in', true);
            $request->session()->put('user_name', $user->name);
            return redirect('/');
        }

        return back()->with('error', 'Invalid email or password.');
    }




    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_name');
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
