<?php

namespace Tests\Feature\Controllers\Admin;

use Tests\TestCase;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_dashboard_for_auth_user()
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
    }

    public function test_redirect_for_not_auth()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(302);
    }
}
