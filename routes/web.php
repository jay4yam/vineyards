<?php

use Illuminate\Support\Facades\Route;

//routes backoffice
Route::domain('vineyards.'. env('APP_DOMAIN', 'localhost'))
    ->prefix('dashboard')
    ->name('back.')
    ->middleware(['auth', 'verified'])->group(function (){

        Route::get('/', \App\Http\Controllers\Back\DashboardController::class)->name('home');

        Route::resource('blog', \App\Repositories\BlogController::class)->except(['show']);
        Route::get('translate/blog/{blog}', [\App\Http\Controllers\Back\TranslateController::class, 'blogTranslate'])->name('blog.translate');

        Route::patch('/update/{category?}', [\App\Http\Controllers\Back\CategoryController::class, 'update'])->name('category.update_or_create');
        Route::delete('/delete/{category?}', [\App\Http\Controllers\Back\CategoryController::class, 'destroy'])->name('category.destroy');

        Route::resource('user', \App\Http\Controllers\Back\UserController::class)->except(['show']);
        Route::get('translate/user/{user}', [\App\Http\Controllers\Back\TranslateController::class, 'userTranslate'])->name('user.translate');

        Route::resource('contact', \App\Http\Controllers\Back\ContactController::class);

        Route::get('properties', [\App\Http\Controllers\Back\PropertyController::class, 'index'])->name('properties.index');
    });

//routes frontoffice
Route::domain('vineyards.'.env('APP_DOMAIN', 'localhost'))
    ->prefix('{locale?}')
    ->middleware([\App\Http\Middleware\Localization::class, \App\Http\Middleware\SetDefaultLocale::class])
    ->group(function (){

        //home page
        Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

        //index produits
        Route::get( __('routes.properties'), [\App\Http\Controllers\Front\PropertyController::class, 'index'])->name('properties.index');

        //show produit
        Route::get(__('routes.properties').'/{slug}/{property}', [\App\Http\Controllers\Front\PropertyController::class, 'show'])->name('properties.show');

        //index blog
        Route::get('/blog', [\App\Http\Controllers\Front\BlogController::class, 'index'])->name('blog.index');

        //show blog
        Route::get('blog/{blog}/{slug}', [\App\Http\Controllers\Front\BlogController::class, 'show'])->name('blog.show');

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
