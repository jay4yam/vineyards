<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\traits\Seoable;
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
}
