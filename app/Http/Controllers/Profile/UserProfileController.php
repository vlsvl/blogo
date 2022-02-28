<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Inertia
     */
    public function index(Request $request, User $user)
    {
        return Inertia::render('Profile/Index', compact($user));
    }
}
