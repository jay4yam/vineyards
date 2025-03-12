<?php

namespace App\Repositories;

use App\Models\User;
use App\traits\Uploadable;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserRepository
{
    use Uploadable;

    public function __construct(private readonly User $user)
    {
    }

    /**
     * Retourne la liste des utilisateurs du site.
     * @return LengthAwarePaginator
     */
    public function getAll():LengthAwarePaginator
    {
        return $this->user->withCount(['blogs', 'properties'])->paginate(10);
    }

    /**
     * Gère la sauvegarde d'un nouvel utilisateur
     * @param Request $request
     * @return User
     */
    public function store(Request $request): User
    {
        $user = new User();

        $user->id = rand(2, 10000000);
        $user->firstname = $request->firstname;
        $user->slug_firstname = Str::slug( $request->firstname );
        $user->lastname = $request->lastname;
        $user->slug_lastname = Str::slug( $request->lastname);
        $user->username = Str::slug( $request->firstname ).'-'.Str::slug( $request->lastname);
        $user->role = $request->role;
        $user->job_title = $request->job_title;
        $user->mobile = $request->mobile;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->linkedin_profile_url = $request->linkedin_profile_url;
        $user->facebook_profile_url = $request->facebook_profile_url;
        $user->youtube_profile_url = $request->youtube_profile_url;
        $user->instagram_profile_url = $request->instagram_profile_url;
        $user->avatar = $request->avatar;
        $user->biography = $request->biography;
        $user->password = Hash::make('password');

        $user->save();

        if($request->has('avatar')){
            $filename = $this->uploadAvatar($request->file('avatar'));
            $user->avatar = $filename;
            $user->save();
        }

        return $user;
    }

    /**
     * Gère la mise à jour d'un utilisateur
     * @param Request $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user):void
    {
        $this->save($request, $user);
    }

    /**
     * Gère la sauvegarde du model user.
     * @param Request $request
     * @param User $user
     * @return void
     */
    private function save(Request $request, User $user)
    {
        $user->fill($request->all());

        if($request->has('avatar')){
            $filename = $this->uploadAvatar($request->file('avatar'));
            $user->avatar = $filename;
        }

        $user->save();
    }
}
