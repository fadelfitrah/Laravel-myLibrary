<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:user,admin,librarian',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Hash the password

        User::create($validated);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

            $users = Auth::user();

            return redirect()->route('users.index')->with('success', 'Welcome back!');
        }

        return back()->with([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
