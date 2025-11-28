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
            ['name' => 'Python', 'level' => 85, 'category' => 'Backend Development', 'logo' => 'python-logo.png'],
            ['name' => 'React', 'level' => 80, 'category' => 'Frontend Development', 'logo' => 'react-logo.png'],
            ['name' => 'Node.js', 'level' => 75, 'category' => 'Backend Development', 'logo' => 'nodejs-logo.png'],
            ['name' => 'PostgreSQL', 'level' => 70, 'category' => 'Database', 'logo' => 'postgres-logo.png'],
            ['name' => 'MongoDB', 'level' => 65, 'category' => 'Database', 'logo' => 'mongodb-logo.png'],
            ['name' => 'AWS', 'level' => 60, 'category' => 'Tools & Cloud', 'logo' => 'aws-logo.png'],
            ['name' => 'Docker', 'level' => 55, 'category' => 'Tools & Cloud', 'logo' => 'docker-logo.png'],
            ['name' => 'Git', 'level' => 90, 'category' => 'Tools & Cloud', 'logo' => 'git-logo.png'],
            ['name' => 'Machine Learning', 'level' => 70, 'category' => 'Data Science', 'logo' => 'ml-logo.png'],
            ['name' => 'Data Analysis', 'level' => 75, 'category' => 'Data Science', 'logo' => 'data-logo.png'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}