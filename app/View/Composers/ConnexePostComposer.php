<?php

namespace App\View\Composers;

use App\Repositories\BlogRepository;
use App\Services\BlogService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class ConnexePostComposer
{
    public function __construct(public BlogService $blogService)
    {}

    /**
     * Retourne les deux articles connexes
     * @return Collection
     */
    private function getConnexePosts(): Collection
    {
        return $this->blogService->getConnexePosts();
    }

    public function compose(View $view): void
    {
        $view->with('connexePosts', $this->getConnexePosts());
    }
}
