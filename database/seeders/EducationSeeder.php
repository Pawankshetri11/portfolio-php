<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Education::create([
            'degree' => 'Master\'s of Computer Application',
            'institution' => 'Graphic Era Deemed to be University',
            'start_date' => '2025-08-01',
            'end_date' => '2027-06-30',
            'is_present' => false,
            'location' => 'Dehradun, IN',
            'icon_style' => 'graduation-cap',
            'description' => 'Focusing on advanced Computer Applications and software development methodologies.',
        ]);

        Education::create([
            'degree' => 'BCA - Data Science',
            'institution' => 'Dev Bhoomi Uttarakhand University',
            'start_date' => '2022-08-01',
            'end_date' => '2025-05-31',
            'is_present' => false,
            'location' => 'Dehradun, IN',
            'icon_style' => 'book-open-check',
            'description' => 'Specialized in Data Science fundamentals, analytics, and database management systems.',
        ]);
    }
}