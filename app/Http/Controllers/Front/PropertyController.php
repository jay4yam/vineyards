<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Properties\Property;
use App\Repositories\PropertyRepository;
use App\Services\FilterProperties;
use App\traits\Seoable;
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

        /*orderby paginator
        $properties->setCollection(
            $properties->sortBy(function ($item){
                return $item->price->value;
            }, SORT_REGULAR, 'desc'));
        */

        return view('properties.index', ['properties' => $properties, 'seoData' => $this->seoProperties()]);
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
        $property->load(['category', 'user', 'subtype', 'type' ,'pictures', 'city' ,'region', 'areas', 'comment', 'comments']);

        return view('properties.show', ['property' => $property, 'seoData' => $this->seoPropertyShow($property)]);
    }
}
