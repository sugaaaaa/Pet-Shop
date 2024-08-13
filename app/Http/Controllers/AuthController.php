<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function showLoginForm(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    public function login(Request $request): \Illuminate\Http\RedirectResponse
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $credentials['email'])->first();

    // Check if a user with the provided email exists
    if ($user) {
        // Verify the password (assuming the password is stored in plain text)
        if ($user->password === $credentials['password']) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have successfully logged in!');
        }
    }

    // If the email or password is incorrect, redirect back with an error message
    return back()->withErrors([
        'email' => 'Invalid Email or Password. Please try again.',
    ])->withInput($request->only('email'));
}

    public function showRegisterForm(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        Auth::login($user);
        Session::flash('success', 'Signup successful!');
        return redirect('/');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect('/')->withSuccess('You have logged out successfully!');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        User::destroy($id);
        return redirect('/admin/adminDashboard/users/user/')->with('flash_message', 'user Deleted!');
    }
}
