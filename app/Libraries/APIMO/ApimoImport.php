<?php

namespace App\Libraries\APIMO;

use GuzzleHttp\Client;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

abstract class ApimoImport
{
    protected string $response;

    protected array|\stdClass $datas;

    protected int $numOfresults, $numOfPages, $offset = 0;

    protected int $currentPage = 1;

    protected int $limit = 10000;

    protected ?string $timestamp;

    protected string $endPoint;

    protected ?int $agency_id = null;

    public abstract function import(?int $agency_id, ?string $timestamp):void;

    protected abstract function call(?int $agency_id):static;

    protected abstract function save():void;

    /**
     * Transform les données en json
     * @throws \Exception
     */
    protected function toJson(): static
    {
        try{
            //transform les données recues dans la requête à l'api en json
            $this->datas = json_decode( $this->response );
        } catch (\Exception $exception){
            Log::error('ERROR JSON TRANSFORM ON APIMO\'S DATA: '.$exception->getMessage());
            throw $exception;
        }

        return $this;
    }

    /**
     * Gère la sauvegarde des données
     * @return void
     * @throws \Exception
     */
    protected function saveDatas(): void
    {
        //exception si limite atteinte
        if( !is_array($this->datas) && property_exists($this->datas, 'status') && $this->datas->status != 200){
            throw new \Exception('Limite Apimo Atteinte');
        }

        //set le nombre d'appels à l'api
        $this->numOfPages = ceil($this->datas->total_items / $this->limit);

        //itère sur le nombre de pages possible de la requête
        for($this->currentPage = 1; $this->currentPage <= $this->numOfPages; $this->currentPage++){

            //met à jour l'offset de la requête
            $this->offset = $this->currentPage * $this->limit;

            //sauvegarde les données
            $this->save();

            //rappel la fonction call si
            $this->call($this->agency_id);
        }
    }
}
