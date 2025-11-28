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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Certificate Name
            $table->string('issuing_organization'); // Issuing Organization
            $table->date('issue_date'); // Issue Date
            $table->string('icon')->default('award'); // lucide icon name
            $table->enum('view_type', ['link', 'image'])->default('link'); // External Link or Image Popup
            $table->string('credential_url')->nullable(); // URL for external link
            $table->string('certificate_image')->nullable(); // Image path for popup
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
