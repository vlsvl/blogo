<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke(Request $request, $room = null)
    {
        return Inertia::render('Admin/Dashboard');
    }
}
