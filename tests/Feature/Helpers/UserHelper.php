<?php

namespace Tests\Feature\Helpers;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;


trait UserHelper
{
    private function getAdminUser()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->assignRole(Role::ROLE_ADMIN);
        return $user;
    }

    private function getEditorUser()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->assignRole(Role::ROLE_EDITOR);
        return $user;
    }
}
