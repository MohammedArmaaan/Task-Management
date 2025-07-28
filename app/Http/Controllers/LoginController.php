<?php

namespace App\Http\Controllers;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends SNMResponse
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function showRegistrationForm()
    {
        return view('register');
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|unique:user_infos,user_email',
            'user_password' => 'required|min:6',
            'user_role' => 'required|in:admin,hr,employee'
        ]);
        try {
            $user = UserInfo::create([
                'user_name' => $validated['user_name'],
                'user_email' => $validated['user_email'],
                'user_password' => Hash::make($validated['user_password']),
                'user_role' => $validated['user_role'],
            ]);
            return redirect()->route('login')
                ->with('success', 'Registration successful! Please login.');           
        }
        catch (\Exception $e) {
            return back()->with('error', 'Registration failed: '.$e->getMessage());
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'user_email' => 'required|email',
            'user_password' => 'required'
        ]);
        $user = UserInfo::where('user_email', $request->user_email)->first();
        if ($user && Hash::check($request->user_password, $user->user_password)) {
            Auth::guard('user')->login($user);
            switch ($user->user_role) {
                case 'admin':
                    return redirect()->route('dashboard.admin');
                case 'employee':
                    return redirect()->route('dashboard.employee');
            }
        }
        return back()->with('error', 'Invalid credentials');
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/login');
    }
}