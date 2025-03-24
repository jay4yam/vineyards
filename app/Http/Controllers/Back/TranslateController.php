<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBlogTranslate;
use App\Jobs\ProcessListeSeoTranslate;
use App\Jobs\ProcessUserTranslate;
use App\Jobs\x‹ProcessUserTranslate;
use App\Models\Blog;
use App\Models\ListeSeo;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function __construct()
    {
        //obligation de mettre l'application en français
        app()->setLocale('fr');
    }

    /**
     * Gère la traduction des articles de blog
     * @param Blog $blog
     * @return RedirectResponse
     */
    public function blogTranslate(Blog $blog): RedirectResponse
    {
        $blog->load('translate');

        $array = [
            "title" => $blog->translate->title,
            "intro" => $blog->translate->intro,
            "content" => $blog->translate->content,
            "slug" => $blog->translate->slug,
            "meta_title" => $blog->translate->meta_title,
            "meta_desc" => $blog->translate->meta_desc
        ];

        ProcessBlogTranslate::dispatch($blog, $array);

        toast('traduction en cours...patience', 'warning', 'top-right');

        return redirect()->route('back.blog.edit', ['blog' => $blog]);
    }


    /**
     * Gère la traduction de la bio de l'utilisateur
     * @param User $user
     * @return RedirectResponse
     */
    public function userTranslate(User $user): RedirectResponse
    {
        $user->load('biotranslate');

        $array = ['content' => $user->biotranslate->content];

        ProcessUserTranslate::dispatch($user, $array);

        toast('traduction en cours...patience', 'warning', 'top-right');

        return redirect()->route('back.user.edit', ['user' => $user]);
    }


    /**
     * Gère les traduction des listes Seo
     * @param ListeSeo $listeseo
     * @return RedirectResponse
     */
    public function listeseoTranslate(ListeSeo $listeseo): RedirectResponse
    {
        $listeseo->load('translate');

        $array = [
            'meta_title_seo' => $listeseo->translate->meta_title_seo,
            'meta_description_seo' => $listeseo->translate->meta_description_seo,
            'header_h1' => $listeseo->translate->header_h1,
            'intro' => $listeseo->translate->intro,
            'content' => $listeseo->translate->content,

        ];

        ProcessListeSeoTranslate::dispatch($listeseo, $array);

        toast('traduction en cours...patience', 'warning', 'top-right');

        return redirect()->route('back.listeseo.edit', ['listeseo' => $listeseo]);
    }
}
