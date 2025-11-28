<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('heros', function (Blueprint $table) {
            $table->string('greeting')->default('Hi, I\'m');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('email')->nullable();
            $table->string('animation_label_1')->nullable(); // Top Right (Yellow)
            $table->string('animation_label_2')->nullable(); // Bottom Left (Green)
            $table->string('animation_label_3')->nullable(); // Bottom Right (Blue)
            $table->string('animation_label_4')->nullable(); // Top Left (Red)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('heros', function (Blueprint $table) {
            $table->dropColumn([
                'greeting',
                'first_name',
                'last_name',
                'github_url',
                'linkedin_url',
                'email',
                'animation_label_1',
                'animation_label_2',
                'animation_label_3',
                'animation_label_4'
            ]);
        });
    }
};
