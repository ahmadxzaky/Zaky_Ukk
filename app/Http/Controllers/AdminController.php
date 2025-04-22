<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Book;

class AdminController extends Controller {
    public function index() {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access'); 
        }

        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied');
        }
        $users = User::whereIn('role', ['officer'])->get();
        return view('admin.index', compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'stock' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book added successfully');
    }


    public function destroy($id) {
        $user = User::whereIn('role', ['officer', 'visitor'])->findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $redirectRoute = null;

        Log::info('Login attempt with email: ' . $credentials['email']);

        $user = User::where('email', $credentials['email'])->first();
        if ($user) {
            Log::info('User found: ' . $user->email . ' with role: ' . $user->role);
        } else {
            Log::warning('User not found with email: ' . $credentials['email']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            Log::info('User role: ' . Auth::user()->role);

            switch (Auth::user()->role) {
                case 'admin':
                    $redirectRoute = 'admin.dashboard';
                    break;
                case 'officer':
                    $redirectRoute = 'officer.dashboard';
                    break;
                default:
                    $redirectRoute = 'dashboard';
                    break;
            }
        } else {
            Log::warning('Login failed for email: ' . $credentials['email']);
        }

        if ($redirectRoute) {
            return redirect()->route($redirectRoute);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


}
