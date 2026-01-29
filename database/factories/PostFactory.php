<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5);
        return [
            'title' => $title,
            'description' => fake()->paragraph(5),
            'tags' => implode(',', fake()->words(3)),
            'image' => fake()->imageUrl(),
            'slug' => \Illuminate\Support\Str::slug($title),
            'user_id' => 1,
        ];
    }
}
