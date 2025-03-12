<?php

namespace App\View\Composers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class DashboardComposer
{
    public function __construct(private readonly Contact $contact,
                                private readonly User $user,
                                private readonly Blog $blog)
    {}

    /**
     * Récupère les 5 derniers contacts
     * @return mixed
     */
    public function getLastContacts():Collection
    {
        return $this->contact->orderBy('id', 'desc')->get()->take(5);
    }

    /**
     * Récupère les 5 derniers users
     * @return mixed
     */
    public function getLastUsers():Collection
    {
        return $this->user->orderBy('id', 'desc')->get()->take(5);
    }

    public function getLastBlogs():Collection
    {
        return $this->blog->with(['user', 'translate'])->orderBy('id', 'desc')->get()->take(5);
    }

    public function compose(View $view): void
    {
        $view->with('lastContacts', $this->getLastContacts());
        $view->with('lastUsers', $this->getLastUsers());
        $view->with('lastBlogs', $this->getLastBlogs());
    }
}
