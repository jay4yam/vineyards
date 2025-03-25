<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AgencyRepository;
use App\Traits\Seoable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use Seoable;

    public function __construct(private readonly AgencyRepository $agencyRepository)
    {
    }

    /**
     * Retourne la vue de la page contact
     * @return View
     */
    public function index(): View
    {
        $agency = $this->agencyRepository->getAgency();

        return view('contact.index', ['agency' => $agency, 'seoData' => $this->seoContact()]);
    }
}
