<?php

namespace App\Libraries\APIMO;

use App\Libraries\APIMO\ApimoImport;
use App\Models\Agency;
use App\Models\Biography_Translate;
use App\Models\User;
use App\Traits\Uploadable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ApimoUsersImport extends ApimoImport
{
    use Uploadable;

    /**
     * Gère l'appel de l'api l'import et la sauv. des données
     * @param int|null $agency_id
     * @param string|null $timestamp
     * @return void
     * @throws \Exception
     */
    public function import(?int $agency_id, ?string $timestamp): void
    {
        //si l'id existe
        if($agency_id){

            //set agency_id
            $this->agency_id = $agency_id;

            //on appel le call avec l'id direct
            $this->call($agency_id)->saveDatas();
        }else{
            //sinon itère sur la liste des agences en bdd
            foreach (Agency::isPublic()->get() as $agency)
            {
                $this->call($agency->id)->saveDatas();
            }
        }
    }

    /**
     * Gère l'import de données depuis APIMO.
     * @return $this
     * @throws ConnectionException
     * @throws \Exception
     */
    protected function call(?int $agency_id): static
    {
        //set le endpoint de l'api
        $this->endPoint = "https://api.apimo.pro/agencies/{$agency_id}/users";

        //récupère la réponse de l'api apimo
        $this->response = Http::timeout(0)
            ->withBasicAuth( config('apimo.provider'), config('apimo.token') )
            ->get($this->endPoint, ['limit' => $this->limit, 'offset' => $this->offset])
            ->body();

        //converti les données en json
        $this->toJson();

        return $this;
    }

    /**
     * Sauv. les données d'Apimo
     * @return void
     */
    protected function save(): void
    {
        //itère sur la liste des données recues
        foreach ($this->datas->users as $user)
        {
            //si l'utilisateur est active et n'existe pas en bdd
            if((bool)$user->active && (int)$user->id === 110607){

                $agency = Agency::find((int)$user->agency);

                //sauv. ou met à jour l'utilisateur.
                $user = User::updateOrCreate(
                    [
                        'id' => $user->id,
                    ],
                    [
                        'id' => $user->id,
                        'is_active' => $user->active,
                        'firstname' => $user->firstname,
                        'slug_firstname' => Str::slug($user->firstname),
                        'lastname' => $user->lastname,
                        'slug_lastname' => Str::slug($user->lastname),
                        'username' => $user->firstname.'-'.$user->lastname,
                        'role' => 'broker',
                        'job_title' => 'Property Broker',
                        'mobile' => $user->mobile ?? '00',
                        'phone' => $agency->phone ?? '00',
                        'avatar' => $this->uploadUserPicture($user->picture),
                        'email' => $user->email,
                        'password' => $this->checkPassword($user),
                        'agency_id' => $user->agency,
                        'linkedin_profile_url' => config('socials.linkedin'),
                        'facebook_profile_url' => config('socials.facebook'),
                        'youtube_profile_url'   => config('socials.youtube'),
                        'instagram_profile_url' => config('socials.instagram'),
                    ]);

                Biography_Translate::create([
                    'user_id' => $user->id,
                    'locale' => 'fr',
                    'content' => 'biographie de l\'utilisateur',
                ]);
                sleep(1);
            }
        }
    }

    /**
     * Test si un utilisateur existe pour ne pas changer le mot de passe ou en fournir un nouveau
     * @param \StdClass $user
     * @return string
     */
    private function checkPassword(\StdClass $user)
    {
        $testUser = User::find($user->id);

        if($testUser){

            return $testUser->password;
        }

        return Hash::make('password');
    }
}
