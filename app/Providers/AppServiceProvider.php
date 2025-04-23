<?php

namespace App\Providers;

use App\Http\Middleware\SetDefaultLocaleForUrls;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Livewire;

class AppServiceProvider extends ServiceProvider
{
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
        Vite::macro('img', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        Livewire::addPersistentMiddleware([
            SetDefaultLocaleForUrls::class,
        ]);
    }
}
