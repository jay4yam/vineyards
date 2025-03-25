<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Services\BlogService;
use App\Traits\Seoable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use Seoable;

    public function __construct(public BlogService $blogService)
    {}

    /**
     * @return View
     */
    public function index():View
    {
        $blogs = $this->blogService->getPaginate();

        return view('blogs.index', ['blogs' => $blogs, 'seoData' => $this->seoBlogIndex()]);
    }

    /**
     * Retourne la vue détaillée d'un article de blog
     * @param Blog $blog
     * @return View
     */
    public function show(string $locale, Blog $blog):View
    {
        $blog->load(['user', 'tags', 'categories', 'translate', 'translates']);

        return view('blogs.show', ['blog' => $blog, 'seoData' => $this->seoBlogShow($blog)]);
    }
}
