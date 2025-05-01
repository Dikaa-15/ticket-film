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
        Schema::table('films', function (Blueprint $table) {
            // Hapus foreign key-nya dulu
            $table->dropForeign(['genre_id']);
            // Baru hapus kolomnya
            $table->dropColumn('genre_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->foreignId('genre_id')->constrained(); // kalo pengen rollback
        });
    }
};
