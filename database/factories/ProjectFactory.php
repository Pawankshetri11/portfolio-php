<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'published_at' => $this->faker->dateTime(),
            'description' => $this->faker->text,
            'technologies' => $this->faker->words(3, true),
            'category_id' => ProjectCategory::factory(),
            'github_url' => $this->faker->url,
            'live_url' => $this->faker->url,
        ];
    }
}
