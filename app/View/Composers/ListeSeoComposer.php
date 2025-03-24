<?php

namespace App\View\Composers;

use App\Repositories\ListeSeoRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class ListeSeoComposer
{
    public function __construct(public ListeSeoRepository $listeSeoRepository)
    {}

    /**
     * Retourne la liste de toutes les listes seo
     * @return Collection
     */
    public function getListesSeo(): Collection
    {
        return $this->listeSeoRepository->getAll();
    }

    public function compose(View $view): void
    {
        $view->with('allListesSeo', $this->getListesSeo());
    }
}
