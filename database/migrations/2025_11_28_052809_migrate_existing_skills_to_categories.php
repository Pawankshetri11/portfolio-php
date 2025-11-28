<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Map existing skills to categories based on their names
        $skillCategoryMapping = [
            'Python' => 'Backend Development',
            'React' => 'Frontend Development',
            'Node.js' => 'Backend Development',
            'PostgreSQL' => 'Database',
            'MongoDB' => 'Database',
            'AWS' => 'Tools & Cloud',
            'Docker' => 'Tools & Cloud',
            'Git' => 'Tools & Cloud',
            'Machine Learning' => 'Data Science',
            'Data Analysis' => 'Data Science',
        ];

        foreach ($skillCategoryMapping as $skillName => $categoryName) {
            $category = DB::table('skill_categories')->where('name', $categoryName)->first();
            if ($category) {
                DB::table('skills')
                    ->where('name', $skillName)
                    ->update(['category_id' => $category->id]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset category_id to null
        DB::table('skills')->update(['category_id' => null]);
    }
};
