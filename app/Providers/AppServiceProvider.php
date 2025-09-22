<?php

namespace App\Providers;

use App\Models\Departamental;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
        date_default_timezone_set(Config::get('app.timezone')); // 👈 Clave
        Route::model('departamental', Departamental::class);
    }
}
