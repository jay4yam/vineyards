<?php

use Illuminate\Support\Facades\Route;

//routes backoffice
Route::domain('vineyards.'. env('APP_DOMAIN', 'localhost'))
    ->prefix('dashboard')
    ->name('back.')
    ->middleware(['auth', 'verified'])->group(function (){

        Route::get('/', \App\Http\Controllers\Back\DashboardController::class)->name('home');

        Route::resource('blog', \App\Http\Controllers\Back\BlogController::class)->except(['show']);
        Route::get('translate/blog/{blog}', [\App\Http\Controllers\Back\TranslateController::class, 'blogTranslate'])->name('blog.translate');

        Route::patch('/update/{category?}', [\App\Http\Controllers\Back\CategoryController::class, 'update'])->name('category.update_or_create');
        Route::delete('/delete/{category?}', [\App\Http\Controllers\Back\CategoryController::class, 'destroy'])->name('category.destroy');

        Route::resource('user', \App\Http\Controllers\Back\UserController::class)->except(['show']);
        Route::get('/translate/user/{user}', [\App\Http\Controllers\Back\TranslateController::class, 'userTranslate'])->name('user.translate');

        Route::resource('contact', \App\Http\Controllers\Back\ContactController::class);

        Route::get('/properties', [\App\Http\Controllers\Back\PropertyController::class, 'index'])->name('properties.index');

        Route::resource('listeseo', \App\Http\Controllers\Back\ListSeoController::class);
        Route::get('/translate/listeseo/{listeseo}', [\App\Http\Controllers\Back\TranslateController::class, 'listeseoTranslate'])->name('listeseo.translate');
    });

//routes frontoffice
Route::domain('vineyards.'.env('APP_DOMAIN', 'localhost'))
    ->prefix('{locale?}')
    ->middleware([\App\Http\Middleware\Localization::class, \App\Http\Middleware\SetDefaultLocale::class])
    ->group(function (){

        //home page
        Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

        //index produits
        Route::match(['get', 'post'],  __('routes.properties'), [\App\Http\Controllers\Front\PropertyController::class, 'index'])->name('properties.index');

        //show produit
        Route::get(__('routes.properties').'/{slug}/{property}', [\App\Http\Controllers\Front\PropertyController::class, 'show'])->name('properties.show');

        //route par région avec optimisation seo
        Route::match(['get', 'post'],__('routes.region').'/{listeseo}/{slug}', [\App\Http\Controllers\Front\PropertyController::class, 'region'])->name('properties.region');

        //index blog
        Route::get(__('routes.handbook'), [\App\Http\Controllers\Front\BlogController::class, 'index'])->name('blog.index');

        //show blog
        Route::get(__('routes.handbook').'/{blog}/{slug}', [\App\Http\Controllers\Front\BlogController::class, 'show'])->name('blog.show');

        //about
        Route::get(__('routes.about'), [\App\Http\Controllers\Front\HomeController::class, 'about'])->name('about');

        //contact page
        Route::get( __('routes.contact'), [\App\Http\Controllers\Front\ContactController::class, 'index'])->name('contact');

        //form submit
        Route::post('/contact/form/submit', [\App\Http\Controllers\FormController::class, 'contactFormSubmit'])->name('contact.form.submit');

        require __DIR__.'/auth.php';

        Route::get('getProperties', function (\App\Libraries\APIMO\ApimoPropertiesImport $propertiesImport){
            $propertiesImport->import(2421, null);
            return back();
        });

    })->where(['locale' => '[a-zA-Z]{2}']);
