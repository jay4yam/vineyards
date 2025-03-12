<?php

namespace App\View\Composers;

use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class PropertyHomeComposer
{
    public function __construct(private readonly PropertyRepository $propertyRepository)
    {}

    public function getFeatured()
    {
        return $this->propertyRepository->getFeaturedProperties();
    }

    public function compose(View $view): void
    {
        $view->with('featuredProperties', $this->getFeatured());
    }
}
