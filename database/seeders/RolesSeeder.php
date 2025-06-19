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
            'name' => 'chair',
            'description' => 'System administrator with full access'
        ]);
        
        Roles::create([
            'name' => 'reviewer',
            'description' => 'Paper reviewer'
        ]);
        
        Roles::create([
            'name' => 'author',
            'description' => 'Paper author'
        ]);
    }
}
