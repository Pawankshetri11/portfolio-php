<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::create([
            'position' => 'Wordpress Developer',
            'company' => 'Capital Street FX',
            'start_date' => '2025-08-01',
            'end_date' => null,
            'description' => 'Converted complex PSD designs into fully functional, responsive WordPress themes. Optimized website performance, achieving a 95+ Google PageSpeed score. Managed plugin integrations and custom PHP functionality.',
            'location' => 'Remote',
            'responsibilities' => "Converted complex PSD designs into fully functional, responsive WordPress themes.\nOptimized website performance, achieving a 95+ Google PageSpeed score.\nManaged plugin integrations and custom PHP functionality.",
            'technologies' => 'Wordpress,PHP,CSS3',
        ]);

        Experience::create([
            'position' => 'WordPress & Shopify Developer',
            'company' => 'White Key Pro Commercio',
            'start_date' => '2025-06-01',
            'end_date' => '2025-08-31',
            'description' => 'Developed custom Shopify themes and managed e-commerce product catalogs. Collaborated with design teams to implement pixel-perfect UI components. Maintained legacy WordPress sites and implemented security patches.',
            'location' => 'On-site',
            'responsibilities' => "Developed custom Shopify themes and managed e-commerce product catalogs.\nCollaborated with design teams to implement pixel-perfect UI components.\nMaintained legacy WordPress sites and implemented security patches.",
            'technologies' => 'Shopify Liquid,E-commerce',
        ]);

        Experience::create([
            'position' => 'Chief Operating Officer / Co-Founder',
            'company' => 'Dev To Dsa',
            'start_date' => '2025-01-01',
            'end_date' => '2025-06-30',
            'description' => 'Led daily operations and strategic planning, scaling the platform to over 5,000 active users. Conceptualized the platform vision and developed the initial MVP.',
            'location' => 'Remote',
            'responsibilities' => "Led daily operations and strategic planning, scaling the platform to over 5,000 active users.\nConceptualized the platform vision and developed the initial MVP. Focused on early-stage product market fit.",
            'technologies' => 'Operations,Strategy,Product,Startup',
            'roles' => [
                [
                    'title' => 'Chief Operating Officer',
                    'start_date' => '2025-02-01',
                    'end_date' => '2025-06-30',
                    'description' => 'Led daily operations and strategic planning, scaling the platform to over 5,000 active users.',
                    'skills' => ['Operations', 'Strategy']
                ],
                [
                    'title' => 'Co-Founder',
                    'start_date' => '2025-01-01',
                    'end_date' => '2025-05-31',
                    'description' => 'Conceptualized the platform vision and developed the initial MVP. Focused on early-stage product market fit.',
                    'skills' => ['Product', 'Startup']
                ]
            ]
        ]);
    }
}