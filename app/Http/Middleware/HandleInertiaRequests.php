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
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

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
            'locale' => fn() => app()->getLocale(),
            'locales' => fn() => config('blogo.locales'),
            'translation' => fn() => app(TranslationService::class)
                    ->getTranslations(app()->getLocale()),
        ]);
    }
}
