<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Affiche la vue pour la home page
     * @return View
     */
    public function index():View
    {
        return view('home');
    }
}
