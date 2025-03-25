<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ListeSeo;
use App\Models\Properties\Property;
use App\Repositories\PropertyRepository;
use App\Services\FilterProperties;
use App\Traits\Seoable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use Seoable;

    public function __construct(public PropertyRepository $propertyRepository,
                                public FilterProperties $filterProperties)
    {
    }

    /**
     * Retourne la liste des produits/propriétés du site
     * @param Request $request
     * @return View
     */
    public function index(Request $request):View
    {
        //gère les filtres du moteur de recherche
        $datas = $this->filterProperties->handle($request);

        //génère la pagination des résultats
        $properties = $datas->paginate(12);

        return view('properties.index', ['properties' => $properties, 'seoData' => $this->seoProperties()]);
    }


    /**
     * Retourne la vue d'une propriété
     * @param string $slug
     * @param Property $property
     * @return View
     */
    public function show(string $slug, Property $property):View
    {
        $property->load(['category', 'user', 'subtype', 'type' ,'pictures', 'city' ,'region', 'areas', 'comment', 'comments']);

        return view('properties.show', ['property' => $property, 'seoData' => $this->seoPropertyShow($property)]);
    }

    /**
     * Retourne la vue d'une liste seo
     * @param string $locale
     * @param ListeSeo $listeseo
     * @param string $slug
     * @param Request $request
     * @return View
     */
    public function region(string $locale, ListeSeo $listeseo, string $slug, Request $request): View
    {
        $datas = $this->filterProperties->dataForListSeo($listeseo, $request);

        $properties = $datas->paginate(12);

        $listeseo->load('translate');

        return view('properties.listeseo', ['properties' => $properties, 'listeseo' => $listeseo, 'seoData' => $this->seoListeSeo($listeseo)]);
    }
}
