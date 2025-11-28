<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Full-stack web applications and websites',
                'color' => '#3B82F6',
            ],
            [
                'name' => 'AI/ML',
                'slug' => 'ai-ml',
                'description' => 'Artificial Intelligence and Machine Learning projects',
                'color' => '#8B5CF6',
            ],
            [
                'name' => 'Data Analysis',
                'slug' => 'data-analysis',
                'description' => 'Data visualization and analytics projects',
                'color' => '#F59E0B',
            ],
            [
                'name' => 'Game Development',
                'slug' => 'game-development',
                'description' => 'Interactive games and gaming applications',
                'color' => '#10B981',
            ],
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
