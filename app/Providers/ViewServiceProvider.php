<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    // private $seconds;

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // cache on prod
        // $this->seconds = \App::environment('production') ? 600 : 0;

        // Facades\View::composer(['pages.home'], function(View $view) {
        //     $something = $this->getSomething();
        //     $view->with(compact('something'));
        // });
    }

    /**
     * Getters
     */
    // private function getSomething()
    // {
    //     return Cache::remember('something_' . locale(), $this->seconds, function() {
    //         return 'something';
    //     });
    // }
}
