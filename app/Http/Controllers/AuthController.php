<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $redirectPath = null;

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
// Redirect berdasarkan role
if ($user->role === 'admin') {
    $redirectPath = '/admin/dashboard';
} elseif ($user->role === 'officer') {
    $redirectPath = '/officers/dashboard'; // fix disini
} else {
    $redirectPath = '/visitor/index';
}
        } else {
            return back()->withErrors(['email' => 'Email atau password salah']);
        }

        return redirect($redirectPath);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'visitor' // Default role
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login!');
    }
}
