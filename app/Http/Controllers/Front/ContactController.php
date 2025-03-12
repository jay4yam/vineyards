<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\AgencyRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
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

        return view('contact.index', compact('agency'));
    }
}
