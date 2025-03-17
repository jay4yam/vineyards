<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        if (in_array( request()->segment(1), config('app.available_locales'))) {

            $locale = request()->segment(1);

            app()->setLocale( $locale );
        }
    }
}
