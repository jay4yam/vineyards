<?php

namespace App\Services;

use App\Models\ListeSeo;
use App\Repositories\PropertyRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FilterProperties
{
    public Builder $query;

    public function __construct(public PropertyRepository $propertyRepository)
    {
        $this->query = $this->propertyRepository->getNewQuery();
    }

    /**
     * @param Request $request
     * @return Builder|RedirectResponse
     */
    public function handle(Request $request): Builder|RedirectResponse
    {
        //filtre région
        if(request()->filled('region') && request('region') != null) {

            //transforme la request region en tableau
            $arrayZipCode = explode(',', request('region'));

            //récupère les propriétés de ces regions
            $this->query->whereHas('city', function ($query) use ($arrayZipCode) {
                $query->whereIn('prefix_code', $arrayZipCode);
            });
        }

        //filtre département
        if(request()->filled('department') && request('department') != null) {

            //récupère le département passé dans la requête
            $department = request('department');

            //récupère les propriétés qui sont dans le departement
            $this->query->whereHas('city', function ($query) use ($department) {
                $query->where('prefix_code', '=', $department);
            });
        }

        //filtre terrain
        if(request()->filled('plot_surface') && request('plot_surface') != null) {

            //transforme la requete plot_surface en tableau
            $plotSurface = explode(',', request('plot_surface') );

            //récupère les propriétés dans le terrains (property_area == 51) est comprise dans le tableau plotSurface.
            $this->query->whereHas('areas', function ($query) use ($plotSurface) {
                $query->where('property_area_id', 51)
                    ->whereBetween('area', $plotSurface);
            });
        }


        //filtre prix
        if(request()->filled('price') && request('price') != null) {

            //transforme les prix en tableau
            $prices = explode(',', request('price'));

            //récupère les propriétés dans les prix sont situées dans le tableau prices
            $this->query->whereHas('price', function ($query) use($prices){
                $query->whereBetween('value', $prices);
            });
        }

        //filtre référence
        if(request()->filled('reference') && request('reference') != null) {

            $this->query->where('reference', '=', request('reference'));
        }

        return $this->query;
    }


    public function dataforListSeo(ListeSeo $listeSeo, Request $request)
    {
        $this->query->whereHas('city', function ($query) use ($listeSeo) {
            $query->whereIn('prefix_code', $listeSeo->property_prefix_codes);
        });

        $this->handle($request);

        return $this->query;
    }
}
