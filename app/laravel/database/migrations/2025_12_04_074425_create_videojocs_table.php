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
        Schema::create('videojocs', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('plataforma');
            $table->year('any_estrena');
            $table->enum('estat', ['Jugant', 'Completat', 'Pendent']);
            $table->decimal('preu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videojocs');
    }
};
