<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function __construct(protected readonly Tag $tag)
    {}

    /**
     * Récupère les tags des blogs et les comptes
     * @return mixed
     */
    public function getTags()
    {
        return $this->tag->locale()->whereHas('posts')->with('posts')->get(['id', 'name']);
    }
}
