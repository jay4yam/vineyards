<?php

namespace App\Repositories;

use App\Models\Properties\Property;
use Illuminate\Support\Collection;

class PropertyRepository
{
    public function __construct(public Property $property)
    {
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getNewQuery()
    {
        return $this->property->with(['user', 'type','picture', 'picture', 'city' ,'region', 'areas'])
            ->where('step_id', '=', 1)
            ->orderBy('price', 'desc')
            ->newQuery();
    }

    /**
     * Retourne la liste des produits paginées
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginate()
    {
        return $this->property->with(['user', 'type','picture', 'picture', 'city' ,'region', 'areas'])
            ->newQuery()
            ->orderBy('price', 'desc')
            ->paginate();
    }

    /**
     * Liste des types de Propriétés
     * @return \Illuminate\Support\Collection
     */
    public function getAllPropertiesTypes():Collection
    {
        return $this->property->with('type:name,id')->get()->pluck('type.name', 'type.id');
    }

    /**
     * Liste des sous-types de propriétés
     * @return Collection
     */
    public function getAllPropertiesSubtypes()
    {
        return $this->property->with('subtype:name,id')->get()->pluck('subtype.name', 'subtype.id');
    }

    /**
     * Liste des régions
     * @return Collection
     */
    public function getAllPropertiesRegions()
    {
        return $this->property->with('region:name,id')->get()->pluck('region.name', 'region.id');
    }

    /**
     * Retourne une selection de propriétés pour la home page
     * @return \Illuminate\Database\Eloquent\Collection|Collection
     */
    public function getFeaturedProperties()
    {
        return $this->property->with(['subtype', 'picture', 'city' ,'region' ,'areas'])->get()->take(6);
    }
}
