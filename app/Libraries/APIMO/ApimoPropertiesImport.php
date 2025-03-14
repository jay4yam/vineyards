<?php

namespace App\Libraries\APIMO;

use App\Models\Agency;
use App\Models\Properties\Area;
use App\Models\City;
use App\Models\Properties\Comment;
use App\Models\District;
use App\Models\Properties\Picture;
use App\Models\Properties\Property;
use App\Models\Region;
use App\Models\Properties\Regulation;
use App\Models\Properties\Tag;
use App\Traits\Uploadable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApimoPropertiesImport extends ApimoImport
{
    use Uploadable;

    /**
     * Gère l'import des propriétés depuis apimo
     * @param int|null $agency_id
     * @param string|null $timestamp
     * @return void
     * @throws ConnectionException
     * @throws \Exception
     */
    public function import(?int $agency_id, ?string $timestamp): void
    {
        //set le timestamp si il existe
        $this->timestamp = $timestamp ?? '';

        //si l'id est nulle
        if($agency_id){

            $this->agency_id = $agency_id;

            //on appel le call avec l'id direct
            $this->call($this->agency_id)->saveDatas();
        }else{
            //on itère sur la liste des agences en bdd
            foreach (Agency::isPublic()->get() as $agency)
            {
                $this->call($agency->id)->saveDatas();
            }
        }
    }

    /**
     * Effectue l'appel à l'api apimo
     * @throws ConnectionException
     * @throws \Exception
     */
    protected function call(?int $agency_id): static
    {
        //endpoint
        $this->endPoint = "https://api.apimo.pro/agencies/{$agency_id}/properties";

        //requête server apimo
        $this->response = Http::timeout(0)
            ->withBasicAuth(config('apimo.provider'), config('apimo.token'))
            ->get($this->endPoint, ['step' => 1, 'status' => 1, 'timestamp' => $this->timestamp])
            ->body();

        //converti les données en json
        $this->toJson();

        //retourne les données
        return $this;
    }

    /**
     * Gère la sauv. des données de l'api
     * @return void
     */
    protected function save(): void
    {
        //itère sur les données pour enregistrement
        foreach ($this->datas->properties as $property) {

            //ne prend en compte que les produits vignobles dont la reference commence par MZVST
            if( str_starts_with($property->reference, 'MZVST') && $property->reference === 'MZVST006') {

                try {

                    //crée une nouvelle region
                    if (!empty($property->region)) {

                        //gère la région réçue en paramètre
                        $newRegion = Region::updateOrCreate(
                            [
                                'id' => $property->region->id,
                            ],
                            [
                                'id' => $property->region->id,
                                'name' => $property->region->name,
                                'slug' => Str::slug($property->region->name)
                            ]
                        );
                    }

                    //crée une nouvelle ville
                    if (!empty($property->city)) {

                        //gère la ville réçue en paramètre
                        $newCity = City::updateOrCreate(
                            [
                                'id' => $property->city->id,
                            ],
                            [
                                'id' => $property->city->id,
                                'name' => $property->city->name,
                                'zipcode' => $property->city->zipcode,
                                'slug' => Str::slug($property->city->name)
                            ]);
                    }

                    //crée un nouveau district
                    $newDistrict = null;
                    if (!empty($property->district)) {

                        //gère le district réçue en paramètre
                        $newDistrict = District::updateOrCreate(
                            [
                                'id' => $property->district->id
                            ],
                            [
                                'id' => $property->district->id,
                                'name' => $property->district->name,
                                'slug' => Str::slug($property->district->name)
                            ]
                        );
                    }

                    //créer une nouvelle propriété
                    Property::updateOrCreate(
                        [
                            'id' => $property->id,
                            'reference' => $property->reference,
                        ], [
                        'id' => $property->id,
                        'reference' => $property->reference,
                        'agency_id' => $property->agency,
                        'sector' => $property->sector,
                        'user_id' => $property->user->id,
                        'step_id' => $property->step,
                        'status_id' => $property->status,
                        'parent_id' => $property->parent,
                        'category_id' => $property->category,
                        'subcategory_id' => $property->subcategory,
                        'name' => $property->name,
                        'type_id' => $property->type,
                        'subtype_id' => $property->subtype,
                        'agreement_id' => $property->agreement?->type,
                        'block_name' => $property->block_name,
                        'lot_reference' => $property->lot_reference,
                        'cadastre_reference' => $property->cadastre_reference,
                        'address' => $property->address,
                        'address_more' => $property->address_more,
                        'is_published_address' => (bool)$property->publish_address,
                        'country' => $property->country,
                        'region_id' => $newRegion->id,
                        'city_id' => $newCity->id,
                        'district_id' => ($newDistrict === null) ? null : $newDistrict->id,
                        'longitude' => $property->longitude,
                        'latitude' => $property->latitude,
                        'radius' => $property->radius,
                        'altitude' => $property->altitude,
                        'area_id' => $property->area->unit,
                        'area_value' => $property->area->value,
                        'area_total' => $property->area->total,
                        'area_weighted' => $property->area->weighted,
                        'plot_net_floor' => $property->plot->net_floor,
                        'plot_floor_area' => $property->plot->land_type,
                        'rooms' => $property->rooms,
                        'bedrooms' => $property->bedrooms,
                        'sleeps' => $property->sleeps,
                        'price' => $property->price->value ?? 0,
                        'currency' => $property->price->currency,
                        'view_type_id' => $property->view?->type,
                        'landscape' => json_encode($property->view->landscape),
                        'construction_method_id' => $this->handleConstructionMethod($property->construction),
                        'construction_year' => $property->construction->construction_year,
                        'construction_step_id' => $property->construction->construction_step,
                        'floor_id' => $property->floor?->type,
                        'floor_value' => $property->floor?->value ?? 0,
                        'floor_level' => $property->floor?->levels ?? 0,
                        'floor_total' => $property->floor?->floors ?? 0,
                        'heating_device_id' => $property->heating->device,
                        'heating_access_id' => $property->heating->access,
                        'heating_type_id' => $property->heating->type,
                        'water_hot_device_id' => $property->water->hot_device,
                        'hot_water_access_id' => $property->water->hot_access,
                        'waste_water_id' => $property->water->waste,
                        'condition_id' => $property->condition,
                        'standing_id' => $property->standing,
                        'style' => $property->style->name,
                        'facade' => $property->facades,
                        'availability_id' => $property->availability,
                        'available_at' => $property->available_at,
                        'delivered_at' => $property->delivered_at,
                        'activities' => $property->activities ? json_encode($property->activities) : null,
                        'orientations' => json_encode($property->orientations),
                        'services' => json_encode($property->services),
                        'proximities' => json_encode($property->proximities),
                    ]);

                    //Enregistrement des tag_customized
                    if ( ! empty($property->tags_customized) ) {

                        foreach ($property->tags_customized as $tag) {

                            try {
                                $tags = Tag::updateOrCreate(
                                    ['id' => $tag->id],
                                    [
                                        'id' => $tag->id,
                                        'locale' => app()->getLocale(),
                                        'label' => $tag->label,
                                        'value' => $tag->value,
                                    ]);

                                $tags->properties()->attach($property->id);

                            } catch (\Throwable $throwable) {
                                Log::error('save Tag error' . $throwable->getMessage());
                            }
                        }
                    }

                    //enregistrement les textes des produits
                    if ( ! empty($property->comments) ) {

                        //itère sur la liste des commentaires
                        foreach ($property->comments as $comment) {

                            try {
                                Comment::updateOrCreate(
                                    [
                                        'property_id' => $property->id,
                                        'locale' => $comment->language,
                                    ],
                                    [
                                        'locale' => $comment->language,
                                        'title' => $comment->title,
                                        'subtitle' => $comment->subtitle,
                                        'hook' => $comment->hook,
                                        'comment' =>  $comment->comment,
                                        'comment_full' => $comment->comment_full,
                                        'property_id' => $property->id,
                                    ]);

                            } catch (\Throwable $throwable) {
                                Log::error('save ' . $comment->language . ' Comment error' . $throwable->getMessage());
                            }
                        }
                    }

                    //enregistrement des surfaces / areas
                    if (!empty($property->areas)) {

                        foreach ($property->areas as $area) {

                            try {
                                Area::updateOrCreate(
                                    [
                                        'property_area_id' => $area->type,
                                        'property_id' => $property->id,
                                    ],
                                    [
                                        'property_area_id' => $area->type,
                                        'number' => $area->number,
                                        'area' => $area->area,
                                        'property_flooring_id' => $area->flooring,
                                        'floor' => json_encode($area->floor),
                                        'orientations' => json_encode($area->orientations),
                                        'comment' => $area->comments,
                                        'property_id' => $property->id,
                                    ]);
                            } catch (\Throwable $throwable) {
                                Log::error('save Area error' . $throwable->getMessage());
                            }
                        }
                    }

                    //enregistrement des regulations ( lois et autres joyeusetés ).
                    if (!empty($property->regulations)) {

                        //itère sur les données
                        foreach ($property->regulations as $regulation) {

                            try {
                                $newRegulation = Regulation::updateOrCreate(
                                    [
                                        'property_regulation_id' => $regulation->type,
                                        'property_id' => $property->id
                                    ],
                                    [
                                        'property_regulation_id' => $regulation->type,
                                        'value' => $regulation->value,
                                        'date' => $regulation->date,
                                        'label' => $regulation->label,
                                        'graph' => $regulation->graph,
                                        'property_id' => $property->id
                                    ]);

                                //enregistre sous forme d'image les DPE
                                if (in_array($regulation->type, [1, 2], false)) {

                                    $filename = null;

                                    if (!empty($regulation->graph)) {
                                        $filename = sprintf('%s.svg', md5($regulation->graph));

                                        $binary = str_replace('data:image/svg+xml;base64,', '', $regulation->graph);

                                        Storage::disk('public')->put("/dpe/{$filename}", base64_decode($binary));

                                        $newRegulation->image = $filename;

                                        $newRegulation->save();
                                    }
                                }

                            } catch (\Throwable $throwable) {
                                Log::error('save Regulation error' . $throwable->getMessage());
                            } finally {
                                unset($binary);
                                unset($filename);
                                unset($newRegulation);
                            }
                        }
                    }

                    //Enregistrement des photos
                    if (!empty($property->pictures)) {

                        foreach ($property->pictures as $picture) {

                            try {

                                Picture::updateOrCreate(
                                    ['id' => $picture->id],
                                    [
                                        'id' => $picture->id,
                                        'rank' => $picture->rank,
                                        'url' => $picture->url,
                                        'name' => $this->uploadPropertyPicture($picture),
                                        'width_max' => $picture->width_max,
                                        'height_max' => $picture->height_max,
                                        'internet' => (bool)$picture->internet,
                                        'printer' => (bool)$picture->print,
                                        'child' => (bool)$picture->child,
                                        'reference' => $picture->reference,
                                        'property_id' => $property->id,
                                    ]);

                            } catch (\Throwable $throwable) {
                                Log::error('save Picture error' . $throwable->getMessage());
                            }
                        }
                    }

                } catch (\Exception $exception) {
                    Log::error('save property error :' . $property->reference . ' - ' . $exception->getMessage());
                } finally {
                    unset($newCity);
                    unset($newRegion);
                    unset($newDistrict);
                }
            }
        }
    }

    /**
     * @param \stdClass $constructionMethod
     * @return int|null
     */
    private function handleConstructionMethod(\stdClass $constructionMethod):int|null
    {
        if( !empty($constructionMethod->method) ){
            return $constructionMethod->method[0];
        }

        return null;
    }
}
