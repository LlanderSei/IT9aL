<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
  public function AuthForm() {
    return view("auth");
  }
  public function Dashboard() {
    return view('dashboard');
  }

  public function RegisterUser(Request $request) {
    $request->validateWithBag('register', [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6|confirmed',
      'password_confirmation' => 'required|min:6',
    ]);

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return redirect()->route('authform')->with('toast_success', 'Registration successful! You can now log in.');
  }

  public function LoginUser(Request $request) {
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!Auth::attempt($credentials)) {
      return redirect()->route('authform')->with('toast_error', 'Login failed. Check your credentials.')->withInput($request->only('email'));
    }
    return redirect()->route('dashboard')->with('toast_success', 'Login successful!');
  }

  public function LogoutUser(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('authform')->with('toast_success', 'Logout successful!');
  }
}
