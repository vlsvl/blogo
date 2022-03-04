<?php

namespace Tests\Feature\Controllers\Admin;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\Helpers\UserHelper;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    public function test_admin_can_see_index_page()
    {
        $this->actingAs($this->getAdminUser());

        $response = $this->get('/admin/users');
        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $assert) => $assert
                ->component('Admin/Users/Index')
        );
    }

    public function test_editor_cannot_see_index_page()
    {
        $this->actingAs($this->getEditorUser());

        $response = $this->get('/admin/users');
        $response->assertStatus(403);
    }

    public function test_admin_can_see_view_page()
    {
        $this->actingAs($this->getAdminUser());

        $response = $this->get('/admin/users/1');
        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $assert) => $assert
                ->component('Admin/Users/Show')
        );
    }

    public function test_editor_cannot_see_show_page()
    {
        $this->actingAs($this->getEditorUser());

        $response = $this->get('/admin/users/1');
        $response->assertStatus(403);
    }
}
