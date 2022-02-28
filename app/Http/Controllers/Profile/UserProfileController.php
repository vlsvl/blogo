<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserProfileController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Inertia
     */
    public function index(Request $request)
    {
        return Inertia::render('Profile/Index');
    }

    public function updateCurrentUserInfo(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => 'string|required|min:5|max:50',
            'email' => 'string|required|unique:users,email,' . $user->id
        ]);

        $user->update($validated);

        return Redirect::back()->with('success', 'User info updated.');
    }

    public function updateCurrentUserPassword(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->get('password'));
        $user->save();
        return back()->with('success', 'User password updated');
    }

    public function deleteCurrentUserProfile(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
        ]);
        $request->user()->delete();
        Auth::logout();
        return redirect('/');
    }
}
