<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryRepository
{
    public function __construct(protected readonly Category $category)
    {}


    /**
     * Retourne toutes les categories
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->category->withCount('posts')->get();
    }

    public function getCategories()
    {
        return $this->category->locale()->withCount('posts')->get(['id', 'name']);
    }


    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->input('categorie');

        $category->locale = $request->input('locale');

        $category->save();
    }

    /**
     * Gère la mise à jour d'une catégorie
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        $category->update(['name' => $request->get('categorie')]);

        $category->save();
    }
}
