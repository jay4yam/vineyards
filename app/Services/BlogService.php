<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    public function __construct(public Blog $blog)
    {
    }

    /**
     * Renvoie la liste paginée des articles
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return $this->blog->with(['user','tags', 'category', 'translate'])
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    /**
     * Retourne la liste des 5 derniers articles publiée
     * @return mixed
     */
    public function getLastArticles(): mixed
    {
        return $this->blog->latest()->take(5)->get();
    }

    /**
     * Retourne deux articles connexes
     * @return Collection
     */
    public function getConnexePosts(): Collection
    {
        return $this->blog->with('translate')->take(2)->get();
    }
}
