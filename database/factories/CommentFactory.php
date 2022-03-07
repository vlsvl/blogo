<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::all(['id']);
        $posts = Post::all(['id']);
        return [
            'content' => $this->faker->sentence(),
            'user_id' => $users->random(1)[0]->id,
            'post_id' => $posts->random(1)[0]->id,
        ];
    }
}
