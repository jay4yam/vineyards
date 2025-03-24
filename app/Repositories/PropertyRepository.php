<?php

namespace App\Repositories;

use App\Models\Properties\Property;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class PropertyRepository
{
    public function __construct(public Property $property)
    {
    }

    /**
     * @return Builder
     */
    public function getNewQuery(): Builder
    {
        return $this->property
            ->where('status_id', '=', 1)
            ->with(['user', 'type', 'pictures', 'city' ,'region', 'areas', 'picture', 'pictures', 'comment', 'price'])
            ->join('prices', 'properties.id', '=', 'prices.property_id')
            ->orderBy('prices.value', 'desc')
            ->select('properties.*') // important pour éviter d’écraser les champs du modèle
            ->newQuery();
    }

    /**
     * Retourne la liste des produits paginées pour le back office.
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return $this->property->with(['user', 'type','picture', 'picture', 'city' ,'region', 'areas', 'price'])
            ->newQuery()
            ->paginate();
    }

    /**
     * Liste des régions ou il y a des produits
     * @return array
     */
    public function getAllPropertiesRegions(): array
    {
        //1. récupère toutes les codes postaux des produits
        $departements = $this->property->with('city:prefix_code,id')
            ->get()
            ->pluck('city.prefix_code')
            ->toArray();

        //2. récupère les régions du fichier config => ['provence' => ['13','83','04','06'], etc...
        $regions = config('property_regions');

        //3. init un tableau vide
        $result = [];

        //4. itère sur le tableau des régions
        foreach ($regions as $region => $codes) {

            //5. itère sur chaque code
            foreach ($codes as $code) {

                //6. si le code est contenu dans le tableau département
                if (in_array($code, $departements, true)) {

                    //7. rempli le tableau result avec la clé 'region', et les valeurs
                    $result[$region] = $codes;

                    //8. dès qu'un code match, on garde la région et on passe à la suivante
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Retourne la liste des départements dans lesquels nous avons des produits
     * @return array
     */
    public function getDepartments():array
    {
        //récupère la liste des départments des produits
        $departements = $this->property->with('city:zipcode,id')
            ->get()
            ->pluck('city.zipcode')
            ->map(function ($item) {
                return substr($item, 0, 2);
            })->toArray();

        //récupère la liste des départments du fichier de config
        $config_departments = config('property_departments');

        //init un tableau vide
        $result = array();

        //itère sur le tableau de config
        foreach ($config_departments as $zipcode => $name){

            //si le zipcode est dans le tableau
            if (in_array((string)$zipcode, $departements)) {
                $result[$zipcode] = $name;
            }
        }

        return $result;
    }

    /**
     * Retourne un tableau de prix en fonction des prix des propriétés
     * @return array
     */
    public function getPrices():array
    {
        //1. récupère les prix des produits
        $productPrices = $this->property->with('price')
            ->get()
            ->pluck('price.value')
            ->toArray();

        //2. récupère les prix du fichier de config
        $config_prices = config('property_prices');

        //3. init un nouveau tableau
        $result = array();

        //4. itère sur les prix des produits
        foreach ($productPrices as $price) {

            //5. itère sur le tableau de config
            foreach ($config_prices as $label => [$min, $max]) {

                //si le prix est contenu dans la borne min < > max
                if ($price >= $min && $price < $max) {

                    //on set un tableau avec la clé (label) et la valeur min < > max
                    $result[$label] = [$min, $max];

                    //break dès qu'on a trouvé le prix
                    break;
                }
            }
        }

        //ordonne le tableau par ses clés
        $ordreSouhaite = ["<2M", "2 à 5M", "5 à 15M", ">15M"];

        //ordonne le tableau par ses clés
        uksort($result, function ($a, $b) use ($ordreSouhaite) {
            return array_search($a, $ordreSouhaite) - array_search($b, $ordreSouhaite);
        });

        return $result;
    }

    /**
     * Retourne le tableau des surfaces
     * @return array
     */
    public function getSurfaces():array
    {
        //1. init un tableau vide
        $surfaces = array();

        //2. itère sur les areas de chaque propriété
        $this->property->with(['areas' => function($query) use(&$surfaces) {
            //2.1 itère sur la listes des areas car les propriétés ont plusieurs areas
            $query->each(function ($item) use(&$surfaces) {
                //2.2 si la propriété est bien un terrain (id = 51)
                if($item->property_area_id === 51){
                    //2.3 rempli le tableau des surfaces
                    $surfaces[]= $item->area;
               }
            });
        }])->get();

        //3. récupère le tableau de config des surfaces
        $config_surface = config('property_areas');

        //4. init un tableau vide
        $result = array();

        //5. itère sur les surfaces
        foreach ($surfaces as $surface) {

            //6. itère sur les surfaces du fichier de config
            foreach ($config_surface as $label => [$min, $max]){

                //7. si la valeur de surface est comprise dans les bornes du tableau
                if ($surface >= $min && $surface <= $max) {

                    //8. set le tableau qui servira de filtre
                    $result[$label] = [$min, $max];
                }
            }
        }

        //ordonne le tableau par ses clés
        $ordreSouhaite = ["<10 ha", "10 à 30 ha", "30 à 100 ha", ">100ha"];

        //ordonne le tableau par ses clés
        uksort($result, function ($a, $b) use ($ordreSouhaite) {
            return array_search($a, $ordreSouhaite) - array_search($b, $ordreSouhaite);
        });

        return $result;
    }

    /**
     * Retourne une selection de propriétés pour la home page
     * @return Collection
     */
    public function getFeaturedProperties(): Collection
    {
        return $this->property->with(['subtype', 'picture', 'city' ,'region' ,'areas'])->get()->take(6);
    }
}
