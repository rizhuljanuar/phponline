<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->words(5, true);

        return [
            'title' => $this->faker->words(5, true),
            'slug' => Str::slug($title),
            'body' => $this->faker->randomHtml(),
            'description' => $this->faker->sentence(2, true), // max: 120
            'published' => $this->faker->boolean(),  
        ];
    }
}
