<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }


    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        User::create($request->all());
        return redirect()->route('users.index');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('admin.user.edit        ', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,officer,visitor',
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->route('admin.user.index')->with('success', 'Role user berhasil diubah!');
    }


    public function destroy($id) {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }
}
?>
