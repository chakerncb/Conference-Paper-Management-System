<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Roles::create([
            'id' => 1,
            'name' => 'chair',
            'description' => 'System administrator with full access'
        ]);
        
        Roles::create([
            'id' => 2,
            'name' => 'reviewer',
            'description' => 'Paper reviewer'
        ]);
        
        Roles::create([
            'id' => 3,
            'name' => 'author',
            'description' => 'Paper author'
        ]);
    }
}
