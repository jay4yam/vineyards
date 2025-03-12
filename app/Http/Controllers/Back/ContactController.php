<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Repositories\ContactRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(public ContactRepository $contactRepository)
    {
    }

    /**
     * Retourne la liste des contact
     * @return View
     */
    public function index():View
    {
        $contacts = $this->contactRepository->getAll();

        return view('admin.contacts.index', compact('contacts'));
    }
}
