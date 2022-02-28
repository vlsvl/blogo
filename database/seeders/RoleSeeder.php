<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'title' => 'Admin',
            'description' => 'Admin user',
        ]);
        Role::create([
            'name' => 'editor',
            'title' => 'Editor',
            'description' => 'Can write and moderate posts',
        ]);
        Role::create([
            'name' => 'user',
            'title' => 'User',
            'description' => 'Can write comments, likes',
        ]);
    }
}
