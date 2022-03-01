<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'test',
            'email' => 'test@test.ru',
            'password' => Hash::make('12345678'),
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);
        \App\Models\User::factory(19)->create();

        \App\Models\Post::factory(50)->create();
    }
}
