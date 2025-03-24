<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique(); // Tambahkan slug
            $table->text('ringkasan');
            $table->year('tahun');
            $table->string('poster'); 
            $table->enum('tipe', ['movie', 'series'])->default('movie'); 
            $table->integer('jumlah_episode')->nullable(); 
            $table->integer('durasi')->nullable(); 
            $table->string('link')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
