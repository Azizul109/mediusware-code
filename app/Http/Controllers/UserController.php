<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Method to create a new user
    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'account_type' => 'required|in:individual,business',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'account_type' => $request->input('account_type'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Auth::login($user);


       return redirect('/login')->with('success', 'User created and logged in successfully');

    }

    // Method to log in user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in the user
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            // Authentication passed
            $user = Auth::user();
            return redirect('/show-deposit')->with('success', 'Login successful');
        }

        // Authentication failed
        return redirect('/login')->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login')->with('success', 'Logout successful');
    }
}
