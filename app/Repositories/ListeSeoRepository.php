<?php

namespace App\Repositories;

use App\Models\ListeSeo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ListeSeoRepository
{
    public function __construct(protected readonly ListeSeo $listeSeo)
    {}

    public function getAll()
    {
        return $this->listeSeo->with('translate')->get();
    }

    /**
     * Retourne la liste des listeSeo
     * @return mixed
     */
    public function getPaginate():LengthAwarePaginator
    {
        return $this->listeSeo->paginate();
    }

    /**
     * Gère l'enregistrement d'une nouvelle liste seo
     * @param Request $request
     * @return ListeSeo
     */
    public function store(Request $request):ListeSeo
    {
        $listSeo = new ListeSeo();

        $this->save($listSeo, $request);

        return $listSeo;
    }

    private function save(ListeSeo $listeSeo, Request $request): void
    {
        //1. création d'une liste seo par région viticole
        if($request->has('region_viticole') && $request->region_viticole !=  "null")
        {
            $listeSeo->name = $request->name;
            $listeSeo->slug = Str::slug($request->name);
            $listeSeo->property_prefix_codes = explode(',', $request->region_viticole);
            $listeSeo->is_active = true;
            $listeSeo->save();
        }

        //2. création d'une liste seo par département
        if($request->has('liste_departement') && $request->liste_departement != "null")
        {
            $listeSeo->name = $request->name;
            $listeSeo->slug = Str::slug($request->name);
            $listeSeo->property_prefix_codes = explode(',', $request->liste_departement);
            $listeSeo->is_active = true;
            $listeSeo->save();
        }
    }

    /**
     * Gère la mise à jour d'une liste
     * @param Request $request
     * @param ListeSeo $listeSeo
     * @return void
     */
    public function update(Request $request, ListeSeo $listeSeo): void
    {
        //si la requête contient une traduction
        if($request->has('translate')) {

            //itère sur les langues envoyées par le formulaire d'edition
            foreach ($request['translate'] as $locale => $translation) {

                //mets à jour le model translate par langue
                $listeSeo->translates()->where('locale', '=', $locale)
                    ->updateOrCreate(['seo_liste_id' => $listeSeo->id,], [
                        'locale' => $locale,
                        'meta_title_seo' => $translation['meta_title_seo'],
                        'meta_description_seo' => $translation['meta_description_seo'],
                        'header_h1' => $translation['header_h1'],
                        'intro' => $translation['intro'],
                        'content' => $translation['content'],
                    ]);
            }
        }
    }

}
