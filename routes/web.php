<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::domain('vineyards.'.env('APP_DOMAIN', 'localhost'))->prefix('{locale?}')->middleware([\App\Http\Middleware\Localization::class, \App\Http\Middleware\SetDefaultLocale::class])->group(function (){

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

    //change locale route
    Route::get('/langage/{lang}', [\App\Http\Controllers\Front\ChangeLocaleController::class, '__invoke'])->name('change.locale');

    require __DIR__.'/auth.php';

    Route::get('getProperties', function (\App\Libraries\APIMO\ApimoPropertiesImport $propertiesImport){
        $propertiesImport->import(2421, null);
    });

    //routes backoffice
    Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function (){

        app()->setLocale('fr');

        Route::get('/', \App\Http\Controllers\Back\DashboardController::class)->name('dashboard');

        Route::resource('backblog', \App\Http\Controllers\Back\BlogController::class)->except(['show']);
        Route::get('translate/blog/{blog}', [\App\Http\Controllers\Back\TranslateController::class, 'blogTranslate'])->name('blog.translate');

        Route::resource('backuser', \App\Http\Controllers\Back\UserController::class)->except(['show']);

        Route::resource('backcontact', \App\Http\Controllers\Back\ContactController::class);

        Route::get('backproperties', [\App\Http\Controllers\Back\PropertyController::class, 'index'])->name('back.properties.index');
    });

})->where(['locale' => '[a-zA-Z]{2}']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


