<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessTranslate;
use App\Jobs\ProcessUserTranslate;
use App\Jobs\x‹ProcessUserTranslate;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function __construct()
    {
        //obligation de mettre l'application en français
        app()->setLocale('fr');
    }

    public function blogTranslate(Blog $blog): \Illuminate\Http\RedirectResponse
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

        ProcessTranslate::dispatch($blog, $array);

        toast('traduction en cours...patience', 'warning', 'top-right');

        return redirect()->route('back.blog.edit', ['blog' => $blog]);
    }

    public function userTranslate(User $user)
    {
        $user->load('biotranslate');

        $array = ['content' => $user->biotranslate->content];

        ProcessUserTranslate::dispatch($user, $array);

        toast('traduction en cours...patience', 'warning', 'top-right');

        return redirect()->route('back.user.edit', ['user' => $user]);
    }
}
