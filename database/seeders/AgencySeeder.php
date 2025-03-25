<?php

namespace Database\Seeders;

use App\Libraries\APIMO\ApimoAgenciesImport;
use App\Models\Agency;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\Client\ConnectionException;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws ConnectionException
     */
    public function run(ApimoAgenciesImport $agenciesImport): void
    {
        $city = City::create([
            'id' => 1,
            'name' => 'cloud',
            'zipcode' => '404',
            'prefix_code' => '404',
            'slug' => 'cloud'
        ]);

        Agency::create([
        'id' => 1,
        'is_christies' => true,
        'is_active' => true,
        'name' => 'Marketing',
        'address' => '55 bd de la croisette',
        'postal' => '06400',
        'city_id' => $city->id,
        'country' => 'France',
        'region' => 'Provence Alpes Côte d\'Azur',
        'latitude' => '0.0',
        'longitude' => '0.0',
        'email' => 'marketing@michaelzingraf.com',
        'phone' => '+33(0)4.97.06.07.02',
        'logo' => 'agency-logo-1741266991.png',
        'picture' => 'agency-picture-1741266991.jpg',
        ]);

        $agenciesImport->import(2421, null);
    }
}
