<?php

namespace App\View\Composers;

use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class PropertySearchComposer
{
    public function __construct(private readonly PropertyRepository $propertyRepository)
    {}

    /**
     * Récupère tous les types de propriétés
     * @return \Illuminate\Support\Collection
     */
    public function getTypes()
    {
        return $this->propertyRepository->getAllPropertiesTypes();
    }

    public function getSubtypes()
    {
        return $this->propertyRepository->getAllPropertiesSubtypes();
    }

    public function getRegions()
    {
        return $this->propertyRepository->getAllPropertiesRegions();
    }

    public function compose(View $view): void
    {
        $view->with('allTypes', $this->getTypes());
        $view->with('allSubtypes', $this->getSubtypes());
        $view->with('allRegions', $this->getRegions());
    }
}
