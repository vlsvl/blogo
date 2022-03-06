<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'viewAny',
            'show' => 'view',
            'destroy' => 'delete',
            'authAs' => 'authAs',
            'changeRole' => 'changeRole',
        ];
    }

    /**
     * Get the list of resource methods which do not have model parameters.
     *
     * @return array
     */
    protected function resourceMethodsWithoutModels()
    {
        return ['index'];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render(
            'Admin/Users/Index',
            [
            'filters' => $request->all('search', 'role'),
            'users' => User::orderBy('id', 'asc')
                ->with('role')
                ->filter($request->only('search'))
                ->paginate(10)
                ->withQueryString()
                ->through(
                    fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role->title,
                    ]
                ),
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Inertia\Response
     */
    public function show(User $user): \Inertia\Response
    {
        return Inertia::render('Admin/Users/Show', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at->format('d.m.Y'),
                'updated_at' => $user->updated_at->format('d.m.Y'),
                'email_verified_at' => $user->email_verified_at->format('d.m.Y'),
                'role_title' => $user->role->title,
                'role_id' => $user->role->id,
            ],
            'roles' => Role::select(['id', 'title'])
                ->get()
                ->map(fn($role) => [
                    'id' => $role->id,
                    'title' => $role->title,
                ])
        ]);
    }

    public function authAs(User $user): \Illuminate\Http\RedirectResponse
    {
        Auth::login($user);
        return redirect()->route('users.index')
            ->with('success', "You authorized as $user->name.");
    }

    public function changeRole(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'role_id' => 'required|integer|exists:roles,id'
        ]);

        $user->update($validated);

        return redirect()->back()
            ->with('success', "User $user->name role changed.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('error', "User $user->name was deleted!");
    }
}
