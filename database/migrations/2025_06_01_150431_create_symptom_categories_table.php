<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('symptom_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Tambahkan kolom kategori_id ke symptoms
        Schema::table('symptoms', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->nullable()->after('name');

            // Tambahkan foreign key
            $table->foreign('kategori_id')->references('id')->on('symptom_categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('symptoms', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });

        Schema::dropIfExists('symptom_categories');
    }

};
