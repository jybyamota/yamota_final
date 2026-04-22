<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function changePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!password_verify($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->update([
            'password' => $validated['password'],
            'updated_on' => now(),
            'updated_by' => auth()->id(),
        ]);

        return back()->with('success', 'Password changed successfully');
    }
}
