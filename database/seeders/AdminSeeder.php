<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'agency_id' => 1,
            'firstname' => 'super',
            'slug_firstname' => 'super',
            'lastname' => 'admin',
            'slug_lastname' => 'admin',
            'username' => 'superadmin',
            'role' => 'admin',
            'mobile' => '+33(0)6.72.71.30.68',
            'phone' => '+33(0)4.97.06.07.02',
            'email' => 'j.pohier@michaelzingraf.com',
            'avatar' => 'default_user.jpeg',
            'password' => Hash::make('password'),
        ]);
    }
}
