<?php

namespace App\Repositories;

use App\Models\Agency;

class AgencyRepository
{
    public function __construct(private readonly Agency $agency)
    {
    }

    /**
     * Retourne l'agence en bdd
     * @return Agency
     */
    public function getAgency():Agency
    {
        return $this->agency->first();
    }
}
