<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // =========================
    // 🧑 Customer Home Page
    // =========================
    public function customerHome()
    {
        return view('FrontEnd.Home'); // Customer landing page
    }

    // =========================
    // 📝 Customer Registration
    // =========================
    public function register(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:255',
            'password'  => 'required|min:8|confirmed',
        ]);

        // ✅ Create customer
        $user = Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // ✅ Auto-login customer after registration
        $request->session()->put('user_logged_in', true);
        $request->session()->put('user_name', $user->name);
        $request->session()->put('user_id', $user->id);

        return redirect('/')->with('success', 'Registered and logged in successfully!');
    }

    // public function register(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'name'     => 'required|string|max:255',
    //         'email'    => 'required|email|unique:customers,email',
    //         'password' => 'required|min:8|confirmed',
    //     ]);

    //     // Create customer
    //     $user = Customer::create([
    //         'name'     => $request->name,
    //         'email'    => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     // Auto-login customer after registration
    //     $request->session()->put('user_logged_in', true);
    //     $request->session()->put('user_name', $user->name);
    //     $request->session()->put('user_id', $user->id);

    //     return redirect('/')->with('success', 'Registered and logged in successfully!');
    // }

    // =========================
    // 🔑 Login (Admin + Customer)
    // =========================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 1️⃣ Check Admin
        $admin = Admin::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->put('admin_name', $admin->name);
            $request->session()->put('admin_id', $admin->id);
            return redirect('/admin/dashboard');
        }

        // 2️⃣ Check Customer
        $user = Customer::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user_logged_in', true);
            $request->session()->put('user_name', $user->name);
            $request->session()->put('user_id', $user->id);
            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // =========================
    // 🚪 Admin Logout
    // =========================
    public function logout(Request $request)
    {
        // Logout Admin
        $request->session()->forget('admin_logged_in');
        $request->session()->forget('admin_name');
        $request->session()->forget('admin_id');

        // Logout Customer
        $request->session()->forget('user_logged_in');
        $request->session()->forget('user_name');
        $request->session()->forget('user_id');

        return redirect('/')->with('success', 'Logged out successfully!');
    }

    // =========================
    // 🚪 Customer Logout
    // =========================
    public function logoutCustomer(Request $request)
    {
        $request->session()->forget('user_logged_in');
        $request->session()->forget('user_name');
        $request->session()->forget('user_id');

        return redirect('/')->with('success', 'Customer logged out successfully!');
    }
}
