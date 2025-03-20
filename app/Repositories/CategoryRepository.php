<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct(protected readonly Category $category)
    {}

    public function getCategories()
    {
        return $this->category->locale()->withCount('posts')->get(['id', 'name']);
    }
}
