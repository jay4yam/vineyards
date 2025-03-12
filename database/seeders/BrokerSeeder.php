<?php

namespace Database\Seeders;

use App\Libraries\APIMO\ApimoUsersImport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws \Exception
     */
    public function run(ApimoUsersImport $usersImport): void
    {
        $usersImport->import(2421, null);
    }
}
