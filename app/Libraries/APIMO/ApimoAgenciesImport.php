<?php

namespace App\Libraries\APIMO;

use App\Models\Agency;
use App\Models\City;
use App\Traits\Uploadable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApimoAgenciesImport extends ApimoImport
{
    use Uploadable;

    /**
     * Gère l'appel à l'api APIMO.
     * @param int|null $agency_id
     * @param string|null $timestamp
     * @return void
     * @throws ConnectionException
     * @throws \Exception
     */
    public function import(?int $agency_id, ?string $timestamp): void
    {
        $this->call($agency_id)->saveDatas();
    }

    /**
     * Gère l'appel à l'API APimo
     * @return $this
     * @throws ConnectionException
     * @throws \Exception
     */
    protected function call(?int $agency_id): static
    {
        $this->endPoint = "https://api.apimo.pro/agencies";

        //requête server apimo
        $this->response = Http::timeout(0)
            ->withBasicAuth( config('apimo.provider'), config('apimo.token') )
            ->get($this->endPoint, ['limit' => $this->limit, 'offset' => $this->offset, 'active' => 1])
            ->body();

        //converti les données en json
        $this->toJson();

        return $this;
    }

    /**
     * Gère la sauvegarde des données
     * @return void
     */
    protected function save(): void
    {

        //itère sur les données de l'api
        foreach ($this->datas->agencies as $agency) {

            //enregistre uniquement les agences actives
            if ($agency->active && $agency->id == 2421) {

                //sauv. le model en bdd.
                Agency::updateOrCreate(
                    [
                        'id' => $agency->id,
                    ], [
                    'id' => $agency->id,
                    'is_christies' => true,
                    'is_active' => (bool)$agency->active,
                    'name' => $agency->name,
                    'address' => $agency->address,
                    'postal' => $agency->city->zipcode,
                    'city_id' => $this->setCity($agency->city),
                    'country' => $agency->country,
                    'region' => $agency->region,
                    'latitude' => $agency->latitude,
                    'longitude' => $agency->longitude,
                    'email' => $agency->email,
                    'phone' => $agency->phone ?? '00',
                    'fax' => $agency->fax ?? '00',
                    'logo' => $this->uploadAgencyLogo($agency->logo),
                    'logo_svg' => $agency->logo_svg,
                    'picture' => $this->uploadAgencyPicture($agency->picture),
                    ]);
            }

            //tempo pour limiter les faux imports
            sleep(0.2);
        }
    }

    /**
     * Gère l'insertion de la ville / city
     * @param \stdClass $city
     * @return int
     */
    private function setCity(\stdClass $city):int
    {
        //Sauv. la ville en bdd.
        $city = City::updateOrCreate([
            'id' => $city->id,
        ],[
            'id' => $city->id,
            'name' => $city->name,
            'zipcode' => $city->zipcode,
            'prefix_code' => substr($city->zipcode, 0, 2),
            'slug' => Str::slug($city->name),
        ]);

        return $city->id;
    }
}
