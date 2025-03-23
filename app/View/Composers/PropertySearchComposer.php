<?php

namespace App\View\Composers;

use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

readonly class PropertySearchComposer
{
    public function __construct(private PropertyRepository $propertyRepository)
    {}

    /**
     * Retourne la liste des régions dans lesquelles nous avons des produits
     * @return array
     */
    public function getRegions():array
    {
        return Cache::remember('regions', 3600, function () {
            return $this->propertyRepository->getAllPropertiesRegions();
        });
    }

    public function getDepartments():array
    {
        return Cache::remember('departments', 3600, function () {
            return $this->propertyRepository->getDepartments();
        });
    }

    /**
     * Retourne la liste des prix
     * @return array
     */
    public function getPrices():array
    {
        return Cache::remember('prices', 3600, function () {
            return $this->propertyRepository->getPrices();
        });
    }

    /**
     * Retourne la liste des surfaces
     * @return array
     */
    public function getSurfaces():array
    {
        return Cache::remember('surfaces', 3600, function () {
            return $this->propertyRepository->getSurfaces();
        });
    }

    public function compose(View $view): void
    {
        $view->with('allRegions', $this->getRegions());
        $view->with('allDepartments', $this->getDepartments());
        $view->with('allPrices', $this->getPrices());
        $view->with('allSurfaces', $this->getSurfaces());
    }
}
