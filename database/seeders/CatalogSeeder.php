<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ( config('catalogs') as $key => $value ) {

            //set le nom du model
            $model_name = ucwords($key, '_');

            //itère sur les langues de l'application
            foreach (config('app.available_locales') as $lang => $culture){

                //requête API Apimo
                $request = Http::withBasicAuth( config('apimo.provider'), config('apimo.token') )
                    ->get( $value['path'], ['culture' => $culture] )
                    ->body();

                //converti la reponse en stdClass
                $response = json_decode($request);

                //itère sur les entrées du fichier
                foreach ($response as $item){

                    //set le nom de model
                    $model = "App\\Models\\Catalogs\\".$model_name;

                    //met à jour les entrées en BDD
                    $model::updateOrCreate(
                        [
                            'id' => $item->id,
                            'locale' => $culture
                        ],
                        [
                            'id' => $item->id,
                            'locale' => $culture,
                            'name' => $item->name,
                            'name_plurial' => $item->name_plurial ?? null
                        ]);
                }
            }
        }
    }
}
