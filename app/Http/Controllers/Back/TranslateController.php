<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessTranslate;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function blogTranslate($locale, Blog $blog): \Illuminate\Http\RedirectResponse
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

        return redirect()->route('backblog.edit', [app()->getLocale(), 'backblog' => $blog]);
    }
}
