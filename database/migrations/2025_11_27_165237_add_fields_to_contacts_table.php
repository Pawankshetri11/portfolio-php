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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('contact_email')->nullable()->after('id');
            $table->string('display_email')->nullable()->after('contact_email');
            $table->string('heading_text')->nullable()->after('display_email');
            $table->text('subtext')->nullable()->after('heading_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['contact_email', 'display_email', 'heading_text', 'subtext']);
        });
    }
};
