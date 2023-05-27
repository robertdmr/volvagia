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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('c');
            $table->string('ajetreo');
            $table->string('as');
            $table->date('fecha');
            $table->string('referente')->nullable();
            $table->foreignId('proyecto_id')->nullable()->constrained();
            $table->string('nombre')->nullable();
            $table->string('telefono')->nullable();
            $table->string('X')->nullable();
            $table->string('comentario')->nullable();
            $table->string('e')->nullable();
            $table->string('f')->nullable();
            $table->string('mes')->nullable();
            $table->string('blanco')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
