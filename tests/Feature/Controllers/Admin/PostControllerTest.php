<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Post;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\Helpers\UserHelper;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, UserHelper;

    public function test_admin_can_see_index_page()
    {
        $this->actingAs($this->getAdminUser());

        $response = $this->get('/admin/posts');
        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $assert) => $assert
                ->component('Admin/Posts/Index')
        );
    }

    public function test_editor_can_see_index_page()
    {
        $this->actingAs($this->getEditorUser());

        $response = $this->get('/admin/posts');
        $response->assertStatus(200);
        $response->assertInertia(
            fn(Assert $assert) => $assert
                ->component('Admin/Posts/Index')
        );
    }

    public function test_user_cannot_see_index_page()
    {
        $this->actingAs($this->getSimpleUser());

        $response = $this->get('/admin/posts');
        $response->assertStatus(403);
    }

    public function test_create_post()
    {
        $user = $this->getAdminUser();
        $this->actingAs($user);

        $post = Post::factory()->make();

        $response = $this->post("/admin/posts", [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $user->id,
        ]);

        $response->assertStatus(302);
    }

    public function test_update_post()
    {
        $this->actingAs($this->getAdminUser());

        $post = Post::factory()->create();

        $response = $this->put("/admin/posts/{$post->slug}",[
            'title' => $post->title,
            'content' => $post->content,
        ]);

        $response->assertStatus(302);
    }
}
