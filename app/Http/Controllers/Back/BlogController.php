<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    public function __construct(public BlogRepository $blogRepository)
    {
        //obligatoire de mettre le site en fr
        app()->setLocale('fr');
    }

    /**
     * Retourne la vue de tous les articles de blogs pour le backoffice
     * @return View
     */
    public function index(): View
    {
        $articles = $this->blogRepository->getAll();

        return view('admin.blogs.index', compact('articles'));
    }

    /**
     * Affiche la vue de création d'un article
     * @return View
     */
    public function create(): View
    {
        return view('admin.blogs.create');
    }

    /**
     * Gère l'ajout d'un nouvel article
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try{

            $blog = $this->blogRepository->store($request);

            toast('article inserted successfully', 'success', 'top-right');

            return redirect()->route('back.blog.edit', [app()->getLocale(), 'blog' => $blog]);

        }catch (\Exception $exception){
            Log::error($exception->getMessage());

            toast('error '. $exception->getMessage(),'error', 'top-right');

            return back();
        }
    }

    /**
     * Affiche la vue d'édition d'un article de blog
     * @param string $locale
     * @param Blog $backblog
     * @return View
     */
    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Met à jour un article
     * @param Request $request
     * @param string $locale
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {
        try{

            $this->blogRepository->update($request, $blog);

        }catch (\Exception $exception){
            Log::error($exception);

            toast('error update article '.$exception->getMessage(), 'error', 'top-right');

            return back();
        }

        toast('article updated with success', 'success', 'top-right');

        return back();
    }

    /**
     * Supprime un article de blog
     * @param string $locale
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        try{
            $blog->delete();

            toast('article deleted with success', 'warning', 'top-right');

            return back();

        }catch (\Exception $exception){

            Log::error('error on delete blog article');

            toast('error delete article '.$exception->getMessage(), 'error', 'top-right');

            return back();
        }
    }
}
