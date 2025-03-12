<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Blog_TranslateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'intro' => fake()->realText(),
            'content' => fake()->realText(),
            'slug' => fake()->url,
            'meta_title' => fake()->text(60),
            'meta_desc' => fake()->text(160),
        ];
    }
}
