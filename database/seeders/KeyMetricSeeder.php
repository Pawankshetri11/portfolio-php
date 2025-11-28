<?php

namespace Database\Seeders;

use App\Models\KeyMetric;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeyMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metrics = [
            [
                'value' => '4+',
                'label' => 'Years Experience',
                'order' => 0,
            ],
            [
                'value' => '45+',
                'label' => 'Projects Completed',
                'order' => 1,
            ],
            [
                'value' => '9+',
                'label' => 'Core Technologies',
                'order' => 2,
            ],
            [
                'value' => '100%',
                'label' => 'Data-Driven',
                'order' => 3,
            ],
        ];

        foreach ($metrics as $metric) {
            KeyMetric::create($metric);
        }
    }
}
