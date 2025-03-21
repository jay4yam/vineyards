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
        return $this->user->with(['biotranslates'])->withCount(['blogs', 'properties'])->paginate(10);
    }

    /**
     * Gère la sauvegarde d'un nouvel utilisateur
     * @param Request $request
     * @return User
     */
    public function store(Request $request): User
    {
        $user = new User();

        $user->id = random_int(2, 99999999);

        $this->update($request, $user);

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
    private function save(Request $request, User $user): void
    {
        $user->fill($request->all());

        //si la requete contient avatar/image
        if($request->has('avatar')){
            $filename = $this->uploadAvatar($request->file('avatar'));
            $user->avatar = $filename;
        }

        $user->save();

        //si la requête contient biotranslate
        if($request->has('biotranslate')){

            //itère sur les langues envoyées par le formulaire d'edition
            foreach ($request['biotranslate'] as $locale => $translation) {

                //mets à jour le model translate par langue
                $user->biotranslates()
                    ->where('locale', '=', $locale)
                    ->updateOrCreate([
                        'locale' => $locale,
                        'user_id' => $user->id,
                    ], [
                        'locale' => $locale,
                        'content' => $translation['content'],
                    ]);
            }
        }

    }
}
