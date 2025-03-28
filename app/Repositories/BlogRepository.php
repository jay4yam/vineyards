<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Traits\Uploadable;
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

        //4. met à jour la catégorie de l'article
        if($request->has('category')) {

            //récupère toutes les catégories en cours de l'article
            $blog_categories = $blog->categories()->pluck('id')->toArray();

            //détache toutes les catégories d'un article en cours
            $blog->categories()->detach($blog_categories);

            //sauv. et lie le blog avec les catégories
            foreach ($request['category'] as $locale => $b_category) {
                $blog->categories()->attach($b_category);
            }
        }

        //5. met à jour les tags de l'article
        if($request->has('tags_list')) {

            //récupère tous les tags attaché à un article
            $blog_tags = $blog->tags()->pluck('id')->toArray();

            //détache tous les tags déjà liés à un article
            $blog->tags()->detach($blog_tags);

            //itère sur les tags
            foreach ($request['tags_list'] as $locale => $tag) {

                //transforme la string en array
                $tagArray = explode(',', $tag);

                //itère sur la liste tagArray
                foreach ($tagArray as $tag_value) {

                    //si tag_value est de type numeric
                    if( is_numeric($tag_value)){
                        //on attache le blog avec l'id du tag
                        $blog->tags()->attach(intval($tag_value));
                    }else{
                        //sinon on doit créer un nouveau tag
                        $blog->tags()->create([
                            'name' => $tag_value,
                            'type' => 'blog',
                            'locale' => $locale
                        ]);
                    }
                }
            }
        }

        //sauv. l'article.
        $blog->save();
    }
}
