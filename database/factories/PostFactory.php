<?php

namespace Database\Factories;

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
        $heading = $this->faker->sentence();
        $slug = Str::slug($heading);

        return [
            "heading" => $heading,
            "slug" => $slug,
            "content" => $this->faker->paragraph(6),
            "tags" => "Laravel, PHP, MySQL"
        ];
    }
}