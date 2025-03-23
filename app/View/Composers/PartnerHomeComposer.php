<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class PartnerHomeComposer
{
    public function __construct(public User $user)
    {
    }

    private function getPartners()
    {
        return $this->user->whereIn('role', ['broker', 'partner'])->get()->take(9);
    }

    public function compose(View $view): void
    {
        $view->with('partners', $this->getPartners());
    }
}
