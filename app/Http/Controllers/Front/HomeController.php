<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Traits\Seoable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use Seoable;

    /**
     * Affiche la vue pour la home page
     * @return View
     */
    public function index():View
    {
        return view('home', ['seoData' => $this->seoHome()]);
    }

    /**
     * Affiche la vue about / a-propos
     * @return View
     */
    public function about():View
    {
        return view('about', ['seoData' => $this->seoHome()]);
    }
}
