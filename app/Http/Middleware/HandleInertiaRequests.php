<?php

namespace App\Http\Middleware;

use App\Services\TranslationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
            ],
            'flash' => function () {
                return [
                    'warning' => Session::get('warning'),
                    'success' => Session::get('success'),
                    'error' => Session::get('error'),
                ];
            },
            'csrf_token' => csrf_token(),
            'locale' => fn () => app()->getLocale(),
            'locales' => fn () => config('blogo.locales'),
            'translation' => fn () => app(TranslationService::class)
                    ->getTranslations(app()->getLocale()),
            'adminMenu' => $request->user()
                ? app('App\Services\AdminMenuService')->getMenu()
                : null,
            'unreadMessage' => $request->user()
                ? $request->user()->getUnreadMessageCount()
                : 0,
        ]);
    }
}
