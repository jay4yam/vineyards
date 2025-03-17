<?php

namespace App\View\Composers;

use Illuminate\View\View;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ChangeLangageComposer
{

    /**
     * Retourne la liste des url alternatives par langues
     * @param array|SEOData $seoData
     * @return array
     */
    private function getLangageLinks(array|SEOData $seoData): array
    {
        //init un tableau vide.
        $arrayLinks = array();

        //itère les données du seoData pour récupérer les hreflang
        foreach ($seoData->alternates as $alternates)
        {
            //ne prend pas en compte la langue par defaut
            if($alternates->attributes['hreflang'] != "x-default")
            {
                //peuple le tableau avec les données
                $arrayLinks[ $alternates->attributes['hreflang'] ] = $alternates->attributes['href'];
            }
        }

        return $arrayLinks;
    }

    public function compose(View $view)
    {
        $view->with('langageLinks', $this->getLangageLinks( $view->getData()['seoData'] ));
    }
}
