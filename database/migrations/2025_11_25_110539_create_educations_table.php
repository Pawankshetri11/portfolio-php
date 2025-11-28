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
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('degree'); // Degree / Course Name
            $table->string('institution'); // Institution / University
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_present')->default(false);
            $table->string('location')->nullable();
            $table->string('icon_style')->default('graduation-cap'); // graduation-cap, book-open-check, award
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
