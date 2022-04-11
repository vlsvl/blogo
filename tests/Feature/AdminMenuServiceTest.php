<?php

namespace Tests\Feature;

use App\Services\AdminMenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\Helpers\UserHelper;
use Tests\TestCase;

class AdminMenuServiceTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    public function test_admin_can_see_menu()
    {
        $this->actingAs($this->getAdminUser());

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertHasProp('adminMenu');
        $this->assertEquals($response->props('adminMenu')[1]['role'][0], 'admin');
    }

    public function test_user_can_see_only_comments()
    {
        $this->actingAs($this->getSimpleUser());

        $response = $this->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertHasProp('adminMenu');
        $this->assertEquals($response->props('adminMenu')[1]['pages'][0]['role'][2], 'user');
    }
}
