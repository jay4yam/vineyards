<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Traits\ChatGpT;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class ProcessBlogTranslate implements ShouldQueue
{
    use Queueable, ChatGpT;

    public int $timeout = 0;

    /**
     * Create a new job instance.
     */
    public function __construct(public Blog $blog, public array $itemToTranslate)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //1. récupère les langues définies dans le fichier de config.
        $allLangues = config('app.available_locales');

        //1bis. supprime le français des langues à traduire
        array_splice($allLangues, 0, 1);

        //2. itère sur toutes les langues
        foreach ($allLangues  as $langage => $locale)
        {
            //3. utilise chatGPT pour la traduction des items à traduires
            $arrayTranslated = $this->requestChatGpt($this->itemToTranslate, $locale);

            //4. check le tableau de traduction
            if( ! empty($arrayTranslated) ) {

                //5. sauv. les traductions des articles
                $this->blog->translates()
                    ->where('locale', '=', $locale)
                    ->updateOrCreate([
                        'blog_id' => $this->blog->id,
                    ], [
                        'locale' => $locale,
                        'title' => $arrayTranslated['title'],
                        'intro' => $arrayTranslated['intro'],
                        'content' => $arrayTranslated['content'],
                        'slug' => Str::slug($arrayTranslated['slug']),
                        'meta_title' => $arrayTranslated['meta_title'],
                        'meta_desc' => $arrayTranslated['meta_desc'],
                    ]);
            }
        }
    }
}
