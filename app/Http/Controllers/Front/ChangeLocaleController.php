<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeLocaleController extends Controller
{
    public function __invoke(string $locale, string $lang , Request $request)
    {
        //1. récupère l'ancienne url
        $lastUrl = url()->previousPath();

        dd($lang, $lastUrl);
    }
}
