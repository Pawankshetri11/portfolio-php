<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::create([
            'name' => 'AWS Certified Developer',
            'issuing_organization' => 'Amazon Web Services',
            'issue_date' => '2020-05-10',
            'icon' => 'award',
            'view_type' => 'link',
            'credential_url' => 'https://aws.amazon.com/certification/',
        ]);

        Certificate::create([
            'name' => 'Certified Data Scientist',
            'issuing_organization' => 'Data Science Institute',
            'issue_date' => '2021-08-22',
            'icon' => 'bar-chart-2',
            'view_type' => 'image',
            'certificate_image' => '/images/certificates/data-scientist.jpg',
        ]);
    }
}
