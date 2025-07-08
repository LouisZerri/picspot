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
        Schema::create('picture_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('picture_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Empêcher qu'un utilisateur like plusieurs fois la même photo
            $table->unique(['user_id', 'picture_id']);
            
            // Index pour optimiser les requêtes
            $table->index(['user_id', 'picture_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('picture_likes');
    }
};
