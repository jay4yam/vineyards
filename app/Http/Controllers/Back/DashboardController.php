<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        app()->setLocale('fr');
    }

    /**
     * Retourne la vue index du dashboard
     * @return View
     */
    public function __invoke():View
    {
        return view('dashboard');
    }
}
