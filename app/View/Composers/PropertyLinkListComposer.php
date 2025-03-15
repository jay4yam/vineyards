<?php

namespace App\View\Composers;

use App\Models\Properties\Property;
use Illuminate\View\View;

class PropertyLinkListComposer
{
    /**
     * Récupère la propriété précédente en bdd (de celle passée en paramètre)
     * @param Property $property
     * @return Property|null
     */
    private function getPreviousProperty(Property $property): ?Property
    {
        return Property::with('comment:property_id,title')
            ->where('id', '<', $property->id)->first(['id']);
    }

    /**
     * Récupère la propriété suivante en bdd (de celle passée en paramètre)
     * @param Property $property
     * @return Property|null
     */
    private function getNextProperty(Property $property): ?Property
    {
        return Property::with('comment:property_id,title')
            ->where('id', '>', $property->id)->first(['id']);
    }

    public function compose(View $view)
    {
        $view->with('previousProperty', $this->getPreviousProperty($view->getData()['property']) );
        $view->with('nextProperty', $this->getNextProperty($view->getData()['property']) );
    }

}
