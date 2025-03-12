<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Services\BlogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function __construct(public BlogService $blogService)
    {}

    /**
     * @return View
     */
    public function index():View
    {
        $blogs = $this->blogService->getPaginate();

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Retourne la vue détaillée d'un article de blog
     * @param string $locale
     * @param Blog $blog
     * @return View
     */
    public function show(string $locale, Blog $blog):View
    {
        $blog->load(['user', 'tags', 'categories']);

        return view('blogs.show', compact('blog'));
    }
}
