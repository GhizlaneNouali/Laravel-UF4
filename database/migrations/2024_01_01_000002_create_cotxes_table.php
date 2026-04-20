<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cotxes', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->year('any');
            $table->text('descripcio')->nullable();
            $table->string('imatge_principal')->nullable();
            $table->foreignId('usuari_id')
                  ->constrained('usuaris')
                  ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cotxes');
    }
};
