<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Properties\Property;
use App\Repositories\PropertyRepository;
use App\Services\FilterProperties;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
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

        //gènère la pagination des résultats
        $properties = $datas->paginate(12);

        return view('properties.index', compact('properties'));
    }


    /**
     * Retourne la vue d'une propriété
     * @param string $locale
     * @param string $slug
     * @param Property $property
     * @return View
     */
    public function show(string $locale, string $slug, Property $property):View
    {
        $property->load(['user', 'subtype', 'type' ,'pictures', 'city' ,'region', 'areas', 'comment']);

        return view('properties.show', compact('property'));
    }
}
