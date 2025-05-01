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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            // $table->foreignId('rating_id')->constrained()->onDelete('cascade');
            $table->time('duration');
            $table->text('synopsis');
            $table->text('poster');
            $table->text('trailer');
            $table->string('director');
            $table->date('date_release');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
