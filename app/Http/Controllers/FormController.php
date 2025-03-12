<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Repositories\ContactRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function __construct(private readonly ContactRepository $contactRepository)
    {
    }

    /**
     * Gère le formulaire de contact de la home page
     * @param Request $request
     * @return RedirectResponse
     */
    public function contactFormSubmit(Request $request): RedirectResponse
    {
        //1. sauvegarder le contact en bdd
        try {
            $this->contactRepository->store($request);
        }catch (\Exception $exception){
            return back()->withErrors([$exception->getMessage()]);
        }

        //2. envoyer du mail au client
        try{
            Mail::to($request->email)
                ->bcc('vineyards@michaelzingraf.com')
                ->queue(new ContactFormMail($request->all()));
        }catch (\Exception $exception){
            return back()->withErrors([$exception->getMessage()]);
        }

        return back()->with(['form_contact_success' => true]);
    }
}
