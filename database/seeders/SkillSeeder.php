<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Python', 'category' => 'Backend Development', 'logo' => 'python-logo.png'],
            ['name' => 'React', 'category' => 'Frontend Development', 'logo' => 'react-logo.png'],
            ['name' => 'Node.js', 'category' => 'Backend Development', 'logo' => 'nodejs-logo.png'],
            ['name' => 'PostgreSQL', 'category' => 'Database', 'logo' => 'postgres-logo.png'],
            ['name' => 'MongoDB', 'category' => 'Database', 'logo' => 'mongodb-logo.png'],
            ['name' => 'AWS', 'category' => 'Tools & Cloud', 'logo' => 'aws-logo.png'],
            ['name' => 'Docker', 'category' => 'Tools & Cloud', 'logo' => 'docker-logo.png'],
            ['name' => 'Git', 'category' => 'Tools & Cloud', 'logo' => 'git-logo.png'],
            ['name' => 'Machine Learning', 'category' => 'Data Science', 'logo' => 'ml-logo.png'],
            ['name' => 'Data Analysis', 'category' => 'Data Science', 'logo' => 'data-logo.png'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}