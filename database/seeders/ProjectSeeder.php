<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Smart Mood Enhancer',
            'slug' => 'smart-mood-enhancer',
            'description' => 'An AI-based system that analyzes user emotions and recommends personalized content to improve mental well-being.',
            'content' => 'A comprehensive AI-powered application that uses machine learning algorithms to detect user mood patterns and provide personalized recommendations for content, activities, and interventions.',
            'technologies' => 'Python, ML, AI',
            'category' => 'AI/ML',
            'github_url' => 'https://github.com/pawankshetri/smart-mood-enhancer',
            'live_url' => 'https://smartmood.demo.com',
            'published_at' => now(),
        ]);

        Project::create([
            'title' => 'School ERP System',
            'slug' => 'school-erp-system',
            'description' => 'A comprehensive ERP system for educational institutions, managing student records, attendance, grades, and faculty.',
            'content' => 'Complete school management system with student information, attendance tracking, grade management, faculty profiles, and administrative reporting features.',
            'technologies' => 'Python, SQL, Web',
            'category' => 'Web',
            'github_url' => 'https://github.com/pawankshetri/school-erp',
            'live_url' => 'https://school-erp.demo.com',
            'published_at' => now(),
        ]);

        Project::create([
            'title' => 'Sales & Inventory System',
            'slug' => 'sales-inventory-system',
            'description' => 'A complete inventory and sales tracking system with real-time analytics, stock management, and automated reporting.',
            'content' => 'Advanced inventory management system with sales tracking, automated reporting, stock alerts, and comprehensive analytics dashboard.',
            'technologies' => 'Python, SQL, Power BI',
            'category' => 'Data',
            'github_url' => 'https://github.com/pawankshetri/sales-inventory',
            'live_url' => 'https://inventory.demo.com',
            'published_at' => now(),
        ]);
    }
}