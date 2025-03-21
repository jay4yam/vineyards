<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct(protected CategoryRepository $categoryRepository) {}

    /**
     * Gère l'insertion et la mise à jour dans la même methode
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        //si la requête contient update
        if($request->create_or_update === 'update')
        {
            try {
                //mise à jour de la catégorie
                $this->categoryRepository->update($request, $category);

                toast('category updated successfully!', 'success', 'top-right');

                return redirect()->route('back.blog.index');

            }catch (\Exception $exception){

                Log::error('error on update category '.$exception->getMessage());

                toast('error on category update!', 'error', 'top-right');

                return redirect()->route('back.blog.index');
            }

        }

        //si la requête contient update
        if ($request->create_or_update === 'create'){
                try{

                    $this->categoryRepository->store($request);

                    toast('category saved successfully!', 'success', 'top-right');

                    return redirect()->route('back.blog.index');

                }catch (\Exception $exception){
                    Log::error('error on update category '.$exception->getMessage());

                    toast('error on category update!', 'error', 'top-right');

                    return redirect()->route('back.blog.index');
                }
        }
    }

    /**
     * Supprime une catégorie
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        //récupère les posts d'un article
        $category->load('posts');

        //si il y a des posts
        if(count($category->posts)){
            //récupère la liste des articles
            $blogs = $category->posts()->pluck('id');

            //détache la catégories des articles
            $category->posts()->detach($blogs);
        }

        //supprime la catégorie
        $category->delete();

        toast('category deleted successfully!', 'warning', 'top-right');

        return redirect()->route('back.blog.index');
    }
}
