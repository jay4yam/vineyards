<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

trait Uploadable
{

    /**
     * Upload l'image de l'avatar de l'utilisateur
     * @param UploadedFile $file
     * @return string
     */
    public function uploadAvatar(UploadedFile $file): string
    {
        //3.1. chemin de stockage du fichier
        $path = storage_path('app/public/user' );

        //3.2. nom du fichier image
        $fileName = time().'-user.'.$file->extension();

        //3.3 si le répertoire n'existe pas
        if(! is_dir($path)) mkdir( $path, 0775, true);

        $image = Image::read($file);

        //3.4. resize et upload du fichier
        $image->scale(width: 400)->save( $path.'/'.$fileName);

        //3.5. maj de l'attribut
        return $fileName;
    }

    /**
     * Gère Upload de la photo agence
     * @param UploadedFile $file
     * @return void
     */
    public function uploadPicture(UploadedFile $file): void
    {
        //3.2. nom du fichier image
        $fileName = time().'-'.Str::slug( $this->name ).'-'.Str::slug( $this->city ).'.'.$file->extension();

        //utilise la lib image/intervention
        $image = Image::read($file);

        //set chemin des images full size
        $pathFull = public_path('storage/agencies/full/');

        //set chemin des images mid size
        $pathMedium = public_path('storage/agencies/medium/');

        //set chemin des images small size
        $pathSmall = public_path('storage/agencies/small/');

        //test les différents chemins
        if(!is_dir($pathFull) || !is_dir($pathMedium) || !is_dir($pathSmall)){
            mkdir($pathFull, 0775, true);
            mkdir($pathMedium , 0775, true);
            mkdir($pathSmall , 0775, true);
        }

        try {
            //sauv. le fichier original
            $image->save($pathFull . $fileName );

            //sauv. une version scaller à 800px
            $image->scale(width: 800)->save( $pathMedium . $fileName );

            //sauv. une version scaller à 450px
            $image->scale(width: 450)->save( $pathSmall . $fileName);
        }catch (\Exception $exception){
            Log::error('erreur upload picture agency :'.$exception->getMessage());
        }

        //3.5. maj de l'attribut
        $this->picture = $fileName;
    }


    /**
     * Upload du logo de l'agence
     * @param string|null $logoUrl
     * @return string
     */
    protected function uploadAgencyLogo(?string $logoUrl = null):string
    {
        if(null != $logoUrl)
        {
            //Récupère l'url de l'image
            $url = $logoUrl;

            //Récupère les informations du fichier
            $pathInfo = pathinfo($url);

            //génère un nom de fichier avant enregistrement
            $filename = 'agency-logo-'.time().'.'.$pathInfo['extension'];

            //test si le file_get_contents est OK
            if( file_get_contents($url) ){

                //récupère le fichier image
                $content = file_get_contents($url);

                //utilise la lib image/intervention
                $image = Image::read($content);

                //set chemin des images full size
                $pathFull = public_path('storage/agencies/');

                //test les différents chemins
                if(!is_dir($pathFull)){
                    mkdir($pathFull, 0775, true);
                }

                try {
                    //sauv. le fichier original
                    $image->save($pathFull . $filename );

                }catch (\Exception $exception){
                    Log::error('erreur upload logo agency :'.$exception->getMessage());
                }
            }

            return $filename;
        }

        return 'default-logo.jpg';
    }

    /**
     * Upload picture Agency
     * @param string|null $pictureUrl
     * @return string
     */
    protected function uploadAgencyPicture(?string $pictureUrl = null): string
    {
        if(null != $pictureUrl){
            //Récupère l'url de l'image
            $url = $pictureUrl;

            //Récupère les informations du fichier
            $pathInfo = pathinfo($url);

            //génère un nom de fichier avant enregistrement
            $filename = 'agency-picture-'.time().'.'.$pathInfo['extension'];

            //test si le file_get_contents est OK
            if( file_get_contents($url) ){

                //récupère le fichier image
                $content = file_get_contents($url);

                //utilise la lib image/intervention
                $image = Image::read($content);

                //set chemin des images full size
                $pathFull = public_path('storage/agencies/');

                //test les différents chemins
                if(!is_dir($pathFull) ){
                    mkdir($pathFull, 0775, true);
                }

                try {
                    //sauv. le fichier original
                    $image->save($pathFull . $filename );

                }catch (\Exception $exception){
                    Log::error('erreur upload picture agency :'.$exception->getMessage());
                }
            }

            return $filename;
        }

        return 'default.jpg';
    }

    /**
     * Upload picture Agency
     * @param string|null $userPictureUrl
     * @return string
     */
    protected function uploadUserPicture(?string $userPictureUrl = null): string
    {
        if(null != $userPictureUrl) {


            //Récupère l'url de l'image
            $url = $userPictureUrl;

            //Récupère les informations du fichier
            $pathInfo = pathinfo($url);

            //génère un nom de fichier avant enregistrement
            $filename = 'avatar-' . time() . '.' . $pathInfo['extension'];

            //test si le file_get_contents est OK
            if (file_get_contents($url)) {

                //récupère le fichier image
                $content = file_get_contents($url);

                //utilise la lib image/intervention
                $image = Image::read($content);

                //set chemin des images full size
                $pathFull = public_path('storage/user/');

                //test les différents chemins
                if (!is_dir($pathFull)) {
                    mkdir($pathFull, 0775, true);
                }

                try {
                    //sauv. une version scaller à 500px
                    $image->scale(width: 500)->save($pathFull . $filename);
                } catch (\Exception $exception) {
                    Log::error('erreur upload user picture avatar :' . $exception->getMessage());
                }
            }

            return $filename;
        }

        return 'default.jpg';
    }

    /**
     * Gère l'enregistrement d'une photo de propriété
     * @param \stdClass $picture
     * @return string
     */
    protected function uploadPropertyPicture(string $reference, \stdClass $picture):string
    {
        //Récupère l'url de l'image
        $url = $picture->url;

        //Récupère les informations du fichier
        $pathInfo = pathinfo($url);

        //génère un nom de fichier avant enregistrement
        $filename = $pathInfo['basename'];

        //récupère le fichier image
        $content = file_get_contents($url);

        //test si le file_get_contents est OK
        if( $content ){

            //utilise la lib image/intervention
            $image = Image::read($content);

            //set chemin des images small size
            $pathSmall = public_path('storage/properties/'.$reference.'/');

            //test les différents chemins
            if( ! is_dir($pathSmall) ){
                mkdir($pathSmall , 0775, true);
            }

            //sauvegarde une version scaller à 800px
            $image->scale(width: 1920)->save( $pathSmall . $filename );

            return $filename;
        }

        return 'default.jpg';
    }

    /**
     * Upload l'image de l'avatar de l'utilisateur
     * @param UploadedFile $file
     * @return string $filename
     */
    public function uploadBlogPicture(UploadedFile $file): string
    {
        //3.1. chemin de stockage du fichier
        $path = storage_path('app/public/blog' );

        //3.2. nom du fichier image
        $fileName = time().'-blog.'.$file->extension();

        //3.3 si le répertoire n'existe pas
        // on le crée
        if(! is_dir($path)) mkdir( $path, 0775, true);

        $image = Image::read($file);

        //3.4. resize et upload du fichier
        $image->scale(width: 850)->save( $path .'/'. $fileName );

        return $fileName;
    }
}
