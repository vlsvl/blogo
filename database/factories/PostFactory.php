<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'admin')
                ->orWhere('name', 'editor');
        })
            ->select(['id'])
            ->get();

        return [
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph(10),
            'posted_at' => Carbon::today()->subDays(rand(0, 365)),
            'user_id' => $users->random(1)[0]->id,
        ];
    }
}
