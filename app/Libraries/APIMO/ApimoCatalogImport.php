<?php

namespace App\Libraries\APIMO;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApimoCatalogImport extends ApimoImport
{
    /**
     * Gère l'import APIMO pour le catalogue
     * @param int|null $agency_id
     * @param string|null $timestamp
     * @return void
     * @throws ConnectionException
     * @throws \Exception
     */
    public function import(?int $agency_id, ?string $timestamp): void
    {
        $this->call($agency_id)->save();
    }

    /**
     * Gère le premier appel à l'api apimo
     * @return $this
     * @throws ConnectionException
     * @throws \Exception
     */
    protected function call(?int $agency_id): static
    {
        $this->endPoint = 'https://api.apimo.pro/catalogs';

        //requête server apimo
        $this->response = Http::timeout(0)
            ->withBasicAuth( config('apimo.provider'), config('apimo.token') )
            ->get($this->endPoint, ['limit' => $this->limit, 'offset' => $this->offset])
            ->body();

        //converti les données en json
        $this->toJson();

        return $this;
    }

    /**
     *
     * @return void
     * @throws ConnectionException
     */
    protected function save(): void
    {
        try {
            //1. récupère le fichier catalogs.php dans le répertoire /config
            $file = fopen(base_path() . '/config/catalogs.php', 'w+');

            //2. set un tableau vide
            $configContent = '';

            //3. itère sur le tableau catalogs
            foreach ($this->datas as $cat) {
                $configContent .= " \t'$cat->name' => ['name' => '$cat->name', 'path' => '$cat->path' ],\n";
            }

            //4. set le contenu du fichier config
            $text = "<?php\n return [\t$configContent];";

            //5. Ecris le contenu du fichier
            fwrite($file, $text);

            //6. Appel config cache pour intégrer le fichier
            Artisan::call('config:cache');

            //7. ferme le fichier
            fclose($file);
        } catch (\Exception $exception){
            Log::error('ERROR SAVE CATALOG FROM APIMO :'.$exception->getMessage());
        }

        //8. crée les fichiers models pour le framework
        $this->createModels();

        //9. enregistre les données en bdd
        $this->populateDataFromCatalogs();
    }

    /**
     * Gère la création des models pour toutes les entrées du catalogue
     * Models crées dans le dossier Models/Catalogs
     * @return void
     */
    private function createModels():void
    {
        foreach ( config('catalogs') as $key => $value){

            $file_name = ucwords($key, '_');

            if( !is_dir(base_path() . '/app/Models/Catalogs') ){
                mkdir(base_path() . '/app/Models/Catalogs', 0775, true);
            }

            $file = fopen(base_path() . '/app/Models/Catalogs/'.$file_name.'.php', 'w+');

            $content = "<?php\n";
            $content .= "\nnamespace App\Models\Catalogs;\n\n";
            $content .= "use Illuminate\Database\Eloquent\Model;\n";
            $content .= "\nclass ".$file_name." extends Model\n{\n";
            $content .= "\tprotected ". '$table'." = \"catalog_$key\";\n\n";
            $content .= "\tpublic ".'$incrementing'." = false;\n\n";
            $content .= "\tpublic ".'$timestamps'." = false;\n";
            $content .= "\n\tprotected ".'$fillable'." = ['id', 'locale', 'name', 'name_plurial'];\n";
            $content .= "\n\t".'public function scopeLocale($query)'."\n";
            $content .= "\t{\n";
            $content .= "\t\t".'return $query->where(\'locale\', \'=\', app()->getLocale());'."\n";
            $content .= "\t}\n";
            $content .= "}";

            fwrite($file, $content);

            fclose($file);
        }
    }

    /**
     * Gère l'insertion des données du catalogs en BDD
     * @return void
     * @throws ConnectionException
     */
    public function populateDataFromCatalogs(): void
    {
        //itère sur le catalogs apimo stockés en fichier de config
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
