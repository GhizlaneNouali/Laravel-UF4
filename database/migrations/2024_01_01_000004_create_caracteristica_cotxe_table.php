<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caracteristica_cotxe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cotxe_id')
                  ->constrained('cotxes')
                  ->onDelete('cascade');
            $table->foreignId('caracteristica_id')
                  ->constrained('caracteristiques')
                  ->onDelete('cascade');
            $table->string('detall')->nullable();
            $table->unique(['cotxe_id', 'caracteristica_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caracteristica_cotxe');
    }
};
