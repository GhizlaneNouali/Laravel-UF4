<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->id();

            $table->string('nom');
            $table->text('descripcio')->nullable();

            $table->string('tipus')->nullable(); 

            $table->string('imatge')->nullable();

            $table->foreignId('cotxe_id')
                  ->constrained('cotxes')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mods');
    }
};