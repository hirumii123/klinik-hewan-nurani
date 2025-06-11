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
        Schema::table('symptoms', function (Blueprint $table) {
            // Add 'image' column (string, nullable)
            $table->string('image')->nullable()->after('name');

            // Add 'image_source' column (string, nullable)
            $table->string('image_source')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('symptoms', function (Blueprint $table) {
            // Drop the columns if the migration is rolled back
            $table->dropColumn('image');
            $table->dropColumn('image_source');
        });
    }
};
