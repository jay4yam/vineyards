<?php

namespace App\Repositories;

use App\Models\Blog;
use App\traits\Uploadable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogRepository
{
    use Uploadable;

    public function __construct(protected Blog $blog)
    {
    }

    /**
     * Retourne tous les articles pour le backoffice
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->blog->with(['user','tags', 'categories', 'translate', 'translates'])
            ->orderBy('id', 'desc')->paginate(10);
    }


    public function store(Request $request): Blog
    {
        $blog = new Blog();

        $this->save($request, $blog);

        return $blog;
    }

    /**
     * Gère la mise à jour des articles
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    public function update(Request $request, Blog $blog):void
    {
        $this->save($request, $blog);
    }

    /**
     * Gère la sauvegarde d'un article en bdd
     * @param Request $request
     * @param Blog $blog
     * @return void
     */
    private function save(Request $request, Blog $blog)
    {
        //1. sauv. les items du blogs
        $blog->fill($request->all());

        $blog->save();

        //2. sauv. l'image du blog
        if($request->has('image')){
            $blog->image = $this->uploadBlogPicture($request->file('image'));
        }

        //3. met à jour la partie contenu
        if($request->has('translate')) {
            //itère sur les langues envoyées par le formulaire d'edition
            foreach ($request['translate'] as $locale => $translation) {

                //mets à jour le model translate par langue
                $blog->translates()->where('locale', '=', $locale)
                    ->updateOrCreate([
                        'blog_id' => $blog->id,
                    ], [
                        'locale' => $locale,
                        'title' => $translation['title'],
                        'intro' => $translation['intro'],
                        'content' => $translation['content'],
                        'slug' => Str::slug($translation['slug']),
                        'meta_title' => $translation['meta_title'],
                        'meta_desc' => $translation['meta_desc'],
                    ]);
            }
        }

        $blog->save();
    }
}
