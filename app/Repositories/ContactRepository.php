<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ContactRepository
{
    public function __construct(private readonly Contact $contact)
    {
    }

    /**
     * Retourne la liste paginée des contacts
     * @return LengthAwarePaginator
     */
    public function getAll():LengthAwarePaginator
    {
        return $this->contact->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Gère l'enregistrement d'un nouveau contact
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        $contact = new Contact();

        $this->save($contact, $request);
    }

    /**
     * @param Contact $contact
     * @param Request $request
     * @return void
     */
    private function save(Contact $contact, Request $request): void
    {
        $contact->fill($request->all());

        $contact->save();
    }
}
