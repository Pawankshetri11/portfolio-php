<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hero;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            'greeting' => 'Hi, I\'m',
            'first_name' => 'Pawan',
            'last_name' => 'Kshetri',
            'title' => 'Data Analyst | Full Stack Developer',
            'subtitle' => 'Data.',
            'description' => 'Turning complex datasets into actionable insights, and building robust, scalable web applications from the ground up.',
            'github_url' => 'https://github.com/pawankshetri',
            'linkedin_url' => 'https://linkedin.com/in/pawan',
            'email' => 'contact@pawan.dev',
            'animation_label_1' => 'Data Analysis',
            'animation_label_2' => 'Frontend Dev',
            'animation_label_3' => 'API Development',
            'animation_label_4' => 'Database Design',
        ]);
    }
}
