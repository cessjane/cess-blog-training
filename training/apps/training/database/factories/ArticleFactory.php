<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'article_category_id' => Category::factory(),
            'title' => $this->faker->sentence(5),
            'slug' => $this->faker->slug(),
            'contents' => $this->faker->paragraph(5),
            'image_path' => $this->faker->imageUrl(360, 360, 'animals', true, 'cats'),
            'updated_user_id' => User::factory(),
        ];
    }
}
