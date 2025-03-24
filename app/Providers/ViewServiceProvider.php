<?php

namespace App\Providers;

use App\View\Composers\BlogComposer;
use App\View\Composers\ChangeLangageComposer;
use App\View\Composers\ConnexePostComposer;
use App\View\Composers\DashboardComposer;
use App\View\Composers\ListeSeoComposer;
use App\View\Composers\PartnerHomeComposer;
use App\View\Composers\PropertyHomeComposer;
use App\View\Composers\PropertyLinkListComposer;
use App\View\Composers\PropertySearchComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('blogs._aside', BlogComposer::class);
        View::composer('blogs.show', ConnexePostComposer::class);
        View::composer('partials._search', PropertySearchComposer::class);
        View::composer('home', PropertyHomeComposer::class);
        View::composer('dashboard', DashboardComposer::class);
        View::composer('partials._property_link_list', PropertyLinkListComposer::class);
        View::composer('partials._langage', ChangeLangageComposer::class);
        View::composer('home', PartnerHomeComposer::class);
        View::composer('partials._footer', ListeSeoComposer::class);
    }
}
