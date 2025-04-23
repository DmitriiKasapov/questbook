<?php

use App\Http\Middleware\SetDefaultLocaleForUrls;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // using: function () {
        //     Route::middleware(['web', 'multilang'])
        //         ->prefix('{locale}')
        //         ->whereIn('locale', config('app.active_locales'))
        //         ->group(base_path('routes/web.php'));

        //     Route::fallback(function () {
        //         return redirect(Session::get('locale', config('app.locale')));
        //     });
        // },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'multilang' => SetDefaultLocaleForUrls::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
