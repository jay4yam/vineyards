<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Retourne la vue index du dashboard
     * @return View
     */
    public function __invoke():View
    {
        return view('dashboard');
    }
}
