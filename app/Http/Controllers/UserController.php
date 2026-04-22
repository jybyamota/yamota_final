<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = ['admin', 'staff', 'teacher', 'student'];
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'account_type' => 'required|in:admin,staff,teacher,student',
        ]);
        $validated['created_by'] = Auth::id();
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'staff', 'teacher', 'student'];
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'account_type' => 'required|in:admin,staff,teacher,student',
        ]);
        $validated['updated_by'] = Auth::id();
        $validated['updated_on'] = now();
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted');
    }
}
