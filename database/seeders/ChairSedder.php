<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChairSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    User::create([
        'name' => 'Conference Chair',
        'email' => 'chair@conference.com',
        'password' => Hash::make('11111111'),
        'role_id' => 1,
    ]);
    }
}
