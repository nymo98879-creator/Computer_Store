<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
// use App\Http\Controllers\Controller;
class AdminController extends Controller
{

    // public function showLoginForm()
    // {
    //     return view('admin.login');
    // }


    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_name', $admin->name);
            return redirect('dashboard');
        }

        return back()->with('error', 'Invalid email or password.');
    }


    // Admin dashboard
    public function dashboard()
    {
        return view('admin.app');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_name');
        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
