<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Frontend Development',
            'Backend Development',
            'Database',
            'Tools & Cloud',
            'Data Science',
        ];

        foreach ($categories as $category) {
            SkillCategory::create(['name' => $category]);
        }
    }
}
