<?php

namespace App\View\Composers;

use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use App\Services\BlogService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class BlogComposer
{
    public function __construct(private readonly BlogService $blogService,
                                private readonly CategoryRepository $categoryRepository,
                                private readonly TagRepository $tagRepository)
    {}

    /**
     * Récupère toutes les catégories et décompte du nombre d'article
     * @return mixed
     */
    public function getCategories():Collection
    {
        return $this->categoryRepository->getCategories();
    }

    /**
     * Récupère les 5 derniers articles
     * @return mixed
     */
    private function getLastArticles():Collection
    {
        return $this->blogService->getLastArticles();
    }

    private function getAllTags():Collection
    {
        return $this->tagRepository->getTags();
    }

    public function compose(View $view): void
    {
        $view->with('allCategories', $this->getCategories());
        $view->with('lastArticles', $this->getLastArticles());
        $view->with('allTags', $this->getAllTags());
    }
}
